<?php

namespace App\Models;

use App\Dto\MessageData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

/**
 * Class Message
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $subject
 * @property string $text
 * @property bool $sms
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Message extends Model
{
    use Searchable;

    public $timestamps = false;

    private static array $emptyPlaceholders = [
        'CustomerName' => '',
        'CustomerPhone' => '',
        'CustomerEmail' => '',
        'CustomerReloadLink' => '',
        'RequestCategory' => '',
        'RequestArea' => '',
        'RequestDescription' => '',
        'RequestURL' => '',
        'RequestQuickContact' => '',
        'RequestQuickReply' => '',
        'RequestDetailLink' => '',
        'SupplierName' => '',
        'SupplierPhone' => '',
        'SupplierEmail' => '',
        'ResponseNote' => '',
        'ResponseDetailLink' => '',
        'SupplierValidationLink' => '',
    ];

    protected $fillable = [
        'slug', 'name', 'sms', 'subject', 'text',
    ];

    protected $casts = [
        'sms' => 'boolean',
    ];

    /**
     * @param string[] $placeholders
     * @return MessageData
     */
    public function getMessageData(array $placeholders): MessageData
    {
        $placeholders = array_merge(self::$emptyPlaceholders, $placeholders);
        $keys = array_map(static fn (string $item) => "**{$item}", array_keys($placeholders));
        $values = array_values($placeholders);

        return new MessageData([
            'subject' => is_string($this->subject)
                ? str_replace($keys, $values, $this->subject)
                : $this->subject,
            'text' => is_string($this->text)
                ? str_replace($keys, $values, $this->text)
                : $this->text,
        ]);
    }

    public function toSearchableArray(): array
    {
        return $this->only('slug', 'name', 'subject', 'text');
    }
}
