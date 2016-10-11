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

use Phossa2\Session\Message\Message;

/*
 * Provide zh_CN translation
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
return [
    Message::SESSION_NOT_FOUND => '会话在  "%s" 中没有设置',
    Message::SESSION_STOPPED => '会话已经终止',
    Message::SESSION_INVALID => '无效的会话  "%s" 来自 "%s"',
];
