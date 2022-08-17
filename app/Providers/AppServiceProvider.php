<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Category;
use App\Models\CreditTransaction;
use App\Models\QuickContact;
use App\Models\Request;
use App\Models\Response;
use App\Models\Supplier;
use App\Observers\AreaObserver;
use App\Observers\CategoryObserver;
use App\Observers\QuickContactObserver;
use App\Observers\RequestObserver;
use App\Observers\ResponseObserver;
use App\Observers\SupplierObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $code = substr(str_shuffle('0123456789'), 0, 6);
        Redis::set("phone-verification:123", $code);


        Area::observe(AreaObserver::class);
        Category::observe(CategoryObserver::class);
        QuickContact::observe(QuickContactObserver::class);
        Request::observe(RequestObserver::class);
        Response::observe(ResponseObserver::class);
        Supplier::observe(SupplierObserver::class);
        CreditTransaction::observe(TransactionObserver::class);
    }
}
