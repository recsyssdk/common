<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests\Common\Exception;

use Recsys\Common\Exception\UnknownMethodException;
use Recsys\Tests\TestCase;

class UnknownMethodExceptionTest extends TestCase
{
    public function testConstruct()
    {
        $exception = new UnknownMethodException('Oops');
        $this->assertSame('Oops', $exception->getMessage());
    }
}
