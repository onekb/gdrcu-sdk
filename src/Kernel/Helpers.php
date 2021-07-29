<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

if (!function_exists('array_default_merge')) {
    function array_default_merge(array $default, array $options): array
    {
        foreach ($options as $key => $value) {
            if (isset($default[$key])) {
                $default[$key] = $value;
            }
        }

        return $default;
    }
}
