<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Recsys\Recsys;

class RecsysTest extends TestCase
{
    public function tearDown()
    {
        Recsys::setFactory(null);

        parent::tearDown();
    }

    public function testGetFactory()
    {
        Recsys::setFactory(null);

        $factory = Recsys::getFactory();
        $this->assertInstanceOf('Recsys\Common\GatewayFactory', $factory);
    }

    public function testSetFactory()
    {
        $factory = m::mock('Recsys\Common\GatewayFactory');

        Recsys::setFactory($factory);

        $this->assertSame($factory, Recsys::getFactory());
    }

    public function testCallStatic()
    {
        $factory = m::mock('Recsys\Common\GatewayFactory');
        $factory->shouldReceive('testMethod')->with('some-argument')->once()->andReturn('some-result');

        Recsys::setFactory($factory);

        $result = Recsys::testMethod('some-argument');
        $this->assertSame('some-result', $result);
    }
}
