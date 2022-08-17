<?php

namespace App\Nova\Lenses;

use App\Utils\PermissionUtils;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class CustomerUsersLens extends Lens
{
    /**
     * The displayable name of the lens.
     *
     * @var string
     */
    public $name = 'Customers';

    /**
     * Get the columns that should be selected.
     *
     * @return string[]
     */
    protected static function columns(): array {
        return [
            'users.id',
            'users.disabled',
            'users.name',
            'users.email',
            'users.phone',
            'users.created_at',
            'users.last_logged_in',
        ];
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                  ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                  ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                  ->where('roles.name', PermissionUtils::ROLE_CUSTOMER)
        ));
    }

    /**
     * Get the fields available to the lens.
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

            Text::make('Name', 'name')->sortable(),

            Text::make('Email', 'email')->sortable(),

            Text::make('Phone', 'phone'),

            DateTime::make('Registration Date', 'created_at')
                    ->format(config('app.date_format'))
                    ->readonly(),

            DateTime::make('Last Login', 'last_logged_in')
                    ->format(config('app.date_format'))
                    ->readonly(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'customers';
    }
}
