<?php

namespace Onekb\Gdrcu\Kernel\Contracts;

use ArrayAccess;

interface Arrayable extends ArrayAccess
{
    public function toArray();
}
