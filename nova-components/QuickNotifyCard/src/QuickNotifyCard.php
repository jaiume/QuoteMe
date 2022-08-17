<?php

namespace Quoteme\QuickNotifyCard;

use Laravel\Nova\Card;

class QuickNotifyCard extends Card
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
        return 'quick_notify_card';
    }

    /**
     * @param bool $status
     * @return QuickNotifyCard
     */
    public function showHeadStart(bool $status = true): QuickNotifyCard
    {
        return $this->withMeta([
            'showHeadStart' => $status,
        ]);
    }

    /**
     * @param bool $status
     * @return QuickNotifyCard
     */
    public function showMessageCost(bool $status = true): QuickNotifyCard
    {
        return $this->withMeta([
            'showMessageCost' => $status,
        ]);
    }

    /**
     * @param string $value
     * @return QuickNotifyCard
     */
    public function headStartValue(string $value): QuickNotifyCard
    {
        return $this->withMeta([
            'headStart' => $value,
        ]);
    }

    /**
     * @param string $value
     * @return QuickNotifyCard
     */
    public function messageCostValue(string $value): QuickNotifyCard
    {
        return $this->withMeta([
            'messageCost' => $value,
        ]);
    }

    /**
     * @param string $value
     * @return QuickNotifyCard
     */
    public function headStartUnit(string $value): QuickNotifyCard
    {
        return $this->withMeta([
            'headStartUnit' => $value,
        ]);
    }

    /**
     * @param string $value
     * @return QuickNotifyCard
     */
    public function messageCostUnit(string $value): QuickNotifyCard
    {
        return $this->withMeta([
            'mesasgeCostUnit' => $value,
        ]);
    }
}
