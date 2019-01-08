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
use Recsys\Common\Message\AbstractResponse;
use Recsys\Tests\TestCase;

class AbstractResponseTest extends TestCase
{
    /** @var  AbstractResponse */
    protected $response;

    public function setUp()
    {
        $this->response = m::mock('\Recsys\Common\Message\AbstractResponse')->makePartial();
    }

    public function testConstruct()
    {
        $data = ['foo' => 'bar'];
        $request = $this->getMockRequest();
        $this->response = m::mock('\Recsys\Common\Message\AbstractResponse', [$request, $data])->makePartial();

        $this->assertSame($request, $this->response->getRequest());
        $this->assertSame($data, $this->response->getData());
    }

    public function testDefaultMethods()
    {
        $this->assertNull($this->response->getData());
        $this->assertNull($this->response->getMessage());
        $this->assertNull($this->response->getCode());
    }
}
