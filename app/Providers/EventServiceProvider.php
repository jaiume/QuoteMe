<?php

namespace App\Providers;

use App\Events\AuthTokenCreated;
use App\Events\CreditsLow;
use App\Events\CreditsPurchased;
use App\Events\QuickContactCreated;
use App\Events\RequestCancelled;
use App\Events\RequestCreated;
use App\Events\ResponseCreated;
use App\Events\ResponseNotificationSent;
use App\Events\SupplierCreated;
use App\Events\SupplierEmailChanged;
use App\Events\SupplierPhoneChanged;
use App\Listeners\InvalidateSupplierEmail;
use App\Listeners\InvalidateSupplierPhone;
use App\Listeners\NotifyCustomerOnRequestResponded;
use App\Listeners\NotifySupplierOnCreditsLow;
use App\Listeners\NotifySuppliersOnRequestCreated;
use App\Listeners\Payments\ChargeSuppliersForQuickNotify;
use App\Listeners\SendAuthLinkOnAuthTokenCreated;
use App\Listeners\Payments\ChargebackSuppliersOnRequestCancelled;
use App\Listeners\Payments\ChargeSupplierForQuickContact;
use App\Listeners\Payments\ChargeSupplierForResponse;
use App\Listeners\RemoveAuthTokenOnLogout;
use App\Listeners\SendNotificationOnCreditsPurchased;
use App\Listeners\SendWelcomeNotificationOnSupplierCreated;
use App\Listeners\UpdateLastLoginOnAuthenticated;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Login::class => [
            UpdateLastLoginOnAuthenticated::class,
        ],

        Logout::class => [
            RemoveAuthTokenOnLogout::class,
        ],

        ResponseCreated::class => [
            NotifyCustomerOnRequestResponded::class
        ],

        ResponseNotificationSent::class => [
            ChargeSupplierForResponse::class,
        ],

        RequestCreated::class => [
            ChargeSuppliersForQuickNotify::class,
            NotifySuppliersOnRequestCreated::class,
        ],

        RequestCancelled::class => [
            ChargebackSuppliersOnRequestCancelled::class,
        ],

        QuickContactCreated::class => [
            ChargeSupplierForQuickContact::class,
        ],

        AuthTokenCreated::class => [
            SendAuthLinkOnAuthTokenCreated::class,
        ],

        SupplierCreated::class => [
            SendWelcomeNotificationOnSupplierCreated::class,
        ],

        CreditsPurchased::class => [
            SendNotificationOnCreditsPurchased::class,
        ],

        CreditsLow::class => [
            NotifySupplierOnCreditsLow::class,
        ],

        SupplierEmailChanged::class => [
            InvalidateSupplierEmail::class,
        ],

        SupplierPhoneChanged::class => [
            InvalidateSupplierPhone::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
