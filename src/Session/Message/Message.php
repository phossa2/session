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

namespace Phossa2\Session\Message;

use Phossa2\Shared\Message\Message as BaseMessage;

/**
 * Message class for Phossa2\Session
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     \Phossa2\Shared\Message\Message
 * @version 2.1.0
 * @since   2.1.0 added
 */
class Message extends BaseMessage
{
    /*
     * Session not found in "%s"
     */
    const SESSION_NOT_FOUND = 1610081417;

    /*
     * Session stopped already
     */
    const SESSION_STOPPED = 1610081418;

    /*
     * Invalid session "%s" from "%s"
     */
    const SESSION_INVALID = 1610081419;

    /**
     * {@inheritDoc}
     */
    protected static $messages = [
        self::SESSION_NOT_FOUND => 'Session not found in "%s"',
        self::SESSION_STOPPED => 'Session stopped already',
        self::SESSION_INVALID => 'Invalid session "%s" from "%s"',
    ];
}
