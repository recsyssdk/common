<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests\Common\Message;

use Mockery as m;
use Recsys\Common\Message\AbstractRequest;
use Recsys\Tests\TestCase;
use ReflectionMethod;

class AbstractRequestTest extends TestCase
{
    /** @var AbstractRequest */
    protected $request;
    public function setUp()
    {
        $this->request = m::mock('\Recsys\Common\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }
    /**
     * Allow changing a protected property using reflections.
     *
     * @param $property
     * @param bool|true $value
     */
    private function runProtectedMethod($method)
    {
        $reflection = new ReflectionMethod($this->request, $method);
        $reflection->setAccessible(true);
        return $reflection;
    }
    public function testConstruct()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest($this->getHttpClient());
        $this->assertSame(array(), $this->request->getParameters());
    }
    public function testInitializeWithParams()
    {
        $this->assertSame($this->request, $this->request->initialize(['token' => 'access_token']));
        $this->assertSame('access_token', $this->request->getParameter('token'));
    }
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Request cannot be modified after it has been sent!
     */
    public function testInitializeAfterRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest($this->getHttpClient());
        $this->request->send();
        $this->request->initialize();
    }
    public function testGetParameters()
    {
        $reflection = $this->runProtectedMethod('setParameter');
        $reflection->invoke($this->request, 'token', 'asdf');
        $expected = [
            'token' => 'asdf',
        ];
        $this->assertEquals($expected, $this->request->getParameters());
    }
    /**
     * @expectedException \Recsys\Common\Exception\RuntimeException
     * @expectedExceptionMessage Request cannot be modified after it has been sent!
     */
    public function testSetParameterAfterRequestSent()
    {
        $this->request = new AbstractRequestTest_MockAbstractRequest($this->getHttpClient());
        $this->request->send();
        $reflection = $this->runProtectedMethod('setParameter');
        $reflection->invoke($this->request, 'Foo', 'Bar');
    }
}

class AbstractRequestTest_MockAbstractRequest extends AbstractRequest
{
    public function getData() {}
    public function sendData($data)
    {
        $this->response = m::mock('\Recsys\Common\Message\AbstractResponse');
    }
}
