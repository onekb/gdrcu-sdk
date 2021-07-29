<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Kernel\Providers;

use Onekb\Gdrcu\Kernel\Sign;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class SignServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['sign']) && $pimple['sign'] = function ($app) {
            return new Sign($app);
        };
    }
}
