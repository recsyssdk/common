<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common;

use JimChen\Utils\Collection;

class Parameters extends Collection
{
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);
    }
}
