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

namespace Phossa2\Session;

use SessionHandlerInterface;
use Phossa2\Session\Message\Message;
use Phossa2\Shared\Base\ObjectAbstract;
use Phossa2\Session\Traits\DriverAwareTrait;
use Phossa2\Session\Traits\HandlerAwareTrait;
use Phossa2\Session\Interfaces\DriverInterface;
use Phossa2\Session\Traits\ValidatorAwareTrait;
use Phossa2\Session\Traits\GeneratorAwareTrait;
use Phossa2\Session\Exception\RuntimeException;
use Phossa2\Session\Interfaces\SessionInterface;
use Phossa2\Session\Interfaces\GeneratorInterface;

/**
 * Session
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
class Session extends ObjectAbstract implements SessionInterface
{
    use DriverAwareTrait, HandlerAwareTrait, ValidatorAwareTrait, GeneratorAwareTrait;

    /**
     * Session id
     *
     * @var    string
     * @access protected
     */
    protected $id;

    /**
     * Session name
     *
     * @var    string
     * @access protected
     */
    protected $name;

    /**
     * session data
     *
     * @var    array|null
     * @access protected
     */
    protected $data;

    /**
     * Init the session
     *
     * @param  string $sessionName session name
     * @param  SessionHandlerInterface $handler session save handler
     * @param  DriverInterface $driver communication driver
     * @param  GeneratorInterface $generator id generator
     * @access public
     */
    public function __construct(
        /*# string */ $sessionName = 'session',
        SessionHandlerInterface $handler = null,
        DriverInterface $driver = null,
        GeneratorInterface $generator = null
    ) {
        $this
            ->setName($sessionName)
            ->setHandler($handler)
            ->setDriver($driver)
            ->setGenerator($generator);
    }

    /**
     * Write & close
     *
     * @access public
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * {@inheritDoc}
     */
    public function start()
    {
        if (null === $this->data) {
            // read data
            $this->data = unserialize(
                $this->getHandler()->read($this->getId())
            );

            // validate
            if (!$this->isValid()) {
                throw new RuntimeException(
                    Message::get(Message::SESSION_INVALID, $this->getName()),
                    Message::SESSION_INVALID
                );
            }
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        if (null !== $this->data) {
            // write to storage
            $this->getHandler()->write(
                $this->getId(),
                $this->serializeData()
            );

            // update cookie with id
            $this->getDriver()->set($this->getName(), $this->getId());

            // close
            $this->data = null;
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function abort()
    {
        $this->data = null;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function reset()
    {
        return $this->abort()->start();
    }

    /**
     * {@inheritDoc}
     */
    public function destroy()
    {
        // delete from storage
        $this->getHandler()->destroy($this->getId());

        // delete cookie
        $this->getDriver()->del($this->getName());

        // mark as stopped
        $this->data = null;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(/*# string */ $sessionName)
    {
        $this->name = $sessionName;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()/*# : string */
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setId(/*# string */ $sessionId = '')
    {
        $this->id = $sessionId;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()/*# : string */
    {
        if (empty($this->id)) {
            // get from the client
            $this->id = $this->getDriver()->get($this->getName());
        }

        if (empty($this->id)) {
            // generate a new id
            $this->newId();
        }

        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function newId()
    {
        $generator = $this->getGenerator();
        $this->id = call_user_func($generator);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function sessionData(/*# string */ $namespace)/*# : \ArrayObject */
    {
        $this->checkStopped();

        if (!isset($this->data[$namespace])) {
            $this->data[$namespace] = new \ArrayObject(
                [],
                \ArrayObject::STD_PROP_LIST | \ArrayObject::ARRAY_AS_PROPS
            );
        }
        return $this->data[$namespace];
    }

    /**
     * Throw RuntimeException if stopped
     *
     * @throws RuntimeException if session stopped
     * @access protected
     */
    protected function checkStopped()
    {
        if (null === $this->data) {
            throw new RuntimeException(
                Message::get(Message::SESSION_STOPPED),
                Message::SESSION_STOPPED
            );
        }
    }

    protected function serializeData()/*# : string */
    {
        return serialize($this->data);
    }
}
