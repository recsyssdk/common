<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Common;

use Recsys\Common\Exception\RuntimeException;

class GatewayFactory
{
    /**
     * Internal storage for all available gateways.
     *
     * @var array
     */
    private $gateways = [];

    /**
     * All available gateways.
     *
     * @return array An array of gateway names
     */
    public function all()
    {
        return $this->gateways;
    }

    /**
     * Replace the list of available gateways.
     *
     * @param array $gateways An array of gateway names
     */
    public function replace(array $gateways)
    {
        $this->gateways = $gateways;
    }

    /**
     * Register a new gateway.
     *
     * @param string $className Gateway name
     */
    public function register($className)
    {
        if (!in_array($className, $this->gateways)) {
            $this->gateways[] = $className;
        }
    }

    /**
     * Create a new gateway instance.
     *
     * @param string $class Gateway name
     *
     * @throws RuntimeException If no such gateway is found
     *
     * @return GatewayInterface An object of class $class is created and returned
     */
    public function create($class)
    {
        $class = $this->getGatewayClassName($class);
        if (!class_exists($class)) {
            throw new RuntimeException("Class '$class' not found");
        }

        return new $class();
    }

    /**
     * Handle gateway class name.
     *
     * @param $shortName
     *
     * @return string
     */
    protected function getGatewayClassName($shortName)
    {
        if (0 === strpos($shortName, '\\')) {
            return $shortName;
        }

        return '\\Recsys\\'.$shortName.'Gateway';
    }
}
