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

/**
 * SessionInterface
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     DriverAwareInterface
 * @see     HandlerAwareInterface
 * @see     ValidatorAwareInterface
 * @see     GeneratorAwareInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
interface SessionInterface extends DriverAwareInterface, HandlerAwareInterface, ValidatorAwareInterface, GeneratorAwareInterface
{
    /**
     * Start the session
     *
     * @return $this
     * @access public
     * @api
     */
    public function start();

    /**
     * Commit changes, write & close the session
     *
     * @return $this
     * @access public
     * @api
     */
    public function close();

    /**
     * Discard any changes and finishes the session
     *
     * @return $this
     * @access public
     * @api
     */
    public function abort();

    /**
     * Forget changes made before last save
     *
     * @return $this
     * @access public
     * @api
     */
    public function reset();

    /**
     * Destroy all the session data
     *
     * @return $this
     * @access public
     * @api
     */
    public function destroy();

    /**
     * Set session name
     *
     * @param  string $sessionName
     * @return $this
     * @access public
     * @api
     */
    public function setName(/*# string */ $sessionName);

    /**
     * Get session name
     *
     * @return string
     * @access public
     * @api
     */
    public function getName()/*# : string */;

    /**
     * Set session id, if id == '', then generate a new one
     *
     * @param  string $sessionId
     * @return $this
     * @access public
     * @api
     */
    public function setId(/*# string */ $sessionId = '');

    /**
     * Get session id
     *
     * @return string
     * @access public
     * @api
     */
    public function getId()/*# : string */;

    /**
     * Regenerate session id
     *
     * @return $this
     * @access public
     * @api
     */
    public function newId();

    /**
     * Get session data of the specific namespace
     *
     * @param  string $namespace
     * @return \ArrayObject
     * @throws RuntimeException if session stopped
     * @access public
     */
    public function sessionData(/*# string */ $namespace)/*# : \ArrayObject */;
}
