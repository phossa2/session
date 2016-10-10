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

use Phossa2\Shared\Base\ObjectAbstract;
use Phossa2\Session\Traits\SessionAwareTrait;
use Phossa2\Session\Interfaces\CartonInterface;
use Phossa2\Session\Interfaces\SessionInterface;

/**
 * Carton
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
class Carton extends ObjectAbstract implements CartonInterface
{
    use SessionAwareTrait;

    /**
     * carton name
     *
     * @var    string
     * @access protected
     */
    protected $name;

    /**
     * Constructor
     *
     * @param  string $name
     * @access public
     */
    public function __construct(
        /*# string */ $name = 'default',
        SessionInterface $session = null
    ) {
        // set box name
        $this->name = $name;

        // start session if not yet
        $this->setSession($session)->getSession()->start();
    }

    /**
     * {@inheritDoc}
     */
    public function __get(/*# string */ $name)
    {
        return $this->offsetGet($name);
    }

    /**
     * {@inheritDoc}
     */
    public function __set(/*# string */ $name, $value)
    {
        return $this->offsetSet($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function __isset(/*# string */ $name)
    {
        return $this->offsetExists($name);
    }

    /**
     * {@inheritDoc}
     */
    public function __unset(/*# string */ $name)
    {
        return $this->offsetUnset($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()/*# : string */
    {
        return $this->name;
    }

    /**
     * Convert to an array
     *
     * @return array
     * @access public
     * @api
     */
    public function toArray()/*# : array */
    {
        return $this->data()->getArrayCopy();
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray(array $data)
    {
        $this->data()->exchangeArray($data);
        return $this;
    }

    public function offsetExists($offset)/*# : bool */
    {
        return isset($this->data()[$offset]);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data()[$offset];
        }
        return;
    }

    public function offsetSet($offset, $value)
    {
        $this->data()[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data()[$offset]);
    }

    public function count()
    {
        return count($this->data());
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data());
    }

    /**
     * Retrieve the data container
     *
     * @return ArrayObject
     * @access protected
     */
    protected function data()
    {
        return $this->getSession()->sessionData($this->name);
    }
}
