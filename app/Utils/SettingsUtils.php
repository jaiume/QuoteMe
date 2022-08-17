<?php


namespace App\Utils;


use Illuminate\Support\Facades\Cache;

class SettingsUtils
{
    public static function get(string $key, $default = null)
    {
        return Cache::rememberForever(CacheUtils::getSettingsCacheName($key), function () use ($key, $default) {
            return nova_get_setting($key, $default);
        });
    }
}
