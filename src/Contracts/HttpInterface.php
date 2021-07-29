<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Contracts;

interface HttpInterface
{
    public function __construct($app);

    public function get(string $path);

    public function post(string $path, array $data);

    public function put(string $path, array $data);

    public function delete(string $path, array $data = []);
}
