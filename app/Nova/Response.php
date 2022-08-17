<?php

namespace App\Nova;

use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Response extends Resource
{
    use Breadcrumbs;

    public static $model = \App\Models\Response::class;

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Currency::make('Price', 'price'),

            Text::make('Text', function (): ?string {
                /* @var \App\Models\Response $this */
                return Str::limit($this->text, 100);
            })
                ->onlyOnIndex(),

            Textarea::make('Text', 'text')
                    ->alwaysShow()
                    ->hideFromIndex(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $supplier = \App\Models\Supplier::find(\Auth::id());
        if ($supplier) {
            /* @var \App\Models\Supplier $supplier */
            $availableRequests =
                DB::table('users', 'u')
                  ->select('r.id')
                  ->where('u.id', $supplier->id)
                  ->leftJoin('responses as r', function ($join) {
                      $join->on('u.id', '=', 'r.user_id');
                  });

            return parent::indexQuery(
                $request,
                $query->joinSub($availableRequests, 'available', function ($join) {
                    $join->on('responses.id', '=', 'available.id');
                })
            );
        }

        return parent::indexQuery($request, $query);
    }
}
