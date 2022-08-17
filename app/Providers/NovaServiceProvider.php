<?php

namespace App\Providers;

use App\Models\User;
use App\Nova\Dashboards\Requests;
use App\Nova\Metrics\CancelledRequests;
use App\Nova\Metrics\PendingRequests;
use App\Nova\Metrics\RequestDistribution;
use App\Nova\Metrics\RespondedRequests;
use App\Nova\Metrics\RequestCount;
use App\Nova\Metrics\SuppliersCount;
use App\Nova\Metrics\TwilioAccountBalance;
use App\Utils\PermissionUtils;
use App\Utils\SettingsUtils;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSettings\NovaSettings;
use Quoteme\QuickNotifyCard\QuickNotifyCard;
use Quoteme\SupplierLastRequestsCard\SupplierLastRequestsCard;
use Quoteme\WalletBalanceCard\WalletBalanceCard;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::resources([\Vyuldashev\NovaPermission\Permission::class]);

        static::initNovaSettings();
    }

    /**
     *
     */
    private static function initNovaSettings(): void
    {
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Boolean::make(__('Require supplier email verification'), 'supplier_email_verification_enabled'),

            Boolean::make(__('Require supplier phone verification'), 'supplier_phone_verification_enabled'),

            Number::make(__('Supplier Low Credit Threshold'), 'low_credit_threshold'),

            Number::make(__('SMS Low Threshold'), 'sms_low_threshold'),

            new Panel(__('Action Costs'), [
                Number::make(__('Normal Request Receipt'), 'normal_request_receipt'),
                Number::make(__('Normal Response'), 'normal_reply'),
                Number::make(__('Quick Notify'), 'quick_notify'),
                Number::make(__('Quick Contact'), 'quick_contact'),
                Number::make(__('Quick Response'), 'quick_reply'),
            ]),

            new Panel(__('Quick Actions Status'), [
                Boolean::make(__('Quick Notify'), 'quick_notify_enabled'),
                Boolean::make(__('Quick Contact'), 'quick_contact_enabled'),
                Boolean::make(__('Quick Response'), 'quick_reply_enabled'),
            ]),

            new Panel(__('Head Start'), [
                Boolean::make(__('Enabled'), 'head_start_enabled'),
                Number::make(__('Delay in minutes'), 'head_start'),
            ]),
        ], [
            'normal_request_receipt' => 'integer',
            'normal_reply' => 'integer',
            'quick_notify' => 'integer',
            'quick_contact' => 'integer',
            'quick_reply' => 'integer',

            'quick_notify_enabled' => 'boolean',
            'quick_contact_enabled' => 'boolean',
            'quick_reply_enabled' => 'boolean',

            'head_start' => 'integer',
            'head_start_enabled' => 'boolean',

            'low_credit_threshold' => 'integer',
            'sms_low_threshold' => 'integer',
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Configure the Nova authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        Nova::auth(function ($request) {
            return Gate::check('viewNova', [$request->user()]);
        });
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function (User $user) {
            return $user->hasPermissionTo(PermissionUtils::NOVA_ACCESS);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        $balance = optional(\Auth::user())->getWalletBalance();

        return [
            (new SuppliersCount)->canSeeWhen('viewAdminDashboard', User::class),
            (new RequestDistribution)->canSeeWhen('viewAdminDashboard', User::class),
            (new RequestCount)->canSeeWhen('viewAdminDashboard', User::class),
            (new PendingRequests)->canSeeWhen('viewAdminDashboard', User::class),
            (new RespondedRequests)->canSeeWhen('viewAdminDashboard', User::class),
            (new CancelledRequests)->canSeeWhen('viewAdminDashboard', User::class),
            (new TwilioAccountBalance)->canSeeWhen('viewAdminDashboard', User::class),

            /*
             *  Supplier cards
             */
            (new PendingRequests)
                ->canSeeWhen('viewSupplierDashboard', User::class),

            (new WalletBalanceCard)
                ->creditsAmount($balance ?? 0)
                ->canSeeWhen('viewSupplierDashboard', User::class),

            (new QuickNotifyCard)
                ->showHeadStart(SettingsUtils::get('head_start_enabled', false))
                ->headStartValue(SettingsUtils::get('head_start', 0))
                ->showMessageCost(SettingsUtils::get('quick_notify_enabled', false))
                ->messageCostValue(SettingsUtils::get('quick_notify', 0))
                ->canSeeWhen('viewSupplierDashboard', User::class),

            (new SupplierLastRequestsCard)
                ->canSeeWhen('viewSupplierDashboard', User::class),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            (new Requests)
                ->withMeta(['dashboardName' => 'Requests'])
                ->canSeeWhen('viewAdminDashboard', User::class),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            \ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs::make(),

            new \Anaseqal\NovaImport\NovaImport,

            (new \Quoteme\AdminProfileTool\AdminProfileTool)
                ->canSeeWhen('viewAdminDashboard', User::class),

            (new NovaSettings)
                ->canSeeWhen('viewAdminDashboard', User::class),

            (new \Quoteme\SupplierProfileTool\SupplierProfileTool)
                ->canSeeWhen('viewSupplierDashboard', User::class),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
