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

namespace Phossa2\Session\Interfaces;

/**
 * ValidatorAwareInterface
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface ValidatorAwareInterface
{
    /**
     * Add a validator
     *
     * @param  ValidatorInterface $validator
     * @return $this
     * @access public
     * @api
     */
    public function addValidator(ValidatorInterface $validator);

    /**
     * Run thru validators
     *
     * @return bool
     * @access public
     * @api
     */
    public function isValid()/*# : bool */;
}
