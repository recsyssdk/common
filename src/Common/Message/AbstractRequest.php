<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common\Message;

use GuzzleHttp\ClientInterface;
use Recsys\Common\Exception\RuntimeException;
use Recsys\Common\Parameters;
use Recsys\Common\ParametersTrait;

abstract class AbstractRequest implements RequestInterface
{
    use ParametersTrait {
        setParameter as traitSetParameter;
    }

    /**
     * The request client.
     *
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * An associated ResponseInterface.
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Create a new Request.
     *
     * @param ClientInterface $httpClient A HTTP client to make API calls with
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->initialize();
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     *
     * @throws RuntimeException
     */
    public function initialize(array $parameters = [])
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new Parameters($parameters);

        return $this;
    }

    /**
     * Get the associated Response.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        if (null === $this->response) {
            throw new RuntimeException('You must call send() before accessing the Response!');
        }

        return $this->response;
    }

    /**
     * Send the request.
     *
     * @return ResponseInterface
     */
    public function send()
    {
        $data = $this->getData();

        return $this->sendData($data);
    }

    /**
     * Set a single parameter.
     *
     * @param string $key   The parameter key
     * @param mixed  $value The value to set
     *
     * @return $this
     *
     * @throws RuntimeException if a request parameter is modified after the request has been sent
     */
    protected function setParameter($key, $value)
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        return $this->traitSetParameter($key, $value);
    }
}
