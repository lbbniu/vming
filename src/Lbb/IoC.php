<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Lbb;

use Lbb\Exception\RuntimeException;
use Phalcon\DI;

/**
 * Class IoC
 * @package Lbb
 */
class IoC
{
    /**
     * @var DI
     */
    private static $di;

    /**
     * @return DI
     */
    public static function getDI()
    {
        return self::$di;
    }

    /**
     * @param DI $di
     */
    public static function setDI(DI $di)
    {
        self::$di = $di;
    }

    /**
     * Resolves the service based on its configuration
     *
     * @param  string $name
     * @param  array  $parameters
     * @throws RuntimeException
     * @return mixed
     */
    public static function get($name, $parameters = null)
    {
        if (self::$di == null) {
            throw new RuntimeException('IoC container is null!');
        }
        return self::$di->get($name, $parameters);
    }

    /**
     * Registers a service in the services container
     *
     * @param  string  $name
     * @param  mixed   $definition
     * @param  boolean $shared
     * @throws RuntimeException
     * @return \Phalcon\DI\ServiceInterface
     */
    public static function set($name, $definition, $shared = null)
    {
        if (self::$di == null) {
            throw new RuntimeException('IoC container is null!');
        }
        self::$di->set($name, $definition, $shared);
    }
}
