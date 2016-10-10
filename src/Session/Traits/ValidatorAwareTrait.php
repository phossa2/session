<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Session
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Session\Traits;

use Phossa2\Session\Interfaces\ValidatorInterface;
use Phossa2\Session\Interfaces\ValidatorAwareInterface;

/**
 * ValidatorAwareTrait
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     ValidatorAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait ValidatorAwareTrait
{
    /**
     * @var    ValidatorInterface[]
     * @access protected
     */
    protected $validators = [];

    /**
     * {@inheritDoc}
     */
    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isValid()/*# : bool */
    {
        foreach ($this->validators as $val) {
            if (!$val->validate()) {
                return false;
            }
        }
        return true;
    }
}
