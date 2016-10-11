<?php

namespace Phossa2\Session\Handler;

use Phossa2\Storage\Storage;
use Phossa2\Storage\Filesystem;
use Phossa2\Storage\Driver\LocalDriver;

/**
 * StorageHandler test case.
 */
class StorageHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var StorageHandler
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $storage = new Storage(
            '/tmp',
            new Filesystem(new LocalDriver(sys_get_temp_dir()))
        );

        $this->object = new StorageHandler($storage, '/tmp/session2');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * Tests StorageHandler->close()
     *
     * @covers Phossa2\Session\Handler\StorageHandler::close()
     * @covers Phossa2\Session\Handler\StorageHandler::open()
     * @covers Phossa2\Session\Handler\StorageHandler::gc()
     */
    public function testClose()
    {
    }

    /**
     * Tests StorageHandler->write()
     *
     * @covers Phossa2\Session\Handler\StorageHandler::write()
     * @covers Phossa2\Session\Handler\StorageHandler::read()
     * @covers Phossa2\Session\Handler\StorageHandler::destroy()
     */
    public function testWrite()
    {
        $id  = 'test';
        $str = 'test it';

        $this->object->write($id, $str);
        $this->assertEquals($str, $this->object->read($id));

        $this->object->destroy($id);
        $this->assertEquals('a:0:{}', $this->object->read($id));
    }
}
