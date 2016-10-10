<?php

namespace Phossa2\Session\Handler;

/**
 * FileHandler test case.
 */
class FileHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileHandler
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new FileHandler();
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
     * Tests FileHandler->close()
     *
     * @covers Phossa2\Session\Handler\FileHandler::close()
     * @covers Phossa2\Session\Handler\FileHandler::open()
     * @covers Phossa2\Session\Handler\FileHandler::gc()
     */
    public function testClose()
    {
    }

    /**
     * Tests FileHandler->write()
     *
     * @covers Phossa2\Session\Handler\FileHandler::write()
     * @covers Phossa2\Session\Handler\FileHandler::read()
     * @covers Phossa2\Session\Handler\FileHandler::destroy()
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
