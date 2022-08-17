<?php


namespace Quoteme\BuyCreditsCard\Http\Controllers;

use App\Models\CreditTransaction;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Omnipay\TwoCheckoutPlus\Message\PurchaseResponse;
use Quoteme\BuyCreditsCard\Http\Requests\BuyCreditsRequest;
use Omnipay\Omnipay;

class BuyCreditsCardController extends BaseController
{
    public function buy(BuyCreditsRequest $request): JsonResponse
    {
        /* @var User $user */
        $user = $request->user();

        try {
            $plan = Plan::findOrFail($request->input('plan'));
            $transaction = CreditTransaction::make([
                'description' => __('Buy Credits'),
                'amount' => $plan->credits_amount,
                'successful' => false,
            ]);

            $status = $transaction
                ->user()
                ->associate($user)
                ->save();

            $transaction->save();

            /* OMNIPAY */
            $gateway = Omnipay::create('TwoCheckoutPlus');
            $gateway->initialize([
                'accountNumber' => config('laravel-omnipay.gateways.2checkout.options.accountNumber'),
                'secretWord' => config('laravel-omnipay.gateways.2checkout.options.secretWord'),
                'demoMode' => config('laravel-omnipay.gateways.2checkout.options.demoMode'),
            ]);
            $cart = [
                [
                    'type' => 'product',
                    'name' => __(':amount QuoteMe Credits', ['amount' => $transaction->amount]),
                    'quantity' => 1,
                    'price' => number_format($plan->price, 2),
                ],
            ];

            /** @var PurchaseResponse $response */
            $response = $gateway->purchase([
                'returnUrl' => route('payment.confirm'),
                'cancelUrl' => route('payment.confirm'),
                'amount' => number_format($plan->price, 2),
                'currency' => config('currency.default'),
                'transactionId' => $transaction->id,
            ])->setCart($cart)->send();

            return response()->json([
                'status' => $status,
                'redirect' => $response->isRedirect(),
                'redirect_url' => $response->getRedirectUrl(),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false
            ], 404);
        }
    }

    public function confirm(Request $request)
    {
//        #[ArrayShape([
//            'order_number' => 'string',
//            'invoice_id' => 'string',
//            'merchant_order_id' => 'string',
//        ])]
        $data = $request->all();

        $gateway = Omnipay::create('TwoCheckoutPlus');
        $gateway->initialize([
            'accountNumber' => config('laravel-omnipay.gateways.2checkout.options.accountNumber'),
            'secretWord' => config('laravel-omnipay.gateways.2checkout.options.secretWord'),
            'demoMode' => config('laravel-omnipay.gateways.2checkout.options.demoMode'),
        ]);

        $response = $gateway->completePurchase($data)->send();
        if ($response->isSuccessful()) {
            $transaction = CreditTransaction::find($data['merchant_order_id']);

            if ($transaction && $transaction->update(['successful' => true])) {
                return redirect()->to(config('nova.path') . '/resources/credit-transactions');
            }
        }

        return redirect()->to(config('nova.path') . '/resources/credit-transactions');
    }
}
