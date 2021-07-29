<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Kernel\Providers;

use Onekb\Gdrcu\Kernel\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['http']) && $pimple['http'] = function ($app) {
            return new Http($app);
        };
    }
}
