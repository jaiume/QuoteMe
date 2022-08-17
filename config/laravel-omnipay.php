<?php

return [
    'default' => '2checkout',

    'gateways' => [
        '2checkout' => [
            'driver' => 'TwoCheckout',
            'options' => [
                'accountNumber' => env('2CHECKOUT_MERCHANT_CODE', ''),
                'secretWord' => env('2CHECKOUT_SECRET_WORD', ''),
                'demoMode' => true, // if true, transaction with the live checkout URL will be a demo sale and card won't be charged.
            ]
        ]
    ]
];
