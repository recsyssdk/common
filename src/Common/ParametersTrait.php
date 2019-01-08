<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common;

use Recsys\Common\Exception\InvalidRequestException;

trait ParametersTrait
{
    /**
     * Internal storage of all of the parameters.
     *
     * @var Parameters
     */
    protected $parameters;

    /**
     * Set one parameter.
     *
     * @param string $key   Parameter key
     * @param mixed  $value Parameter value
     *
     * @return $this
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * Get one parameter.
     *
     * @return mixed a single parameter value
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Get all parameters.
     *
     * @return array an associative array of parameters
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     */
    public function initialize(array $parameters = [])
    {
        $this->parameters = new Parameters($parameters);

        return $this;
    }

    /**
     * Validate the request.
     *
     * This method is called internally by gateways to avoid wasting time with an API call
     * when the request is clearly invalid.
     *
     * @param string ... a variable length list of required parameters
     *
     * @throws InvalidRequestException
     */
    public function validate()
    {
        $args = func_get_args();
        foreach ($args as $key) {
            $value = $this->parameters->get($key);
            if (!isset($value)) {
                throw new InvalidRequestException("The '$key' parameter is required");
            }
        }
    }
}
