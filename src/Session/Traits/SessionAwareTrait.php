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

use Phossa2\Session\Interfaces\SessionInterface;
use Phossa2\Session\Interfaces\SessionAwareInterface;

/**
 * SessionAwareTrait
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     SessionAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait SessionAwareTrait
{
    use DefaultSessionAwareTrait;

    /**
     * @var    SessionInterface
     * @access protected
     */
    protected $session;

    /**
     * {@inheritDoc}
     */
    public function setSession(SessionInterface $session = null)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSession()/*# : SessionInterface */
    {
        if (null === $this->session) {
            return static::getDefaultSession();
        } else {
            return $this->session;
        }
    }
}
