<?php

namespace Lbb\Tasks;

// +----------------------------------------------------------------------
// | [phalcon]
// +----------------------------------------------------------------------
// | Author: Mr.5 <mr5.simple@gmail.com>
// +----------------------------------------------------------------------
// + Datetime: 14-7-17 15:22
// +----------------------------------------------------------------------
// + TaskBase.php
// +----------------------------------------------------------------------

use Lbb\CLI\Output\ConsoleOutput;
use Phalcon\CLI\Task;

class TaskBase extends Task
{
    /**
     * @var \Lbb\CLI\Output\ConsoleOutput
     */
    protected $output;

    public function __construct()
    {
        $this->output = new ConsoleOutput();
    }
}
