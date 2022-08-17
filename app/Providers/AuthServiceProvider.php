<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Plan;
use App\Models\QuickContact;
use App\Models\Request;
use App\Models\Response;
use App\Models\Supplier;
use App\Models\Area;
use App\Models\Category;
use App\Policies\QuickContactPolicy;
use App\Policies\RequestPolicy;
use App\Policies\ResourcePolicy;
use App\Policies\ResponsePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Admin::class => UserPolicy::class,
        Supplier::class => UserPolicy::class,
        Customer::class => UserPolicy::class,
        /* Nova resources */
        QuickContact::class => QuickContactPolicy::class,
        Request::class => RequestPolicy::class,
        Response::class => ResponsePolicy::class,
        Plan::class => ResourcePolicy::class,
        Area::class => ResourcePolicy::class,
        Category::class => ResourcePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
