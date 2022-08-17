<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Category;
use App\Models\Supplier;
use App\Notifications\SupplierWelcomeNotification;
use App\Providers\RouteServiceProvider;
use App\Utils\MessageUtils;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'required_with:quick_notify', 'phone:AUTO,TT'],
            'quick_notify' => ['boolean'],
            'areas.*' => ['required', 'exists:areas,id'],
            'categories.*' => ['required', 'exists:categories,id'],
        ]);
    }

    protected function customerValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'required_with:quick_notify', 'phone:AUTO,TT'],
            'quick_notify' => ['boolean'],
            'areas.*' => ['required', 'exists:areas,id'],
            'categories.*' => ['required', 'exists:categories,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return App\Models\Supplier
     */
    protected function create(array $data)
    {
        $supplier = Supplier::create(array_merge($data, [
            'password' => Hash::make($data['password']),
        ]));

        $supplier->quick_notify = array_key_exists('quick_notify', $data) ? (bool)$data['quick_notify'] : false;

        $supplier->areas()->sync($data['areas']);
        $supplier->categories()->sync($data['categories']);

        $supplier->save();

        return $supplier;
    }

    protected function assignSupplierRole(array $data)
    {
        optional(Auth::user())->assignRole(PermissionUtils::ROLE_SUPPLIER);

        $supplier = Supplier::find(Auth::id());
        $supplier->quick_notify = array_key_exists('quick_notify', $data) ? (bool)$data['quick_notify'] : false;

        $supplier->areas()->sync($data['areas']);
        $supplier->categories()->sync($data['categories']);

        $supplier->password = \Hash::make($data['password']);

        if ($supplier->save()) {
            $supplier->notify(
                new SupplierWelcomeNotification(MessageUtils::getSupplierWelcomeEmail($supplier))
            );
        }

        return $supplier;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): \Illuminate\View\View
    {
        $areas = Area::all()->map(function (Area $item) {
            return [
                'label' => $item->name,
                'value' => $item->id,
                'disabled' => false,
            ];
        });

        $categories = Category::all()->map(function (Category $item) {
            return [
                'label' => $item->name,
                'value' => $item->id,
                'disabled' => false,
            ];
        });

        return view('auth.register', [
            'email' => optional(Auth::user())->email,
            'name' => optional(Auth::user())->name,
            'phone' => optional(Auth::user())->phone,
            'areas' => $areas,
            'categories' => $categories,
        ]);
    }

    public function registerCustomerAsSupplier(Request $request) {
        $this->customerValidator($request->all())->validate();

        event(new Registered($user = $this->assignSupplierRole($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function register(Request $request)
    {
        if (optional(Auth::user())->hasRole(PermissionUtils::ROLE_CUSTOMER)) {
            return $this->registerCustomerAsSupplier($request);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return url('/dashboard/supplier-profile');
    }
}
