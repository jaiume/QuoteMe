<?php

namespace App\Dto;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class MessageData
 *
 * @package App\Dto
 */
class MessageData extends DataTransferObject
{
    public ?string $subject;
    public string $text;
}
