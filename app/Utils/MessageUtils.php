<?php

namespace App\Utils;

use App\Dto\MessageData;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Request;
use App\Models\Response;
use App\Models\Supplier;

class MessageUtils {
    public const SLUG_CUSTOMER_RELOAD_EMAIL = 'CUSTOMER_RELOAD_EMAIL';
    public const SLUG_NORMAL_REQUEST_EMAIL = 'NORMAL_REQUEST_EMAIL';
    public const SLUG_NORMAL_REPLY_EMAIL = 'NORMAL_REPLY_EMAIL';
    public const SLUG_QUICK_NOTIFY_SMS = 'QUICK_NOTIFY_SMS';
    public const SLUG_QUICK_REPLY_SMS = 'QUICK_REPLY_SMS';
    public const SLUG_SUPPLIER_WELCOME_EMAIL = 'SUPPLIER_WELCOME_EMAIL';
    public const SLUG_SUPPLIER_LOW_CREDIT_EMAIL = 'SUPPLIER_LOW_CREDIT_EMAIL';
    public const SLUG_ADMIN_SMS_LOW_EMAIL = 'ADMIN_SMS_LOW_EMAIL';
    public const SLUG_ADMIN_PURCHASE_EMAIL = 'ADMIN_PURCHASE_EMAIL';

    public static function getMessage(string $slug, array $placeholders = []): ?MessageData
    {
        return optional(Message::where('slug', $slug)->first())->getMessageData($placeholders);
    }

    public static function getCustomerReloadEmail(Customer $customer): ?MessageData
    {
        return self::getMessage(self::SLUG_CUSTOMER_RELOAD_EMAIL, [
            'CustomerName' => $customer->name,
            'CustomerPhone' => $customer->phone,
            'CustomerEmail' => $customer->email,
            'CustomerReloadLink' => str_replace('%s', $customer->auth_link, '<a href="%s">%s</a>'),
        ]);
    }

    public static function getNormalRequestEmail(Request $request, Supplier $supplier = null): ?MessageData
    {
        $placeholders = [
            'CustomerName' => $request->customer->name,
            'CustomerPhone' => $request->customer->phone,
            'CustomerEmail' => $request->customer->email,
            'RequestCategory' => $request->category->name,
            'RequestArea' => $request->area->name,
            'RequestDescription' => $request->text,
            'RequestURL' => $request->url,
            'RequestQuickContact' => $request->quick_contact ? __('On') : __('Off'),
            'RequestQuickReply' => $request->quick_reply ? __('On') : __('Off'),
            'RequestDetailLink' => str_replace('%s', url("/dashboard/resources/requests/{$request->id}"), '<a href="%s">%s</a>'),
        ];

        if ($supplier) {
            $placeholders = array_merge($placeholders, [
                'SupplierName' => $supplier->name,
                'SupplierPhone' => $supplier->phone,
                'SupplierEmail' => $supplier->email,
            ]);
        }

        return self::getMessage(self::SLUG_NORMAL_REQUEST_EMAIL, $placeholders);
    }

    public static function getNormalReplyEmail(Response $response): ?MessageData
    {
        return self::getMessage(self::SLUG_NORMAL_REPLY_EMAIL, [
            'CustomerName' => $response->request->customer->name,
            'CustomerPhone' => $response->request->customer->phone,
            'CustomerEmail' => $response->request->customer->email,
            'RequestCategory' => $response->request->category->name,
            'RequestArea' => $response->request->area->name,
            'RequestDescription' => $response->request->text,
            'RequestURL' => $response->request->url,
            'RequestQuickContact' => $response->request->quick_contact ? __('On') : __('Off'),
            'RequestQuickReply' => $response->request->quick_reply ? __('On') : __('Off'),
            'RequestDetailLink' => str_replace('%s', route('customer.request.show', ['id' => $response->request->id]), '<a href="%s">%s</a>'),
            'SupplierName' => $response->supplier->name,
            'SupplierPhone' => $response->supplier->phone,
            'SupplierEmail' => $response->supplier->email,
            'ResponseNote' => $response->text,
            'ResponseDetailLink' => str_replace('%s', route('customer.response.show', [
                'request_id' => $response->request->id,
                'response_id' => $response->id
            ]), '<a href="%s">%s</a>'),
        ]);
    }

    public static function getQuickNotifySms(Request $request, Supplier $supplier = null): ?MessageData
    {
        $placeholders = [
            'CustomerName' => $request->customer->name,
            'CustomerPhone' => $request->customer->phone,
            'CustomerEmail' => $request->customer->email,
            'RequestCategory' => $request->category->name,
            'RequestArea' => $request->area->name,
            'RequestDescription' => $request->text,
            'RequestURL' => $request->url,
            'RequestQuickContact' => $request->quick_contact ? __('On') : __('Off'),
            'RequestQuickReply' => $request->quick_reply ? __('On') : __('Off'),
            'RequestDetailLink' => url("/dashboard/resources/requests/{$request->id}"),
        ];

        if ($supplier) {
            $placeholders = array_merge($placeholders, [
                'SupplierName' => $supplier->name,
                'SupplierPhone' => $supplier->phone,
                'SupplierEmail' => $supplier->email,
            ]);
        }

        return self::getMessage(self::SLUG_QUICK_NOTIFY_SMS, $placeholders);
    }

    public static function getQuickReplySms(Response $response): ?MessageData
    {
        return self::getMessage(self::SLUG_QUICK_REPLY_SMS, [
            'CustomerName' => $response->request->customer->name,
            'CustomerPhone' => $response->request->customer->phone,
            'CustomerEmail' => $response->request->customer->email,
            'RequestCategory' => $response->request->category->name,
            'RequestArea' => $response->request->area->name,
            'RequestDescription' => $response->request->text,
            'RequestURL' => $response->request->url,
            'RequestQuickContact' => $response->request->quick_contact ? __('On') : __('Off'),
            'RequestQuickReply' => $response->request->quick_reply ? __('On') : __('Off'),
            'RequestDetailLink' => route('customer.request.show', ['id' => $response->request->id]),
            'SupplierName' => $response->supplier->name,
            'SupplierPhone' => $response->supplier->phone,
            'SupplierEmail' => $response->supplier->email,
            'ResponseNote' => $response->text,
            'ResponseDetailLink' => route('customer.response.show', [
                'request_id' => $response->request->id,
                'response_id' => $response->id
            ]),
        ]);
    }

    public static function getSupplierWelcomeEmail(Supplier $supplier): ?MessageData
    {
        return self::getMessage(self::SLUG_SUPPLIER_WELCOME_EMAIL, [
            'SupplierName' => $supplier->name,
            'SupplierPhone' => $supplier->phone,
            'SupplierEmail' => $supplier->email,
        ]);
    }

    public static function getSupplierLowCreditEmail(Supplier $supplier): ?MessageData
    {
        return self::getMessage(self::SLUG_SUPPLIER_LOW_CREDIT_EMAIL, [
            'SupplierName' => $supplier->name,
            'SupplierPhone' => $supplier->phone,
            'SupplierEmail' => $supplier->email,
        ]);
    }

    public static function getAdminSmsLowEmail(): ?MessageData
    {
        return self::getMessage(self::SLUG_ADMIN_SMS_LOW_EMAIL);
    }

    public static function getAdminPurchaseEmail(Supplier $supplier): ?MessageData
    {
        return self::getMessage(self::SLUG_ADMIN_PURCHASE_EMAIL, [
            'SupplierName' => $supplier->name,
            'SupplierPhone' => $supplier->phone,
            'SupplierEmail' => $supplier->email,
        ]);
    }
}
