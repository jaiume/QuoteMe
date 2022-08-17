<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Utils\MessageUtils;
use Illuminate\Database\Seeder;

class Messages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Set message templates');

        Message::create([
            'slug' => MessageUtils::SLUG_CUSTOMER_RELOAD_EMAIL,
            'name' => 'Customer Reload Email',
            'sms' => false,
            'subject' => 'QuoteMe Authentication',
            'text' => '<strong>Hello, **CustomerName!</strong><br><br>Please follow the link to authenticate on QuoteMe:<br>**CustomerReloadLink',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_NORMAL_REQUEST_EMAIL,
            'name' => 'Normal Request Notification',
            'sms' => false,
            'subject' => 'You\'ve got a new request',
            'text' => '<strong>Hello, **SupplierName!</strong><br><br> You\'ve got a new request:<br> **RequestDetailLink',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_NORMAL_REPLY_EMAIL,
            'name' => 'Normal Reply Notification',
            'sms' => false,
            'subject' => 'You\'ve received a reply',
            'text' => '<strong>Hello, **CustomerName!</strong><br><br> You\'ve got a reply for your request. The **SupplierName responded:<br> **ResponseNote.<br><br> You can check it right now on QuoteMe by using the following link:<br> **ResponseDetailLink',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_QUICK_REPLY_SMS,
            'name' => 'Quick Reply',
            'sms' => true,
            'text' => 'Hello, **CustomerName! You\'ve got the reply for your request. You can check it right now on QuoteMe.',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_QUICK_NOTIFY_SMS,
            'name' => 'QuickNotify',
            'sms' => true,
            'text' => 'Hello, **SupplierName! You\'ve got the new request: **RequestDetailLink',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_SUPPLIER_WELCOME_EMAIL,
            'name' => 'Supplier Welcome',
            'sms' => false,
            'subject' => 'Welcome to QuoteMe!',
            'text' => '<strong>Hello, **SupplierName!</strong><br><br> You\'ve been successfully registered on QuoteMe',
        ]);

//        Message::create([
//            'slug' => MessageUtils::SLUG_SUPPLIER_PASSWORD_RESET_EMAIL,
//            'name' => 'Password Reset',
//            'sms' => false,
//            'subject' => 'Password Reset Confirmation',
//            'text' => 'Hello, **SupplierName! You\'ve requested the password reset on QuoteMe.',
//        ]);
//
//        Message::create([
//            'slug' => MessageUtils::SLUG_ADMIN_PASSWORD_RESET_EMAIL,
//            'name' => 'Password Reset',
//            'sms' => false,
//            'subject' => 'Password Reset Confirmation',
//            'text' => 'You\'ve requested the password reset on QuoteMe.',
//        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_SUPPLIER_LOW_CREDIT_EMAIL,
            'name' => 'Supplier Low Credit Notification',
            'sms' => false,
            'subject' => 'Your QuoteMe credits is expiring',
            'text' => '<strong>Hello, **SupplierName!</strong><br><br> Your QuoteMe credits are low.',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_ADMIN_PURCHASE_EMAIL,
            'name' => 'Admin Purchase Notification',
            'sms' => false,
            'subject' => 'Credits purchase on QuoteMe',
            'text' => '**SupplierName just purchased some credits',
        ]);

        Message::create([
            'slug' => MessageUtils::SLUG_ADMIN_SMS_LOW_EMAIL,
            'name' => 'SMS Low',
            'sms' => false,
            'text' => 'Your Twilio balance is getting low',
        ]);
    }
}
