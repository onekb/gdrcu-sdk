<?php

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
