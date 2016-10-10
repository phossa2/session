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

use Phossa2\Session\Exception\LogicException;

/**
 * DefaultSessionAwareInterface
 *
 * Aware of the default session
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface DefaultSessionAwareInterface
{
    /**
     * Set the default session
     *
     * @param  SessionInterface $session
     * @access public
     * @static
     */
    public static function setDefaultSession(SessionInterface $session = null);

    /**
     * Get the default session
     *
     * @return SessionInterface
     * @access public
     * @throws LogicException if not set yet
     * @static
     */
    public static function getDefaultSession()/*# : SessionInterface */;
}
