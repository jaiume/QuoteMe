<?php

namespace Quoteme\AdminProfileTool\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;

class AdminProfileToolController extends BaseController
{
    /**
     * @param HttpRequest $httpRequest
     * @return JsonResponse
     */
    public function getUserData(HttpRequest $httpRequest): JsonResponse
    {
        /* @var Admin|null $admin */
        $admin = Admin::find($httpRequest->user()->id);

        if (!$admin) {
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
                'value' => $admin->name,
            ],
            [
                'component' => 'form-text-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Email'),
                'attribute' => 'email',
                'value' => $admin->email,
                'required' => true,
            ],
            [
                'component' => 'form-phone-number',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Phone'),
                'attribute' => 'phone',
                'value' => $admin->phone,
                'useMaskPlaceholder' => true,
                'format' => '+# ### ###-####',
            ],
            [
                'component' => 'form-boolean-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Credit Purchase Notification'),
                'attribute' => 'credit_notification',
                'value' => $admin->credit_notification,
            ],
            [
                'component' => 'form-boolean-field',
                'sortable' => false,
                'textAlign' => 'left',
                'prefixComponent' => true,
                'name' => __('Low SMS Notification'),
                'attribute' => 'low_sms_notification',
                'value' => $admin->low_sms_notification,
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
            'data' => $fields,
        ]);
    }

    /**
     * @param HttpRequest $httpRequest
     * @return JsonResponse
     */
    public function setUserData(HttpRequest $httpRequest): JsonResponse
    {
        $httpRequest->validate([
            'name' => 'string|nullable',
            'email' => 'email|unique:users,email,' . $httpRequest->user()->id,
            'phone' => 'nullable|phone:AUTO,TT',
            'credit_notification' => 'boolean',
            'low_sms_notification' => 'boolean',
            'current_password' => 'password|required_with:new_password|nullable',
            'new_password' => 'string|min:5|confirmed|nullable',
        ]);

        /* @var Admin|null $admin */
        $admin = Admin::find($httpRequest->user()->id);

        if ($admin) {
            $admin->fill($httpRequest->except('new_password', 'new_password_confirmation'));

            if ($httpRequest->input('new_password')) {
                $admin->password = \Hash::make($httpRequest->input('new_password'));
            }

            $saveResult = $admin->save();

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
}
