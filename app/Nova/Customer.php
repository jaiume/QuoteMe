<?php

namespace App\Nova;

use App\Casts\PhoneNumberCast;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Dniccum\PhoneNumber\PhoneNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class Customer extends UserResource
{
    use Breadcrumbs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer::class;

    /**
     * The columns that should be filled AFTER the model is created.
     * Useful for related fields.
     *
     * @var string[]
     */
    protected static $metaFields = [
        'quick_contact',
        'quick_reply',
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
                ->updateRules("unique:users,email,{$request->resourceId}")
                ->sortable(),

            Password::make('Password', 'password')
                    ->onlyOnForms()
                    ->creationRules('required', 'min:5')
                    ->updateRules('nullable'),

            Text::make('Phone', 'phone')
                ->displayUsing(fn($value) => PhoneNumberCast::format($value))
                ->exceptOnForms(),

            PhoneNumber::make('Phone', 'phone')
                       ->format('+# ### ###-####')
                       ->useMaskPlaceholder()
                       ->disableValidation()
                       ->rules('nullable', 'required_with:quick_reply,quick_contact', 'phone:AUTO,TT')
                       ->country('TT')
                       ->onlyOnForms(),

            Boolean::make('QuickContact', 'quick_contact'),

            Boolean::make('QuickReply', 'quick_reply'),

            DateTime::make('Registration Date', 'created_at')
                    ->format(config('app.date_format'))
                    ->readonly(),

            DateTime::make('Last Login', 'last_logged_in')
                    ->format(config('app.date_format'))
                    ->readonly(),
        ];
    }
}
