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
 * DriverInterface
 *
 * Session communication driver. e.g. CookieDriver
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface DriverInterface
{
    /**
     * Get session id thru the communication layer
     *
     * IF NOT FOUND, return empty ''
     *
     * @param  string $sessionName
     * @return string session id
     * @access public
     */
    public function get(/*# string */ $sessionName)/*# : string */;

    /**
     * Set session id thru the communication layer
     *
     * @param  string $sessionName
     * @param  string $sessionId
     * @return bool
     * @access public
     */
    public function set(
        /*# string */ $sessionName,
        /*# string */ $sessionId
    )/*# : bool */;

    /**
     * Delete session thru the communication layer
     *
     * @param  string $sessionName
     * @return bool
     * @access public
     */
    public function del(/*# string */ $sessionName)/*# : bool */;
}
