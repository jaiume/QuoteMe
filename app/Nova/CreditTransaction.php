<?php

namespace App\Nova;

use App\Models\User;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class CreditTransaction extends Resource
{
    use Breadcrumbs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\CreditTransaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Determine if this resource is searchable.
     *
     * @var bool
     */
    public static $searchable = false;


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
        return __('Transactions');
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $supplier = \App\Models\Supplier::find(\Auth::id());
        if ($supplier && $supplier->isEnabled()) {
            $query = $query->where('user_id', $supplier->id);
        }

        return $query->orderByDesc('created_at');
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
            ID::make(__('ID'), 'id'),

            BelongsTo::make(__('Supplier'), 'user')
                     ->canSeeWhen('viewAdminDashboard', User::class),

            Boolean::make(__('Successful'), 'successful')
                   ->sortable()
                   ->readonly(),

            DateTime::make(__('Date / Time'), 'created_at')
                    ->format(config('app.date_format'))
                    ->sortable()
                    ->readonly(),

            Text::make(__('Description'), 'description')
                ->sortable()
                ->readonly(),

            Number::make(__('Amount'), 'amount')
                    ->displayUsing(fn ($amount) => $amount . ' ' . Str::plural('credit', $amount))
                    ->sortable()
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
        $balance = optional(\Auth::user())->getWalletBalance();

        return [
            (new \Quoteme\BuyCreditsCard\BuyCreditsCard)
                ->withPlans()
                ->withCurrency(config('currency.default'))
                ->creditsAmount($balance ?? 0)
                ->canSeeWhen('viewSupplierDashboard', \App\Models\User::class),
        ];
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
        return [];
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
