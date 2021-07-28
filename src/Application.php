<?php

namespace Onekb\Gdrcu;

use Onekb\Gdrcu\Kernel\ServiceContainer;
use Onekb\Gdrcu\Powers\Order\OrderServiceProvider;

class Application extends ServiceContainer
{
    protected $providers = [
        OrderServiceProvider::class,
    ];

    public function array_default_merge(array $default, array $options): array
    {
        foreach ($options as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }
        return $default;
    }
}
