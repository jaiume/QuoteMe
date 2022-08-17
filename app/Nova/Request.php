<?php

namespace App\Nova;

use App\Models\User;
use App\Nova\Metrics\PendingRequests;
use App\Nova\Metrics\RequestCount;
use App\Utils\RequestStatus;
use App\Utils\SettingsUtils;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Quoteme\MessageList\MessageList;
use Quoteme\OpengraphField\OpengraphField;

/**
 * Class Request
 * @package App\Nova
 */
class Request extends Resource
{
    use Breadcrumbs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Request::class;

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
        'id', 'text', 'url',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(\Illuminate\Http\Request $request)
    {
        $userId = $request->user()->id;

        $response = $this->responses()
                         ->where('user_id', $userId)
                         ->first();

        return [
            DateTime::make(__('Date Created'), 'created_at')
                    ->sortable()
                    ->format(config('app.date_format')),

            Text::make(__('Area'), function () {
                return optional($this->area)->name;
            })
                ->readonly(),

            Text::make(__('Category'), function () {
                return optional($this->category)->name;
            })
                ->readonly(),

            BelongsTo::make(__('Customer'), 'customer', Customer::class)
                     ->canSeeWhen('viewAdminDashboard', User::class),

            BelongsTo::make(__('Area'), 'area', Area::class)
                     ->hideFromIndex()
                     ->canSeeWhen('viewAdminDashboard', User::class),

            BelongsTo::make(__('Category'), 'category', Category::class)
                     ->hideFromIndex()
                     ->canSeeWhen('viewAdminDashboard', User::class),

            Textarea::make(__('Description'), 'text')
                    ->hideFromIndex()
                    ->alwaysShow()
                    ->readonly(),

            Text::make(__('Description'), function (): ?string {
                /* @var \App\Models\Request $this */
                return is_string($this->text)
                    ? Str::limit($this->text, 32)
                    : null;
            })->onlyOnIndex(),

            Text::make(__('URL'), 'url')
                ->onlyOnForms()
                ->readonly(),

            OpengraphField::make(__('URL'), 'url')
                          ->onlyOnDetail()
                          ->openGraphUrl($this->url),

            Images::make(__('Photo'), 'photo')
                  ->conversionOnIndexView('thumb')
                  ->hideFromIndex(),

            Text::make(__('Status'), function () use ($response): ?string {
                /* @var \App\Models\Request $this */

                $class = 'bg-success';

                if ($this->getStatusForResponse($response) === RequestStatus::CANCELLED) {
                    $class = 'bg-danger';
                }

                if ($this->getStatusForResponse($response) === RequestStatus::VIEWED) {
                    $class = 'bg-info';
                }

                if ($this->getStatusForResponse($response) === RequestStatus::LISTED) {
                    $class = 'bg-info';
                }

                if ($this->getStatusForResponse($response) === RequestStatus::RESPONDED) {
                    $class = 'bg-yellow';
                }

                return view('nova.partials.request.status', [
                    'status' => Str::title($this->getStatusForResponse($response)),
                    'class' => $class,
                ])->render();
            })
                ->asHtml()
                ->sortable(),

            MessageList::make()->canSeeWhen('viewSupplierDashboard', \App\Models\User::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(\Illuminate\Http\Request $request)
    {
        return [
            new RequestCount,
            new PendingRequests,
        ];
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
        $headStartEnabled = SettingsUtils::get('head_start_enabled', false);
        $headStartDuration = (int)SettingsUtils::get('head_start', 0);

        $timezone = Nova::resolveUserTimezone($request) ?? $request->timezone;

        $supplier = \App\Models\Supplier::find(\Auth::id());

        if ($supplier && $supplier->isEnabled()) {
            $availableRequests =
                DB::table('requests', 'r')
                  ->select(
                      'r.id',
                      DB::raw('count(responses.id) as response_count')
                  )
                  ->leftJoin('suppliers_areas as sa', 'r.area_id', '=', 'sa.area_id')
                  ->leftJoin('suppliers_categories as sc', 'r.category_id', '=', 'sc.category_id')
                  ->leftJoin('users as suppliers', function ($join) {
                      $join->on('sa.user_id', '=', 'suppliers.id');
                      $join->on('sc.user_id', '=', 'suppliers.id');
                  })
                  ->leftJoin('users as customers', function ($join) {
                      $join->on('r.user_id', '=', 'customers.id');
                  })
                  ->leftJoin('responses', function ($join) {
                      $join->on('responses.request_id', '=', 'r.id');
                      $join->on('responses.user_id', '=', 'suppliers.id');
                  });

            if ($headStartEnabled && $headStartDuration > 0 && !$supplier->quick_notify) {
                $successfulQuickNotifies =
                    DB::table('requests', 'r')
                      ->select('r.id', DB::raw('count(ct.id) as count'))
                      ->leftJoin('suppliers_areas as sa', 'r.area_id', '=', 'sa.area_id')
                      ->leftJoin('suppliers_categories as sc', 'r.category_id', '=', 'sc.category_id')
                      ->leftJoin('users as suppliers', function ($join) {
                          $join->on('sa.user_id', '=', 'suppliers.id');
                          $join->on('sc.user_id', '=', 'suppliers.id');
                      })
                      ->leftJoin('credit_transactions as ct', function ($join) {
                          $join->on('suppliers.id', '=', 'ct.user_id');
                          $join->on('ct.model_id', '=', 'r.id');
                      })
                      ->where('ct.model_type', 'App\\Models\\Request')
                      ->where('ct.successful', true)
                      ->where('ct.description', 'Quick Notify')
                      ->groupBy('r.id');

                $availableRequests->leftJoinSub($successfulQuickNotifies, 'successful_qn', function (JoinClause $join) {
                    $join->on('r.id', '=', 'successful_qn.id');
                });

                $availableRequests->where(function ($q) use ($timezone, $headStartDuration) {
                    $q->where('successful_qn.count', '>', 0)
                      ->orWhere('r.created_at', '<=', now($timezone)->subMinutes($headStartDuration)->format('Y-m-d H:i:s'));
                });
            }

            $availableRequests->where('suppliers.id', $supplier->id)
                              ->where('customers.disabled', '=', 0)
                              ->groupBy('r.id')
                              ->orderByDesc('r.created_at');

            return parent::indexQuery(
                $request,
                $query->joinSub($availableRequests, 'available', function (JoinClause $join) {
                    $join->on('requests.id', '=', 'available.id');
                })
            );
        }

        return parent::indexQuery($request, $query)->orderByDesc('created_at');
    }
}
