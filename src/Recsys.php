<?php

/*
 * This file is part of the recsys/common.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys;

use Recsys\Common\GatewayFactory;
use Recsys\Common\GatewayInterface;

/**
 * Class Recsys
 *
 * @method static GatewayInterface create($gateway) create a gateway
 */
class Recsys
{
    /**
     * Internal factory storage.
     *
     * @var GatewayFactory
     */
    private static $factory;

    /**
     * Get the gateway factory.
     *
     * Creates a new empty GatewayFactory if none has been set previously.
     *
     * @return GatewayFactory A GatewayFactory instance
     */
    public static function getFactory()
    {
        if (is_null(self::$factory)) {
            self::$factory = new GatewayFactory();
        }

        return self::$factory;
    }

    /**
     * Set the gateway factory.
     *
     * @param GatewayFactory $factory A GatewayFactory instance
     */
    public static function setFactory(GatewayFactory $factory = null)
    {
        self::$factory = $factory;
    }

    /**
     * Static function call router.
     *
     * @see GatewayFactory
     *
     * @param string $method     the factory method to invoke
     * @param array  $parameters parameters passed to the factory method
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $factory = self::getFactory();

        return call_user_func_array([$factory, $method], $parameters);
    }
}
