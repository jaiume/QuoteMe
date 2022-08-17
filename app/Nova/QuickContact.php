<?php

namespace App\Nova;

use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class QuickContact extends Resource
{
    use Breadcrumbs;

    public static $model = \App\Models\QuickContact::class;

    public static $displayInNavigation = false;

    public static $searchable = false;

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey(): string
    {
        return 'quick-contacts';
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
            BelongsTo::make(__('Request'), 'request'),

            Text::make(__('Name'), 'name')
                ->sortable(),

            Text::make(__('Email'), 'email')
                ->sortable(),

            Text::make(__('Phone'), 'phone')
                ->sortable(),
        ];
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        $resourceId = $request->resourceId ?? 0;
        $supplier = \App\Models\Supplier::find(optional($request->user())->id);

        if ($resourceId && $supplier && $supplier->isEnabled()) {
            $availableItems = DB::table('users as c')
                                ->select(['qc.id as id', 'c.name as name', 'c.email as email', 'c.phone as phone', 'r.id as request_id'])
                                ->leftJoin('requests as r', 'r.user_id', '=', 'c.id')
                                ->leftJoin('quick_contacts as qc', 'qc.request_id', '=', 'r.id')
                                ->where('qc.id', $resourceId)
                                ->where('qc.supplier_id', $supplier->id);

            return parent::detailQuery($request, $query->joinSub($availableItems, 'available', function ($join) {
                $join->on('quick_contacts.id', '=', 'available.id');
            }));
        }

        return parent::indexQuery($request, $query->where('id', '<', '0')); // Always empty
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
        $supplier = \App\Models\Supplier::find(optional($request->user())->id);

        if ($supplier && $supplier->isEnabled()) {
            $availableItems = DB::table('users as c')
                                ->select(['qc.id as id', 'c.name as name', 'c.email as email', 'c.phone as phone', 'r.id as request_id'])
                                ->leftJoin('requests as r', 'r.user_id', '=', 'c.id')
                                ->leftJoin('quick_contacts as qc', 'qc.request_id', '=', 'r.id')
                                ->where('qc.supplier_id', $supplier->id);

            return parent::detailQuery($request, $query->joinSub($availableItems, 'available', function ($join) {
                $join->on('quick_contacts.id', '=', 'available.id');
            }));
        }

        return parent::indexQuery($request, $query->where('id', '<', '0')); // Always empty
    }


}
