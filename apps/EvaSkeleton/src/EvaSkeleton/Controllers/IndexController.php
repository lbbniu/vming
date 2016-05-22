<?php

namespace EvaSkeleton\Controllers;

use Lbb\Exception;

class IndexController extends \Lbb\Mvc\Controller\ControllerBase
{
    public function indexAction()
    {
        return $this->response->setContent('<center><h1>Hello World</h1><h2>Powered by EvaEngine</h2></center>');
    }
}
