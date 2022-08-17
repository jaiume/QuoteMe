<?php

namespace Quoteme\CollapsibleSidebar;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CollapsibleSidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('collapsible-sidebar', __DIR__.'/../dist/js/collapsible-sidebar.js');
            Nova::style('collapsible-sidebar', __DIR__.'/../dist/css/collapsible-sidebar.css');
        });
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
