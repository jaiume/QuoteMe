<?php

namespace Quoteme\MessageList;

use Brick\Money\Money;
use Laravel\Nova\ResourceTool;

class MessageList extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Message List';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'message-list';
    }
}
