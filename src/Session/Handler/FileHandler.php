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

namespace Phossa2\Session\Handler;

use SessionHandlerInterface;
use Phossa2\Shared\Base\ObjectAbstract;

/**
 * FileHandler
 *
 * Simple file handler for session
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     SessionHandlerInterface
 * @version 2.1.0
 * @since   2.1.0 added
 */
class FileHandler extends ObjectAbstract implements SessionHandlerInterface
{
    /**
     * storage path
     *
     * @var    string
     * @access protected
     */
    protected $path;

    /**
     * session file prefix
     *
     * @var    string
     * @access protected
     */
    protected $prefix;

    /**
     * Constructor
     *
     * @param  string $path
     * @access public
     */
    public function __construct($path = '', $prefix = 'sess_')
    {
        $this->prefix = $prefix;
        if (empty($path)) {
            $this->path = sys_get_temp_dir() . '/session/';
        } else {
            $this->path = rtrim($path, '/') . '/';
        }

        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @return bool
     * @see    SessionHandlerInterface::close()
     */
    public function close()/*# : bool */
    {
        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $session_id
     * @return bool
     * @see    SessionHandlerInterface::destroy()
     */
    public function destroy(/*# string */ $session_id)/*# : bool */
    {
        $file = $this->getSessionFile($session_id);
        return unlink($file);
    }

    /**
     * {@inheritDoc}
     *
     * @param  int $maxlifetime
     * @return bool
     * @see    SessionHandlerInterface::gc()
     */
    public function gc(/*# int */ $maxlifetime)/*# : bool */
    {
        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $save_path
     * @param  string $session_name
     * @return bool
     * @see    SessionHandlerInterface::open()
     */
    public function open(
        /*# string */ $save_path,
        /*# string */ $session_name
    )/*# : bool */ {
        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $session_id
     * @return string
     * @see    SessionHandlerInterface::read()
     */
    public function read(/*# string */ $session_id)/*# : string */
    {
        $file = $this->getSessionFile($session_id);
        $content = @file_get_contents($file);
        if (false === $content) {
            $content = 'a:0:{}';
        }
        return $content;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $session_id
     * @param  string $session_data
     * @return bool
     * @see    SessionHandlerInterface::write()
     */
    public function write(
        /*# string */ $session_id,
        /*# string */ $session_data
    )/*# : bool */ {
        $file = $this->getSessionFile($session_id);
        return file_put_contents($file, $session_data) !== false;
    }

    /**
     * Return the file path
     *
     * @param  string $session_id
     * @return string
     * @access protected
     */
    protected function getSessionFile(/*# string */ $session_id)/*# : string */
    {
        return $this->path . $this->prefix . $session_id;
    }
}
