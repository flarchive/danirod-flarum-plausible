<?php

namespace Danirod\FlarumPlausible;

use Illuminate\Support\Arr;

class Utils
{
    public static function getHostname(): string
    {
        $install_url = Arr::get(app('flarum.config'), 'url');
        $hostname = Arr::get(parse_url($install_url), 'host');
        return $hostname;
    }
}
