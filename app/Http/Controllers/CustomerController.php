<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEmailExistsRequest;
use App\Http\Requests\CustomerGetAuthLinkRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::orderBy('name')->get()->map(function (Area $item) {
            return [
                'label' => $item->name,
                'value' => $item->id,
                'disabled' => !$item->has_suppliers,
            ];
        });

        $categories = Category::orderBy('name')->get()->map(function (Category $item) {
            return [
                'label' => $item->name,
                'value' => $item->id,
                'disabled' => !$item->has_suppliers,
            ];
        });

        return view('customer.home', [
            'email' => optional(\Auth::user())->email,
            'name' => optional(\Auth::user())->name,
            'phone' => optional(\Auth::user())->phone,

            'areas' => $areas,
            'categories' => $categories,
        ]);
    }

    public function login(Request $request)
    {
        return view('auth.customer-login');
    }

    public function requestAuthLink(CustomerGetAuthLinkRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $customer = Customer::where('email', $email)
                            ->first();

        if ($customer) {
            $customer->generateAuthToken();
        }

        return redirect()->route('customer.home')
                         ->with('info', __('If the email provided by you exists in our records, we\'ll send the authorization link to it'));
    }

    public function checkEmailExists(CheckEmailExistsRequest $request): JsonResponse
    {
        /** @var string $email */
        $email = $request->get('email');

        $exists = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $exists = Customer::where('email', $email)->exists();
        }

        return response()->json([
            'exists' => $exists
        ]);
    }
}
