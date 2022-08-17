<?php

namespace Quoteme\WalletBalanceCard;

use Laravel\Nova\Card;

/**
 * Class WalletBalanceCard
 * @package Quoteme\WalletBalanceCard
 */
class WalletBalanceCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'wallet-balance-card';
    }

    /**
     * @param float $amount
     * @return WalletBalanceCard
     */
    public function creditsAmount(float $amount = 0): WalletBalanceCard
    {
        return $this->withMeta([
            'amount' => $amount
        ]);
    }

    /**
     * @param bool $show
     * @return WalletBalanceCard
     */
    public function showBuyButton(bool $show = true): WalletBalanceCard
    {
        return $this->withMeta([
            'showBuyButton' => $show
        ]);
    }
}
