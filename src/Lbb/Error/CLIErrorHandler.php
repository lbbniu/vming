<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Error;

use Lbb\CLI\Output\ConsoleOutput;
use Lbb\CLI\Output\StreamOutput;
use Lbb\CLI\Formatter\OutputFormatterInterface;
use Phalcon\DI;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger\AdapterInterface as LoggerInterface;

/**
 * Error handler for CLI mode
 * @package Lbb\Error
 */
class CLIErrorHandler implements ErrorHandlerInterface
{
    /**
     * @var bool
     */
    static protected $logger = false;

    /**
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @return mixed|void
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!($errno & error_reporting())) {
            return;
        }
        $output = new ConsoleOutput();
        $output->writeln("");
        $output->writelnWarning(' [WARNING]: '. $errstr.' in file '. $errfile .' at line '.$errline);
        $output->writeln("");

    }

    /**
     * @param \Exception $e
     * @return mixed|void
     */
    public static function exceptionHandler(\Exception $e)
    {
        $output = new ConsoleOutput();
        $output->writelnError($e->getMessage());
        $output->writelnComment($e->getTraceAsString());

    }

    /**
     * @return mixed|void
     */
    public static function shutdownHandler()
    {
    }

    /**
     * @return bool|null
     */
    public static function getLogger()
    {
        if (static::$logger !== false) {
            return static::$logger;
        }

        $di = DI::getDefault();
        $config = $di->get('config');

        if (!isset($config->error->disableLog)
            || (isset($config->error->disableLog) && $config->error->disableLog)
            || empty($config->error->logPath)
        ) {
            return static::$logger = null;
        }

        static::$logger = new FileLogger($config->error->logPath . '/' . 'system_error_' . date('Ymd') . '.log');

        return static::$logger;
    }

    /**
     * @param LoggerInterface $logger
     * @return mixed
     */
    public static function setLogger(LoggerInterface $logger)
    {
        static::$logger = $logger;
        return self;
    }

    /**
     * @param Error $error
     * @return mixed
     */
    protected static function logError(Error $error)
    {
        $logger = static::getLogger();
        if (!$logger) {
            return null;
        }

        return $logger->log($error);
    }

    /**
     * @param Error $error
     */
    protected static function errorProcess(Error $error)
    {

        static::logError($error);

        $useErrorController = false;

        if ($error->isException()) {
            $useErrorController = true;
        } else {
            switch ($error->type()) {
                case E_WARNING:
                case E_NOTICE:
                case E_CORE_WARNING:
                case E_COMPILE_WARNING:
                case E_USER_WARNING:
                case E_USER_NOTICE:
                case E_STRICT:
                case E_DEPRECATED:
                case E_USER_DEPRECATED:
                case E_ALL:
                    break;
                default:
                    $useErrorController = true;
            }
        }

        if (!$useErrorController) {
            return;
        }


    }
}
