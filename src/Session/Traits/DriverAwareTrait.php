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

use Phossa2\Session\Driver\CookieDriver;
use Phossa2\Session\Interfaces\DriverInterface;
use Phossa2\Session\Interfaces\DriverAwareInterface;

/**
 * DriverAwareTrait
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     DriverAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait DriverAwareTrait
{
    /**
     * @var    DriverInterface
     * @access protected
     */
    protected $driver;

    /**
     * {@inheritDoc}
     */
    public function setDriver(DriverInterface $driver = null)
    {
        if (null === $driver) {
            $driver = new CookieDriver();
        }
        $this->driver = $driver;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDriver()/*# : DriverInterface */
    {
        return $this->driver;
    }
}
