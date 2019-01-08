<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Tests;

use GuzzleHttp\Client;
use Mockery as m;
use Mockery\Mock;
use Recsys\Common\GatewayFactory;
use Recsys\Common\Message\RequestInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Mock
     */
    protected $gateway;

    /**
     * @var GatewayFactory
     */
    protected $factory;

    protected $parameters;

    protected $httpClient;

    protected $mockRequest;

    public function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }

    public function getMockRequest()
    {
        if (null === $this->mockRequest) {
            $this->mockRequest = m::mock(RequestInterface::class);
        }

        return $this->mockRequest;
    }
}
