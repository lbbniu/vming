<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Lbb\Mvc\User;

use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\User\Component as PhalconComponent;

/**
 * Class Component
 * @package Lbb\Mvc\User
 */
class Component extends PhalconComponent
{
    /**
     * @param $location
     * @param null     $data
     * @return string
     */
    public function reDispatch($location, $data = null)
    {
        //Here must clone full DI for reset dispatcher
        $di = clone $this->getDI();
        $dispatcher = $di->get('dispatcher');

        if (isset($location['module'])) {
            $dispatcher->setModuleName($location['module']);
        }

        if (isset($location['namespace'])) {
            $dispatcher->setNamespaceName($location['namespace']);
        }

        if (isset($location['controller'])) {
            $dispatcher->setControllerName($location['controller']);
        } else {
            $dispatcher->setControllerName('index');
        }

        if (isset($location['action'])) {
            $dispatcher->setActionName($location['action']);
        } else {
            $dispatcher->setActionName('index');
        }

        if (isset($location['params'])) {
            if (is_array($location['params'])) {
                $dispatcher->setParams($location['params']);
            } else {
                $dispatcher->setParams((array) $location['params']);
            }
        } else {
            $dispatcher->setParams(array());
        }

        $di->set('dispatcher', $dispatcher);

        $dispatcher->dispatch();
        $response = $dispatcher->getReturnedValue();

        if ($response instanceof ResponseInterface) {
            return $response->getContent();
        }

        return $response;
    }
}
