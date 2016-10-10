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
 * SessionAwareInterface
 *
 * Aware of a specific session
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     DefaultSessionAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface SessionAwareInterface extends DefaultSessionAwareInterface
{
    /**
     * Set the session
     *
     * @param  SessionInterface $session
     * @return $this
     * @access public
     */
    public function setSession(SessionInterface $session = null);

    /**
     * Return the session, if not set, try the default session
     *
     * @return SessionInterface
     * @throws LogicException if session and default session not set
     * @access public
     */
    public function getSession()/*# : SessionInterface */;
}
