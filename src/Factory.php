<?php

namespace Onekb\Gdrcu;

use Onekb\Gdrcu\Application;

class Factory
{
    public static function make(array $config)
    {
        return new Application($config);
    }

    public static function Gdrcu(array $config = [])
    {
        return self::make($config);
    }
}
