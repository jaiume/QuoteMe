<?php

namespace Quoteme\SupplierProfileTool\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;

class SupplierProfileToolController extends BaseController
{
    public function getUserData(HttpRequest $httpRequest): JsonResponse
    {
        /* @var Supplier|null $supplier */
        $supplier = Supplier::find($httpRequest->user()->id);

        if (!$supplier) {
            return response()->json([
                'status' => false,
                'message' => 'You\'re not authorized to perform this request',
            ], 403);
        }

        $fields = [
            [
                'component' => 'form-text-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Name'),
                'attribute' => 'name',
                'value' => $supplier->name,
            ],
            [
                'component' => 'form-text-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Email'),
                'attribute' => 'email',
                'value' => $supplier->email,
                'required' => true,
                'helpText' => $supplier->hasVerifiedEmail() ? '' : __('You must verify your email')
            ],
            [
                'component' => 'form-phone-number',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Phone'),
                'attribute' => 'phone',
                'value' => $supplier->phone,
                'useMaskPlaceholder' => true,
                'format' => '+# ### ###-####',
                'helpText' => $supplier->hasVerifiedPhone() ? '' : __('You must verify your phone number')
            ],
            [
                'component' => 'form-boolean-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Quick Notify'),
                'attribute' => 'quick_notify',
                'value' => $supplier->quick_notify,
            ],
            [
                'component' => 'form-multiselect-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Geographic Areas'),
                'attribute' => 'areas',
                'options' => Area::orderBy('name')->get(['id', 'name'])->map(function (Area $area) {
                    return ['label' => $area->name, 'value' => $area->id];
                })->all(),
                'value' => $supplier->areas->map(function (Area $area) {
                    return $area->id;
                }),
            ],
            [
                'component' => 'form-multiselect-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Categories'),
                'attribute' => 'categories',
                'options' => Category::orderBy('name')->get(['id', 'name'])->map(function (Category $category) {
                    return ['label' => $category->name, 'value' => $category->id];
                })->all(),
                'value' => $supplier->categories->map(function (Category $category) {
                    return $category->id;
                }),
            ],
            [
                'component' => 'form-password-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Current Password'),
                'attribute' => 'current_password',
                'value' => null,
                'helpText' => __('Leave empty if you don\'t need to change the password'),
            ],
            [
                'component' => 'form-password-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('New Password'),
                'attribute' => 'new_password',
                'value' => null,
                'helpText' => __('Leave empty if you don\'t need to change the password'),
            ],
            [
                'component' => 'form-password-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Confirm New Password'),
                'attribute' => 'new_password_confirmation',
                'value' => null,
            ],
        ];

        return response()->json([
            'status' => true,
            'message' => 'User Data',
            'data' => [
                'fields' => $fields,
                'email_verified' => optional($supplier)->hasVerifiedEmail(),
                'phone_verified' => optional($supplier)->hasVerifiedPhone(),
            ],
        ]);
    }

    public function setUserData(HttpRequest $httpRequest): JsonResponse
    {
        $httpRequest->validate([
            'name' => 'string|max:255|nullable',
            'email' => 'email|max:255|unique:users,email,' . $httpRequest->user()->id,
            'phone' => 'nullable|required_with:quick_notify|phone:AUTO,TT',
            'quick_notify' => 'boolean',
            'areas.*' => 'exists:areas,id',
            'categories.*' => 'exists:categories,id',
            'current_password' => 'password|required_with:new_password|nullable',
            'new_password' => 'string|min:8|confirmed|nullable',
        ]);

        /* @var Supplier|null $supplier */
        $supplier = Supplier::find($httpRequest->user()->id);

        if ($supplier) {
            $supplier->fill($httpRequest->except(
                'new_password',
                'new_password_confirmation',
                'areas',
                'categories',
            ));

            $areas = $httpRequest->input('areas', []);
            $supplier->areas()->sync($areas);

            $categories = $httpRequest->input('categories', []);
            $supplier->categories()->sync($categories);

            if ($httpRequest->input('new_password')) {
                $supplier->password = \Hash::make($httpRequest->input('new_password'));
            }

            $saveResult = $supplier->save();

            if ($saveResult) {
                return response()->json([
                    'status' => true,
                    'message' => 'Saved'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'You\'re not authorized to perform this request',
        ], 403);
    }

    public function requestEmailVerifyMessage(HttpRequest $httpRequest): JsonResponse
    {
        $supplier = Supplier::findOrFail(optional($httpRequest->user())->id);
        $supplier->sendEmailVerificationNotification();

        return response()->json([
            'sent' => true
        ]);
    }

    public function requestPhoneVerifyMessage(HttpRequest $httpRequest): JsonResponse
    {
        $httpRequest->validate([
            'code' => 'nullable|string|min:6|max:6',
        ]);

        $code = $httpRequest->input('code');

        $supplier = Supplier::findOrFail(optional($httpRequest->user())->id);
        if ($code) {
            $verified = $supplier->verifyPhone($code);

            return response()->json([
                'verified' => $verified
            ]);
        }

        $supplier->sendPhoneVerificationNotification();

        return response()->json([
            'sent' => true
        ]);
    }
}
