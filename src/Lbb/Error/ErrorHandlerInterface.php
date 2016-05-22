<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Error;

/**
 * LbbEngine Error interface
 * @package Lbb\Error
 */
interface ErrorHandlerInterface
{
    /**
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @return mixed
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline);

    /**
     * @param \Exception $e
     * @return mixed
     */
    public static function exceptionHandler(\Exception $e);

    /**
     * @return mixed
     */
    public static function shutdownHandler();
}
