<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Module;

/**
 * Interface StandardInterface
 * @package Lbb\Module
 */
interface StandardInterface
{
    /**
     * @return void
     */
    public static function registerGlobalAutoloaders();

    /**
     * @return void
     */
    public static function registerGlobalEventListeners();

    /**
     * @return void
     */
    public static function registerGlobalViewHelpers();

    /**
     * @return void
     */
    public static function registerGlobalRelations();
}
