<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Exception;

/**
 * Class ResourceExpiredException
 * @package Lbb\Exception
 */
class ResourceExpiredException extends LogicException
{
    /**
     * @var int
     */
    protected $statusCode = 403;
}
