<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Lbb\Mvc\Model\Validator;

use Phalcon\Mvc\Model\Validator;

/**
 * Class Between
 * @package Lbb\Mvc\Model\Validator
 */
class Between extends Validator
{
    /**
     * @param \Phalcon\Mvc\ModelInterface $model
     * @return bool
     */
    public function validate($model)
    {
        $field = $this->getOption('field');
        $minimum = $this->getOption('minimum');
        $maximum = $this->getOption('maximum');

        if ($model->$field > $maximum || $model->$field < $minimum) {
            $this->appendMessage(sprintf('Field %s must between %s ~ %s', $field, $minimum, $maximum));
            return false;
        }
        return true;
    }
}
