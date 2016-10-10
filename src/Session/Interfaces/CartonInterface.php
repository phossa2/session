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
 * CartonInterface
 *
 * Provides segregation of session data into different namespaces
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     \ArrayAccess
 * @see     SessionAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface CartonInterface extends SessionAwareInterface, \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * Get carton name
     *
     * @return string
     * @access public
     * @api
     */
    public function getName()/*# : string */;

    /**
     * Convert to an array
     *
     * @return array
     * @access public
     * @api
     */
    public function toArray()/*# : array */;

    /**
     * Convert from an array
     *
     * @param  array $data
     * @return $this
     * @access public
     * @api
     */
    public function fromArray(array $data);
}
