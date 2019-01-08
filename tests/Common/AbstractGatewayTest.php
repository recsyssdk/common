<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests\Common;

use Mockery as m;
use GuzzleHttp\Client;
use Recsys\Common\AbstractGateway;
use Recsys\Common\Exception\UnknownMethodException;
use Recsys\Common\Message\AbstractRequest;
use Recsys\Tests\TestCase;

class AbstractGatewayTest extends TestCase
{
    protected function setUp()
    {
        $this->gateway = m::mock(AbstractGateway::class)->makePartial();
        $this->gateway->initialize();
    }

    public function testConstruct()
    {
        $this->gateway = new AbstractGatewayTest_MockAbstractGateway();
        $this->assertInstanceOf(Client::class, $this->gateway->getProtectedHttpClient());
        $this->assertSame(array(), $this->gateway->getParameters());
    }

    public function testInitializeParameters()
    {
        $this->gateway->initialize([
            'token' => 'access_token',
        ]);
        $this->assertSame([
            'token' => 'access_token'
        ], $this->gateway->getParameters());
    }

    public function testSupport()
    {
        $this->assertFalse($this->gateway->support('recommend'));
    }

    public function testMagicCall()
    {
        $gateway = new AbstractGatewayTest_MockAbstractGateway();
        $this->assertFalse($gateway->supportRecommend());
    }

    /**
     * @expectedException \Recsys\Common\Exception\UnknownMethodException
     * @expectedExceptionMessage Unknown method: 'magic'
     */
    public function testMagicCallThrowException()
    {
        $method = 'magic';
        $gateway = new AbstractGatewayTest_MockAbstractGateway();

        $gateway->{$method}();
    }

    public function testCreateRequest()
    {
        $this->gateway = new AbstractGatewayTest_MockAbstractGateway;
        $request = $this->gateway->callCreateRequest(
            '\Recsys\Tests\Common\AbstractGatewayTest_MockAbstractRequest',
            ['token' => 'access_token']
        );
        $this->assertSame(['token' => 'access_token'], $request->getParameters());
    }
}

/**
 * @method \Recsys\Common\Message\RequestInterface reportItems(array $options = array())
 * @method \Recsys\Common\Message\RequestInterface reportItem($itemId)
 * @method \Recsys\Common\Message\RequestInterface removeItems(array $itemIds = array())
 * @method \Recsys\Common\Message\RequestInterface removeItem($itemId)
 * @method \Recsys\Common\Message\RequestInterface findItems(array $itemIds = array())
 * @method \Recsys\Common\Message\RequestInterface findItem($itemId)
 * @method \Recsys\Common\Message\RequestInterface reportActions(array $options = array())
 * @method \Recsys\Common\Message\RequestInterface reportAction($option)
 * @method \Recsys\Common\Message\RequestInterface recommend(array $options = array())
 */
class AbstractGatewayTest_MockAbstractGateway extends AbstractGateway
{
    public function getProtectedHttpClient()
    {
        return $this->httpClient;
    }
    public function callCreateRequest($class, array $parameters)
    {
        return $this->createRequest($class, $parameters);
    }
}
class AbstractGatewayTest_MockAbstractRequest extends AbstractRequest
{
    public function getData() {}
    public function sendData($data) {}
}
