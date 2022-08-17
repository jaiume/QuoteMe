<?php

namespace Quoteme\MessageList;

use App\Utils\SettingsUtils;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('message-list', __DIR__.'/../dist/js/tool.js');
            Nova::style('message-list', __DIR__.'/../dist/css/tool.css');
            Nova::provideToScript([
                'quick_contact_enabled' => SettingsUtils::get('quick_contact_enabled', false),
                'quick_reply_enabled' => SettingsUtils::get('quick_reply_enabled', false),
            ]);
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/message-list')
                ->group(__DIR__.'/../routes/api.php');
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
