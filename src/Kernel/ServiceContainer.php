<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Kernel;

use Onekb\Gdrcu\Kernel\Providers\ConfigServiceProvider;
use Onekb\Gdrcu\Kernel\Providers\HttpServiceProvider;
use Onekb\Gdrcu\Kernel\Providers\SignServiceProvider;
use Pimple\Container;

class ServiceContainer extends Container
{
    protected $id = '';

    protected $providers = [];

    protected $defaultConfig = [];

    protected $userConfig = [];

    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        $this->userConfig = $config;

        parent::__construct($prepends);

        $this->registerProviders($this->getProviders());

        $this->id = $id;

        $this->aggregate();
    }

    protected function aggregate()
    {
        foreach ([] as $key => $value) {
            $this['config']->set($key, $value);
        }
    }

    public function getId()
    {
        return $this->id ?? $this->id = md5(json_encode($this->userConfig));
    }

    public function getProviders()
    {
        $base = [
            ConfigServiceProvider::class,
            HttpServiceProvider::class,
            SignServiceProvider::class,
        ];

        return array_merge($base, $this->providers);
    }

    public function getConfig()
    {
        $base = [];

        return array_replace_recursive($base, $this->defaultConfig, $this->userConfig);
    }

    public function rebind($id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}
