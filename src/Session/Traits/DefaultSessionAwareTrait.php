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

use Phossa2\Session\Message\Message;
use Phossa2\Session\Exception\LogicException;
use Phossa2\Session\Interfaces\SessionInterface;
use Phossa2\Session\Interfaces\DefaultSessionAwareInterface;

/**
 * DefaultSessionAwareTrait
 *
 * Implementation of DefaultSessionAwareInterface
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     DefaultSessionAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait DefaultSessionAwareTrait
{
    /**
     * @var    SessionInterface
     * @access private
     * @staticvar
     */
    private static $default_session;

    /**
     * {@inheritDoc}
     */
    public static function setDefaultSession(SessionInterface $session = null)
    {
        self::$default_session = $session;
    }

    /**
     * {@inheritDoc}
     */
    public static function getDefaultSession()/*# : SessionInterface */
    {
        if (null === self::$default_session) {
            throw new LogicException(
                Message::get(Message::SESSION_NOT_FOUND, get_called_class()),
                Message::SESSION_NOT_FOUND
            );
        }
        return self::$default_session;
    }
}
