<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JimChen\Utils\Str;
use Recsys\Common\Exception\UnknownMethodException;
use Recsys\Common\Message\RequestInterface;

/**
 * Class AbstractGateway.
 *
 * @method bool supportReportItems()
 * @method bool supportReportItem()
 * @method bool supportRemoveItems()
 * @method bool supportRemoveItem()
 * @method bool supportFindItems()
 * @method bool supportFindItem()
 * @method bool supportReportActions()
 * @method bool supportReportAction()
 * @method bool supportRecommend()
 */
abstract class AbstractGateway implements GatewayInterface
{
    use ParametersTrait;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * AbstractGateway constructor.
     */
    public function __construct()
    {
        $this->httpClient = $this->getDefaultHttpClient();
        $this->initialize();
    }

    /**
     * Initialize parameters.
     *
     * @param array $parameters
     *
     * @return GatewayInterface
     */
    public function initialize(array $parameters = [])
    {
        $this->parameters = new Parameters($parameters);

        return $this;
    }

    /**
     * Make a request.
     *
     * @param string $class
     * @param array  $parameters
     *
     * @return RequestInterface
     */
    protected function createRequest($class, array $parameters)
    {
        /**
         * @var RequestInterface
         */
        $obj = new $class($this->httpClient);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

    /**
     * Get the global default HTTP client.
     *
     * @return ClientInterface
     */
    protected function getDefaultHttpClient()
    {
        return new Client();
    }

    /**
     * Check if support method.
     *
     * @param $method
     *
     * @return bool
     */
    public function support($method)
    {
        return method_exists($this, $method);
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return bool
     *
     * @throws UnknownMethodException
     */
    public function __call($method, $arguments)
    {
        if (Str::startsWith($method, 'support')) {
            $method = lcfirst(str_replace('support', '', $method));

            return $this->support($method);
        }

        throw new UnknownMethodException("Unknown method: '{$method}'");
    }
}
