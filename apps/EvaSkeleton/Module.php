<?php

namespace EvaSkeleton;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Lbb\Module\StandardInterface;
use Lbb\Mvc\View;

class Module implements ModuleDefinitionInterface, StandardInterface
{
    public static function registerGlobalAutoloaders()
    {
        return array(
            'EvaSkeleton' => __DIR__ . '/src/EvaSkeleton',
        );
    }

    public static function registerGlobalEventListeners()
    {
    }

    public static function registerGlobalViewHelpers()
    {
    }

    public static function registerGlobalRelations()
    {
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders(\Phalcon\DiInterface  $di=null)
    {
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices(\Phalcon\DiInterface  $di)
    {
        $dispatcher = $di->getDispatcher();
        $dispatcher->setDefaultNamespace('EvaSkeleton\Controllers');
    }
}
