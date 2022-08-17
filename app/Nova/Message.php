<?php

namespace App\Nova;

use App\Nova\Filters\MessageSmsFilter;
use App\Nova\Filters\MessageTypeFilter;
use App\Nova\Lenses\EmailMessagesLens;
use App\Nova\Lenses\SmsMessagesLens;
use App\Utils\MessageUtils;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Message extends Resource
{
    use Breadcrumbs;

    public static $model = \App\Models\Message::class;

    public static $title = 'slug';

    public static $search = [
        'id', 'slug', 'name', 'subject'
    ];

    public static function label(): string
    {
        return __('Message Templates');
    }

    public function fields(Request $request): array
    {
        switch ($this->slug) {
            case MessageUtils::SLUG_CUSTOMER_RELOAD_EMAIL:
                $placeholders = [
                    'CustomerName', 'CustomerPhone', 'CustomerEmail', 'CustomerReloadLink'
                ];
                break;
            case MessageUtils::SLUG_QUICK_NOTIFY_SMS:
            case MessageUtils::SLUG_NORMAL_REQUEST_EMAIL:
                $placeholders = [
                    'CustomerName', 'CustomerPhone', 'CustomerEmail',
                    'RequestCategory', 'RequestArea', 'RequestDescription', 'RequestURL',
                    'RequestQuickContact', 'RequestQuickReply', 'RequestDetailLink',
                    'SupplierName', 'SupplierPhone', 'SupplierEmail'
                ];
                break;
            case MessageUtils::SLUG_NORMAL_REPLY_EMAIL:
                $placeholders = [
                    'CustomerName', 'CustomerPhone', 'CustomerEmail', 'RequestCategory',
                    'RequestArea', 'RequestDescription', 'RequestURL', 'RequestQuickContact',
                    'RequestQuickReply', 'RequestDetailLink', 'SupplierName', 'SupplierPhone',
                    'SupplierEmail', 'ResponseNote', 'ResponseDetailLink'
                ];
                break;
            case MessageUtils::SLUG_QUICK_REPLY_SMS:
                $placeholders = [
                    'CustomerName', 'CustomerPhone', 'CustomerEmail',
                    'RequestArea', 'RequestDescription', 'RequestURL',
                    'RequestQuickContact', 'RequestQuickReply', 'RequestDetailLink',
                    'SupplierName', 'SupplierPhone', 'SupplierEmail',
                    'ResponseNote', 'ResponseDetailLink',
                ];
                break;
            case MessageUtils::SLUG_SUPPLIER_WELCOME_EMAIL:
            case MessageUtils::SLUG_SUPPLIER_LOW_CREDIT_EMAIL:
            case MessageUtils::SLUG_ADMIN_PURCHASE_EMAIL:
                $placeholders = [
                    'SupplierName', 'SupplierPhone', 'SupplierEmail'
                ];
                break;
            case MessageUtils::SLUG_ADMIN_SMS_LOW_EMAIL:
            default:
                $placeholders = [];
                break;
        }

        if (empty($placeholders)) {
            $placeholderHelpText = __('There are no placeholders for this message');
        } else {
            $placeholderHelpText = __('You can use following placeholders in this message:<br>:placeholders', [
                'placeholders' => implode(', ', array_map(fn (string $item) => "**{$item}", $placeholders)),
            ]);
        }

        return [
            Boolean::make(__('SMS'), 'sms')
                   ->help(__('For internal use only'))
                   ->readonly()
                   ->exceptOnForms()
                   ->sortable(),

            Text::make(__('Slug'), 'slug')
                ->help(__('For internal use only'))
                ->readonly()
                ->sortable(),

            Text::make(__('Name'), 'name')
                ->help(__('For internal use only'))
                ->sortable(),

            Text::make(__('Subject'), 'subject')
                ->help(__('Required for Emails, omitted for SMS'))
                ->rules($this->sms ? '' : 'required')
                ->readonly(function () {
                    return $this->sms;
                })
                ->sortable(),

            Trix::make(__('Text'), 'text')
                ->rules('required')
                ->hideFromIndex()
                ->alwaysShow()
                ->help($placeholderHelpText),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        return $query->orderBy('sms');
    }

    public function filters(Request $request): array
    {
        return [
            new MessageTypeFilter,
        ];
    }
}
