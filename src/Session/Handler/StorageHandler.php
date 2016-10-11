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
use Phossa2\Storage\Interfaces\StorageInterface;

/**
 * StorageHandler
 *
 * Use of 'phossa2/storage' as session handler
 *
 * @package Phossa2\Session
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.1.0 added
 */
class StorageHandler extends ObjectAbstract implements SessionHandlerInterface
{
    /**
     * @var    StorageInterface
     * @access protected
     */
    protected $storage;

    /**
     * Path prefix in the storage
     *
     * @var    string
     * @access protected
     */
    protected $path_prefix;

    /**
     * @param  StorageInterface $storage
     * @param  string $path
     * @access public
     */
    public function __construct(
        StorageInterface $storage,
        $path = '/tmp/session'
    ) {
        $this->storage = $storage;
        $this->path_prefix = rtrim($path, '/');
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
        return $this->storage->del($file);
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
        if ($this->storage->has($file)) {
            return (string) $this->storage->get($file);
        }
        // empty array
        return 'a:0:{}';
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
        return $this->storage->put($file, $session_data);
    }

    /**
     * Return the path in the $this->storage of this session id
     *
     * @param  string $session_id
     * @return string
     * @access protected
     */
    protected function getSessionFile(/*# string */ $session_id)/*# : string */
    {
        // path
        $res = [$this->path_prefix];

        // scatter evenly
        $md5 = md5($session_id);
        $res[] = $md5[0];
        $res[] = $md5[1];

        // append session id
        $res[] = $session_id;

        return join('/', $res);
    }
}
