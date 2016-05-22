<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Module;

use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * Class AbstractModule
 * @package Lbb\Module
 */
abstract class AbstractModule implements StandardInterface, ModuleDefinitionInterface
{
    /**
     * @return array|void
     */
    public static function registerGlobalAutoloaders()
    {
        return array();
    }

    /**
     * @return array|void
     */
    public static function registerGlobalEventListeners()
    {
        return array();
    }

    /**
     * @return array|void
     */
    public static function registerGlobalViewHelpers()
    {
        return array();
    }

    /**
     * @return array|void
     */
    public static function registerGlobalRelations()
    {
        return array();
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {
    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di)
    {
    }
}
