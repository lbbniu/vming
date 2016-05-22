<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Mvc\Controller;

use Phalcon\Mvc\Controller;

/**
 * Class JsonerrorController
 * @package Lbb\Mvc\Controller
 */
class JsonerrorController extends Controller
{
    public function indexAction()
    {
        $error = $this->dispatcher->getParam('error');
        $this->response->setContentType('application/json', 'utf-8');

        $this->response->setJsonContent(
            array(
            'errors' => array(
                array(
                    'code' => $error->type(),
                    'message' => $error->message(),
                    'message_human'=>$this->getDI()->getTranslate()->query($error->message())
                )
            ),
            )
        );
        $callback = $this->request->getQuery('callback');
        if ($callback) {
            $this->response->setContent($callback . '(' . $this->response->getContent() . ')');
        }
        echo $this->response->getContent();
    }
}
