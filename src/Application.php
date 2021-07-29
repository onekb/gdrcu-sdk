<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu;

use Onekb\Gdrcu\Kernel\ServiceContainer;
use Onekb\Gdrcu\Powers\Order\OrderServiceProvider;

class Application extends ServiceContainer
{
    protected $providers = [
        OrderServiceProvider::class,
    ];
}
