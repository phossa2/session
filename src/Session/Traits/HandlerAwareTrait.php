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

use SessionHandlerInterface;
use Phossa2\Session\Handler\FileHandler;
use Phossa2\Session\Interfaces\HandlerAwareInterface;

/**
 * HandlerAwareTrait
 *
 * Implemetation of HandlerAwareInterface
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     HandlerAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
trait HandlerAwareTrait
{
    /**
     * @var    SessionHandlerInterface
     * @access protected
     */
    protected $handler;

    /**
     * {@inheritDoc}
     */
    public function setHandler(SessionHandlerInterface $handler = null)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHandler()/*# : SessionHandlerInterface */
    {
        if (null === $this->handler) {
            $this->handler = new FileHandler();
        }
        return $this->handler;
    }
}
