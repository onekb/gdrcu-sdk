<?php

namespace Onekb\Gdrcu\Powers\Kernel;

class BaseClient
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    protected function prepends()
    {
        return [];
    }
}
