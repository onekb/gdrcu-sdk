<?php

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
