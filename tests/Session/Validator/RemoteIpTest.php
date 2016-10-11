<?php

namespace Phossa2\Session\Validator;

/**
 * RemoteIp test case.
 */
class RemoteIpTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var RemoteIp
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $_SERVER['REMOTE_ADDR'] = '192.168.12.34';

        $this->object = new RemoteIp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        unset($_SERVER['REMOTE_ADDR']);
        parent::tearDown();
    }

    /**
     * Tests RemoteIp->validate()
     *
     * @covers Phossa2\Session\Validator\RemoteIp::validate()
     */
    public function testValidate()
    {
        // nothing to validate
        $this->assertTrue($this->object->validate());

        // deny matched
        $this->object->setDenied(['192.168.12.32/24']);
        $this->assertFalse($this->object->validate());

        // allow matched
        $this->object->setAllowed(['192.168.12.32/24']);
        $this->assertTrue($this->object->validate());

        // change ip
        $_SERVER['REMOTE_ADDR'] = '1.2.3.4';

        // deny it due to not explicitly allowed
        $this->assertFalse($this->object->validate());
    }
}
