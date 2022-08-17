<?php

namespace App\Nova;

use App\Casts\PhoneNumberCast;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Dniccum\PhoneNumber\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Admin extends UserResource
{
    use Breadcrumbs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Admin::class;

    /**
     * The columns that should be filled AFTER the model is created.
     * Useful for related fields.
     *
     * @var string[]
     */
    protected static $metaFields = [
        'credit_notification',
        'low_sms_notification',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),

            Boolean::make('Enabled', function () {
                /* @var \App\Models\User $this */

                return !$this->disabled;
            })->hideWhenCreating()
              ->hideWhenUpdating(),

            Boolean::make('Disabled', 'disabled')
                   ->onlyOnForms()
                   ->hideWhenCreating(),

            Text::make('Name', 'name')->sortable(),

            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->sortable(),

            Password::make('Password', 'password')
                    ->onlyOnForms()
                    ->creationRules(['required', 'min:5'])
                    ->updateRules('nullable'),

            Text::make('Phone', 'phone')
                ->displayUsing(fn($value) => PhoneNumberCast::format($value))
                ->exceptOnForms(),

            PhoneNumber::make('Phone', 'phone')
                       ->format('+# ### ###-####')
                       ->useMaskPlaceholder()
                       ->disableValidation()
                       ->rules('nullable', 'phone:AUTO,TT')
                       ->country('TT')
                       ->onlyOnForms(),

            Boolean::make('Credit Purchase Notification', 'credit_notification'),

            Boolean::make('Low SMS Notification', 'low_sms_notification'),

            DateTime::make('Registration Date', 'created_at')
                    ->format(config('app.date_format'))
                    ->readonly(),

            DateTime::make('Last Login', 'last_logged_in')
                    ->format(config('app.date_format'))
                    ->readonly(),
        ];
    }
}
