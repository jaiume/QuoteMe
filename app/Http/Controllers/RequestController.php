<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestShowRequest;
use App\Http\Requests\RequestStoreRequest;
use App\Http\Requests\RequestUpdateRequest;
use App\Http\Requests\ResponseShowRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Response;
use App\Utils\PermissionUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = \App\Models\Request
            ::published()
            ->with(['responses', 'media', 'category', 'area'])
            ->whereHas('customer', function (Builder $query) {
                $query->where('id', \Auth::id());
            })
            ->orderByDesc('created_at')
            ->get();

        return view('customer.requests', [
            'requests' => $requests,
        ]);
    }

    public function store(RequestStoreRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('description');
        $url = $request->input('url');
        $quick_reply = $request->input('quick_reply', false);
        $quick_contact = $request->input('quick_contact', false);
        $phone = $request->input('phone');
        $photo = $request->file('photo');

        $area = optional(Area::find($request->input('area')))->first();
        $category = optional(Category::find($request->input('category')))->first();

        $confirmationRequired = false;

        $customer = $request->customer ?? null;
        if ($customer) {
            /* If user is authorized*/
            if ($name && $customer->name !== $name) {
                $customer->setAttribute('name', $name);
            }

            if ($phone && $customer->phone !== $phone) {
                $customer->setAttribute('phone', $phone);
            }

            if ($customer->isDirty()) {
                $customer->save();
            }
        } elseif (optional(Auth::user())->hasRole(PermissionUtils::ROLE_SUPPLIER)) {
            optional(Auth::user())->assignRole(PermissionUtils::ROLE_CUSTOMER);
            $customer = Customer::find(Auth::id());
        } else {
            $customer = Customer::firstOrCreate(['email' => $email], [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => \Hash::make(Str::random()),
            ]);

            if ($customer->wasRecentlyCreated) {
                /* If user is new */
                \Auth::login($customer);
            } else {
                /* If user exists in db */
                $confirmationRequired = true;
            }
        }

        try {
            $request = \App\Models\Request::make([
                'quick_contact' => $quick_contact,
                'quick_reply' => $quick_reply,
                'url' => $url,
                'text' => $description,
                'published' => !$confirmationRequired,
            ]);

            if ($photo instanceof UploadedFile) {
                $request->addMedia($photo)->toMediaCollection('photo');
            }

            $request->customer()->associate($customer);
            $request->area()->associate($area);
            $request->category()->associate($category);
            $request->save();

            if ($confirmationRequired) {
                return redirect()->route('customer.home', ['id' => $request->id])
                                 ->with('success', __('Your request was successfully added'))
                                 ->with('warning', __('You should authorize to confirm publication. The authorization link was sent to your email.'));
            }

            return redirect()->route('customer.request.show', ['id' => $request->id])
                             ->with('success', __('Your request was successfully added'));

        } catch (ModelNotFoundException $e) {
        } catch (FileDoesNotExist $e) {
        } catch (FileIsTooBig $e) {
            $message = __('Provided data is incorrect');
            if (config('app.debug', false)) {
                $message = $e->getMessage();
            }

            abort(400, $message);
        }
    }

    public function show(RequestShowRequest $httpRequest, int $id)
    {
        $request = \App\Models\Request::published()->findOrFail($id);

        $request->responses->each(function (Response $response) {
            if ($response->listed_at === null) {
                $response->setAttribute('listed_at', Carbon::now());
                $response->save();
            }
        });

        return view('customer.request', [
            'request' => $request,
        ]);
    }

    public function showResponse(ResponseShowRequest $httpRequest, int $request_id, int $response_id)
    {
        try {
            $request = \App\Models\Request::findOrFail($request_id);
            $response = \App\Models\Response::findOrFail($response_id);

            if ($response->viewed_at === null) {
                $response->setAttribute('viewed_at', Carbon::now());
                $response->save();
            }

            return view('customer.response', [
                'request' => $request,
                'response' => $response,
            ]);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function update(RequestUpdateRequest $request, int $id)
    {
        $updateFields = [];

        $cancelled = $request->input('cancelled');
        if ($cancelled !== null) {
            $updateFields['cancelled'] = (bool)$cancelled;
        }

        try {
            \App\Models\Request::findOrFail($id)->update($updateFields);
        } catch (ModelNotFoundException $e) {
            abort(400);
        }

        return redirect()->route('customer.request.index');
    }
}
