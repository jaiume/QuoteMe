<?php

namespace App\Nova;

use App\Casts\PhoneNumberCast;
use App\Models\User;
use App\Nova\Actions\ComplimentaryCredits;
use App\Nova\Actions\ImportSuppliersFromCsv;
use App\Nova\Actions\ResetUserPassword;
use App\Nova\Actions\SupplierCsvExport;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Dniccum\PhoneNumber\PhoneNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\MultiselectField\Multiselect;

class Supplier extends UserResource
{
    use Breadcrumbs;

    public static $model = \App\Models\Supplier::class;

    protected static $metaFields = [
        'quick_notify',
    ];

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
                       ->rules('nullable', 'required_with:quick_notify', 'phone:AUTO,TT')
                       ->country('TT')
                       ->onlyOnForms(),

            Multiselect::make('Area', 'areas')
                       ->belongsToMany(Area::class, false),

            Multiselect::make('Category', 'categories')
                       ->belongsToMany(Category::class, false),

            DateTime::make('Registration Date', 'created_at')
                    ->exceptOnForms()
                    ->format(config('app.date_format'))
                    ->readonly(),

            Boolean::make('QuickNotify', 'quick_notify'),

            DateTime::make('Last Login', 'last_logged_in')
                    ->exceptOnForms()
                    ->format(config('app.date_format'))
                    ->readonly(),
        ];
    }

    public function actions(Request $request): array
    {
        return [
            (new ImportSuppliersFromCsv)
                ->canSeeWhen('viewAdminDashboard', User::class),

            (new SupplierCsvExport())
                ->canSeeWhen('viewAdminDashboard', User::class)
                ->canRun(function (NovaRequest $request) {
                    return $request->user()->can('viewAdminDashboard', User::class);
                }),

            (new ComplimentaryCredits())
                ->canSeeWhen('viewAdminDashboard', User::class)
                ->canRun(function (NovaRequest $request) {
                    return $request->user()->can('viewAdminDashboard', User::class);
                })
                ->showOnTableRow(),

            (new ResetUserPassword())
                ->onlyOnTableRow()
                ->canSeeWhen('viewAdminDashboard', User::class)
                ->canRun(function (NovaRequest $request) {
                    return $request->user()->can('viewAdminDashboard', User::class);
                }),
        ];
    }
}
