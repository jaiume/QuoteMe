<?php

namespace App\Models;

use App\Utils\CacheUtils;
use Illuminate\Support\Facades\Cache;

/**
 * Class Settings
 *
 * @property string $key
 * @property mixed $value
 *
 * @package App\Models
 */
class Settings extends \OptimistDigital\NovaSettings\Models\Settings
{
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_array($value) ? json_encode($value) : $value;

        Cache::forget(CacheUtils::getSettingsCacheName($this->key));
    }
}
