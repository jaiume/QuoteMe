<?php

namespace Quoteme\SupplierLastRequestsCard;

use App\Models\Request;
use App\Models\Supplier;
use App\Utils\RequestStatus;
use App\Utils\SettingsUtils;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Nova\Card;

class SupplierLastRequestsCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Create a new element.
     *
     * @param string|null $component
     * @return void
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        try {
            $supplier = Supplier::with(['categories', 'areas'])->findOrFail(\Auth::id());

            $fetch = Request
                ::findBySupplier($supplier)
                ->with('customer')
                ->orderByDesc('created_at')
                ->limit(10);

            $headStartEnabled = SettingsUtils::get('head_start_enabled', false);
            $headStartDuration = (int)SettingsUtils::get('head_start', 0);
            if ($headStartEnabled && $headStartDuration > 0 && !$supplier->quick_notify) {
                $timezone = null;

                $successfulQuickNotifies =
                    DB::table('requests', 'r')
                      ->select('r.id as rid', DB::raw('count(ct.id) as count'))
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

                $fetch->leftJoinSub($successfulQuickNotifies, 'successful_qn', function (JoinClause $join) {
                    $join->on('requests.id', '=', 'successful_qn.rid');
                });

                $fetch->where(function ($q) use ($timezone, $headStartDuration) {
                    $q->where(function ($query) {
                        $query->where('successful_qn.count', '>', 0);
                        $query->orWhereNull('successful_qn.count');
                    })
                      ->orWhere('requests.created_at', '<=', now($timezone)->subMinutes($headStartDuration)->format('Y-m-d H:i:s'));
                });

            }

            $this->withMeta([
                'resources' =>
                    $fetch
                        ->get()
                        ->map(function (Request $item) use ($supplier) {
                            $response = $item->responses()
                                             ->where('user_id', $supplier->id)
                                             ->first();

                        $class = 'bg-success';

                        if ($item->getStatusForResponse($response) === RequestStatus::CANCELLED) {
                            $class = 'bg-danger';
                        }

                        if ($item->getStatusForResponse($response) === RequestStatus::VIEWED) {
                            $class = 'bg-info';
                        }

                        if ($item->getStatusForResponse($response) === RequestStatus::LISTED) {
                            $class = 'bg-info';
                        }

                        if ($item->getStatusForResponse($response) === RequestStatus::RESPONDED) {
                            $class = 'bg-yellow';
                        }

                        $status = Str::title($item->getStatusForResponse($response));

                        return [
                            'actions' => [],
                            'authorizedToCreate' => false,
                            'authorizedToDelete' => false,
                            'authorizedToForceDelete' => false,
                            'authorizedToRestore' => false,
                            'authorizedToUpdate' => false,
                            'authorizedToView' => true,
                            'authorizedToRelate' => false,
                            'label' => __('Requests'),
                            'softDeleted' => false,
                            'softDeletes' => false,
                            'title' => $item->id,
                            'id' => [
                                'attribute' => 'id',
                                'validationKey' => 'id',
                                'sortableUriKey' => 'id',
                                'component' => 'id-field',
                                'indexName' => __('ID'),
                                'name' => __('ID'),
                                'nullable' => false,
                                'sortable' => false,
                                'required' => false,
                                'readonly' => false,
                                'prefixComponent' => true,
                                'textAlign' => 'left',
                                'value' => $item->id,
                            ],
                            'fields' => [
                                [
                                    'attribute' => "created_at",
                                    'component' => "date-time",
                                    'format' => "DD/MM/YYYY hh:mm:ss",
                                    'helpText' => null,
                                    'indexName' => __('Date Created'),
                                    'name' => __('Date Created'),
                                    'nullable' => false,
                                    'panel' => null,
                                    'prefixComponent' => true,
                                    'readonly' => false,
                                    'required' => false,
                                    'sortable' => false,
                                    'sortableUriKey' => "created_at",
                                    'stacked' => false,
                                    'textAlign' => "left",
                                    'validationKey' => "created_at",
                                    'value' => $item->created_at, // "2020-11-12 12:11:14.000000"
                                ],
                                [
                                    'attribute' => "ComputedField",
                                    'component' => "text-field",
                                    'helpText' => null,
                                    'indexName' => __('Customer'),
                                    'name' => __('Customer'),
                                    'nullable' => false,
                                    'panel' => null,
                                    'prefixComponent' => true,
                                    'readonly' => false,
                                    'required' => false,
                                    'sortable' => false,
                                    'sortableUriKey' => "ComputedField",
                                    'stacked' => false,
                                    'textAlign' => "left",
                                    'validationKey' => "ComputedField",
                                    'value' => optional($item->customer)->display_name,
                                ],
                                [
                                    'attribute' => "ComputedField",
                                    'component' => "text-field",
                                    'helpText' => null,
                                    'indexName' => __('Description'),
                                    'name' => __('Description'),
                                    'nullable' => false,
                                    'panel' => null,
                                    'prefixComponent' => true,
                                    'readonly' => false,
                                    'required' => false,
                                    'sortable' => false,
                                    'sortableUriKey' => "ComputedField",
                                    'stacked' => false,
                                    'textAlign' => "left",
                                    'validationKey' => "ComputedField",
                                    'value' => is_string($item->text) ? Str::limit($item->text, 32) : null,
                                ],
                                [
                                    'asHtml' => true,
                                    'attribute' => "ComputedField",
                                    'component' => "text-field",
                                    'helpText' => null,
                                    'indexName' => __('Status'),
                                    'name' => __('Status'),
                                    'nullable' => false,
                                    'panel' => null,
                                    'prefixComponent' => true,
                                    'readonly' => false,
                                    'required' => false,
                                    'sortable' => false,
                                    'sortableUriKey' => "ComputedField",
                                    'stacked' => false,
                                    'textAlign' => "left",
                                    'validationKey' => "ComputedField",
                                    'value' => sprintf('
                                    <div class="whitespace-no-wrap">
                                        <span class="%s text-white py-1 px-2 rounded-lg text-xs">%s</span>
                                    </div>
                                ', $class, $status),
                                ],
                            ]
                        ];
                    }),
            ]);
        } catch (ModelNotFoundException $e) {
            // Do nothing
        }
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'supplier-last-requests-card';
    }
}
