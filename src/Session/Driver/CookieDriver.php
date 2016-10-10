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

namespace Phossa2\Session\Driver;

use Phossa2\Shared\Base\ObjectAbstract;
use Phossa2\Session\Interfaces\DriverInterface;

/**
 * CookieDriver
 *
 * Use cookie mechanism to set session id over to the client
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     DriverInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
class CookieDriver extends ObjectAbstract implements DriverInterface
{
    /**
     * @var    array
     * @access protected
     */
    protected $cookies = [];

    /**
     *  cookie settings
     *
     * @var    string
     * @access protected
     */
    protected $cookie_domain = null;
    protected $cookie_path   = '/';
    protected $cookie_ttl    = 0;
    protected $cookie_secure = false;
    protected $cookie_httponly = true;

    /**
     * Constructor
     *
     * @param  array $settings cookie settings
     * @access public
     */
    public function __construct(array $settings = [])
    {
        $this->setProperties($settings);
    }

    /**
     * Destructor
     *
     * Set cookies right before script finishes
     *
     * @access public
     */
    public function __destruct()
    {
        if (php_sapi_name() === 'cli') {
            return;
        }
        $this->syncCookies();
    }

    /**
     * {@inheritDoc}
     */
    public function get(/*# string */ $sessionName)/*# : string */
    {
        // get from cookie
        if (isset($_COOKIE[$sessionName])) {
            return $_COOKIE[$sessionName];
        }

        // returns empty
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function set(
        /*# string */ $sessionName,
        /*# string */ $sessionId
    )/*# : bool */ {
        $this->cookies[$sessionName] = $sessionId;
    }

    /**
     * {@inheritDoc}
     */
    public function del(/*# string */ $sessionName)/*# : bool */
    {
        if (isset($_COOKIE[$sessionName])) {
            unset($_COOKIE[$sessionName]);
        }
        $this->cookies[$sessionName] = null;
    }

    /**
     * Sync session cookies with the client
     *
     * @access protected
     */
    protected function syncCookies()
    {
        foreach ($this->cookies as $name => $id) {
            if (null === $id) {
                setcookie($name, '', time() - 3600);
            } else {
                setcookie(
                    $name,
                    $id,
                    $this->cookie_ttl ? (time() + $this->cookie_ttl) : 0,
                    $this->cookie_path,
                    $this->cookie_domain,
                    $this->cookie_secure,
                    $this->cookie_httponly
                );
            }
        }
    }
}
