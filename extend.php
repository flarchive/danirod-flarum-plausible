<?php

/*
 * This file is part of danirod/flarum-plausible.
 *
 * Copyright (c) 2023 Dani Rodríguez.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Danirod\FlarumPlausible;

use Danirod\FlarumPlausible\Listener\SettingsSavingListener;
use Flarum\Extend;
use Flarum\Settings\Event\Saving;
use Illuminate\Support\Arr;

$hostname = Utils::getHostname();

return [
    (new Extend\Frontend('forum'))
        ->content(PlausibleTagRenderer::class),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Event)
        ->listen(Saving::class, SettingsSavingListener::class),
    (new Extend\Settings)
        ->default('danirod-plausible.domain', $hostname),
];
