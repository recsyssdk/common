<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests\Common;

use Recsys\Common\ParametersTrait;
use Recsys\Tests\TestCase;
use ReflectionMethod;

class ParametersTraitTest extends TestCase
{
    protected function setUp()
    {
        $this->parameters = new ParametersTrait_MockObject();
    }

    public function testInitialize()
    {
        $this->parameters->initialize([
            'Foo' => 'Bar'
        ]);

        $this->assertSame([
            'Foo' => 'Bar'
        ], $this->parameters->getParameters());
    }

    public function testSetParameter()
    {
        $this->parameters->initialize([
            'Foo' => 'Bar'
        ]);

        $method = new ReflectionMethod(ParametersTrait_MockObject::class, 'setParameter');
        $method->setAccessible(true);
        $method->invoke($this->parameters, 'Foo', 'Foo');

        $this->assertSame([
            'Foo' => 'Foo'
        ], $this->parameters->getParameters());
    }

    /**
     * @expectedException \Recsys\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage The 'Bar' parameter is required
     */
    public function testValidate()
    {
        $this->parameters->initialize([
            'Foo' => 'Bar',
        ]);

        $this->parameters->validate('Foo', 'Bar');
    }
}


class ParametersTrait_MockObject {
    use ParametersTrait;
}