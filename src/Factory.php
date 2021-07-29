<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu;

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
