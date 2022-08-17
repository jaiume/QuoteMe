<?php

namespace Quoteme\MessageList\Http\Controllers;

use App\Models\Admin;
use App\Models\QuickContact;
use App\Models\Request;
use App\Models\Response;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class MessageListController
 * @package Quoteme\MessageList\Http\Controllers
 */
class MessageListController extends BaseController
{
    /**
     * @param Request $request
     * @return array[]
     */
    protected static function getRequestMessage(Request $request): array
    {
        return [
            '_id' => 0,
            'content' => $request->text,
            'sender_id' => $request->customer->id,
            'username' => $request->customer->display_name,
            'url' => $request->url,
            'photo' => $request->getFirstMediaUrl('photo'),
            'photo_thumb' => $request->getFirstMediaUrl('photo', 'thumb'),
            'date' => optional($request->created_at)->toFormattedDateString(),
            'timestamp' => optional($request->created_at)->toTimeString('minute'),
        ];
    }

    /**
     * @param Response $response
     * @return array
     */
    protected static function getResponseMessage(Response $response): array
    {
        return [
            '_id' => $response->id,
            'content' => $response->text,
            'price' => $response->price,
            'sender_id' => $response->supplier->id,
            'username' => $response->supplier->display_name,
//            'date' => optional($response->created_at)->toFormattedDateString(),
//            'timestamp' => optional($response->created_at)->toTimeString('minute'),
            'other_suppliers_responses' => $response->request->unfilteredResponses()->where('user_id', '<>', $response->supplier->id)->count(),
            'created_at' => optional($response)->created_at ? $response->created_at->format(config('app.date_format_carbon')) : null,
            'viewed_at' => optional($response)->viewed_at ? $response->viewed_at->format(config('app.date_format_carbon')) : null,
            'listed_at' => optional($response)->listed_at ? $response->listed_at->format(config('app.date_format_carbon')) : null,
        ];
    }

    /**
     * @param HttpRequest $httpRequest
     * @param int $requestId
     * @return JsonResponse
     */
    public function getAmounts(HttpRequest $httpRequest, int $requestId): JsonResponse
    {
        $supplier = Supplier::find(optional($httpRequest->user())->id);

        if ($supplier) {
            $request = Request::findBySupplier($supplier)
                ->where('id', $requestId)
                ->firstOrFail();

            $quickContactCost = SettingsUtils::get('quick_contact', 0);
            $hasEnoughMoneyToQuickContact = $supplier->hasEnoughCredits($quickContactCost);

            $quickReplyCost = SettingsUtils::get('quick_reply', 0);
            $hasEnoughMoneyToQuickReply = $supplier->hasEnoughCredits($quickReplyCost);

            $normalReplyCost = SettingsUtils::get('normal_reply', 0);
            $hasEnoughMoneyToNormalReply = $supplier->hasEnoughCredits($normalReplyCost);

            return response()->json([
                'status' => true,
                'message' => "Amounts for request #${requestId}",
                'data' => [
                    'responded' => $request->unfilteredResponses()->where('user_id', $supplier->id)->count() > 0 || $request->cancelled,
                    'quick_contact_amount' => $quickContactCost,
                    'has_quick_contact_amount' => $hasEnoughMoneyToQuickContact,
                    'quick_reply_amount' => $quickReplyCost,
                    'has_quick_reply_amount' => $hasEnoughMoneyToQuickReply,
                    'normal_reply_amount' => $normalReplyCost,
                    'has_normal_reply_amount' => $hasEnoughMoneyToNormalReply,
                    'request_has_quick_reply' => $request->quick_reply,
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Something went wrong",
        ], 400);
    }

    /**
     * @param HttpRequest $httpRequest
     * @param int $requestId
     * @return JsonResponse
     */
    public function getMessages(HttpRequest $httpRequest, int $requestId): JsonResponse
    {
        $supplier = Supplier::find(optional($httpRequest->user())->id);

        if (!$supplier) {
            $admin = Admin::find(optional($httpRequest->user())->id);

            $messages = [];
            if ($admin) {
                $request = Request
                    ::whereHas('area')
                    ->whereHas('category')
                    ->where('id', $requestId)
                    ->firstOrFail();
            }

            return response()->json([
                'status' => true,
                'message' => "Messages for request #${requestId}",
                'data' => $messages,
            ]);
        }

        try {
            /* @var Request $request */
            $request = Request::findBySupplier($supplier)
                ->with(['responses', 'responses.supplier'])
                ->where('id', $requestId)
                ->firstOrFail();

            $messages = [];

            $request->unfilteredResponses()
                    ->whereHas('supplier', function (Builder $query) use ($supplier) {
                        $query->where('id', $supplier->id);
                    })
                    ->each(function ($response) use (&$messages) {
                        /* @var Response $response */
                        $messages[] = self::getResponseMessage($response);
                    });

            return response()->json([
                'status' => true,
                'message' => "Messages for request #${requestId}",
                'data' => $messages,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => "Request #${requestId} not found",
            ], 400);
        }
    }

    /**
     * @param HttpRequest $httpRequest
     * @param int $requestId
     * @return JsonResponse
     */
    public function postReply(HttpRequest $httpRequest, int $requestId): JsonResponse
    {
        $httpRequest->validate([
            'quick' => 'required|boolean',
            'price' => 'nullable|numeric',
            'text' => 'required|string',
        ]);

        try {
            $supplier = Supplier::findOrFail(optional($httpRequest->user())->id);

            $request = Request::findBySupplier($supplier)
                ->where('id', $requestId)
                ->firstOrFail();

            $isQuickResponse = $httpRequest->input('quick', false);
            $price = $httpRequest->input('price', 0);
            $text = $httpRequest->input('text', '');

            if ($isQuickResponse) {
                $quickReplyEnabled = SettingsUtils::get('quick_reply_enabled', false);

                $quickReplyCost = SettingsUtils::get('quick_reply', 0);
                $hasEnoughMoneyToQuickReply = $supplier->hasEnoughCredits($quickReplyCost);

                if (!$quickReplyEnabled || !$hasEnoughMoneyToQuickReply) {
                    return response()->json([
                        'status' => false,
                        'message' => 'QuickResponse is not eligible for this request',
                    ], 400);
                }
            }

            $normalReplyCost = SettingsUtils::get('normal_reply', 0);
            $hasEnoughMoneyToNormalReply = $supplier->hasEnoughCredits($normalReplyCost);

            if (!$hasEnoughMoneyToNormalReply) {
                return response()->json([
                    'status' => false,
                    'message' => 'This action is not eligible for this request',
                ], 400);
            }

            $response = Response::make([
                'price' => $price,
                'text' => $text,
                'quick' => $isQuickResponse,
            ]);
            $response->supplier()->associate($supplier);
            $response->request()->associate($request);

            if ($response->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Response sent',
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ], 400);
        }
    }

    /**
     * @param HttpRequest $httpRequest
     * @param int $requestId
     * @return JsonResponse
     */
    public function postQuickContact(HttpRequest $httpRequest, int $requestId): JsonResponse
    {
        $supplier = Supplier::find(optional($httpRequest->user())->id);

        if ($supplier) {
            $request = Request::findOrFail($requestId);

            try {
                /* If the user already paid for the QuickContact on this request */
                $quickContact = \App\Models\QuickContact
                    ::whereHas('request', function (Builder $query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->whereHas('supplier', function (Builder $query) use ($supplier) {
                        $query->where('id', $supplier->id);
                    })
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                /* If the user isn't payed */

                /* Check if user don't have enough money */
                $quickContactCost = SettingsUtils::get('quick_contact', 0);
                $hasEnoughMoneyToQuickContact = $supplier->hasEnoughCredits($quickContactCost);

                if (!$hasEnoughMoneyToQuickContact) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Not enough money',
                    ]);
                }

                /* User has enough money => create new QuickContact record */
                $quickContact = \App\Models\QuickContact::make();
                $quickContact->request()->associate($request);
                $quickContact->supplier()->associate($supplier);
            }

            if ($quickContact->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Successful Quick Contact',
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Request not found',
        ]);
    }

    /**
     * @param HttpRequest $httpRequest
     * @param int $requestId
     * @return JsonResponse
     */
    public function getQuickContact(HttpRequest $httpRequest, int $requestId): JsonResponse
    {
        $request = Request::where('id', $requestId)->first();

        $supplierId = optional($httpRequest->user())->id ?? 0;

        /* @var QuickContact|null $quickContact */
        $quickContact = optional($request)
            ->quickContacts()
            ->whereHas('supplier', function (Builder $query) use ($supplierId) {
                $query->where('id', $supplierId);
            })
            ->first();

        if ($request) {
            $available = $quickContact !== null;

            $fields = [
                'enabled' => $request->quick_contact,
                'available' => $available,
            ];
            try {
                $fields['name'] = $quickContact->request->customer->name;
                $fields['phone'] = $quickContact->request->customer->phone;
                $fields['email'] = $quickContact->request->customer->email;
            } catch (\Exception $e) {
                // Do nothing
            }

            return response()->json([
                'status' => true,
                'data' => $fields,
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'enabled' => false,
                'available' => false,
            ],
        ]);
    }
}
