<?php

/*
 * This file is part of the onekb/gdrcu.
 *
 * (c) onekb <1@1kb.ren>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Onekb\Gdrcu\Kernel\Contracts;

use ArrayAccess;

interface Arrayable extends ArrayAccess
{
    public function toArray();
}
