<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

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
