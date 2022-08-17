<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Spatie\Permission\Models\Role;
use Vyuldashev\NovaPermission\RoleBooleanGroup;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;

class User extends Resource
{
    use Breadcrumbs;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Users';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Indicates if the resource should be globally searchable.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('All Users');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Boolean::make('Enabled', function () {
                /* @var \App\Models\User $this */

                return !$this->disabled;
            })->hideWhenCreating()
              ->hideWhenUpdating(),

            Boolean::make('Disabled', 'disabled')
                   ->onlyOnForms(),

            Boolean::make('Needs Password Reset', 'password_reset_required')
                   ->onlyOnForms(),

            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'string', 'max:254'),

            Text::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules("unique:users,email,{$request->resourceId}")
                ->sortable(),

            Text::make('Phone', 'phone'),

            RoleBooleanGroup::make('Roles')->onlyOnForms(),
            Text::make('Role', function () {
                /* @var \App\Models\User $this */

                /* @var Collection $roles */
                $roles = $this->roles;

                return $roles->isNotEmpty()
                    ? $roles
                        ->map(fn(Role $role) => $role->name)
                        ->join(', ')
                    : '—';
            })->onlyOnIndex(),

            Password::make('Password', 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            DateTime::make('Registration Date', 'created_at')
                    ->exceptOnForms()
                    ->format(config('app.date_format'))
                    ->readonly(),

            DateTime::make('Last Login', 'last_logged_in')
                    ->exceptOnForms()
                    ->format(config('app.date_format'))
                    ->readonly(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\SupplierUsersLens(),
            new Lenses\CustomerUsersLens(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
