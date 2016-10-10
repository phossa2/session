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
 * DriverAwareInterface
 *
 * Session driver related.
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface DriverAwareInterface
{
    /**
     * Set the session communication driver.
     *
     * e.g. CookieDriver
     *
     * @param  DriverInterface $driver
     * @return $this
     * @access public
     */
    public function setDriver(DriverInterface $driver = null);

    /**
     * Get the session communication driver.
     *
     * IF NOT SET, use the default CookieDriver
     *
     * @return DriverInterface
     * @access public
     */
    public function getDriver()/*# : DriverInterface */;
}
