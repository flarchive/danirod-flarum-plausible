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

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->content(PlausibleTagRenderer::class),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__.'/locale'),
];
