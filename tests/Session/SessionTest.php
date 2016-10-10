<?php

namespace Phossa2\Session;

/**
 * Session test case.
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Session
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new Session();
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
     * getPrivateProperty
     *
     * @param  string $propertyName
     * @return the property
     */
    protected function getPrivateProperty($propertyName) {
        $reflector = new \ReflectionClass($this->object);
        $property  = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($this->object);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod($methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass($this->object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($this->object, $parameters);
    }

    /**
     * Tests Session->start()
     *
     * @covers Phossa2\Session\Session::start()
     */
    public function testStart()
    {
        $this->object->start();
        $this->assertEquals([], $this->getPrivateProperty('data'));
    }

    /**
     * Tests Session->close()
     *
     * @covers Phossa2\Session\Session::close()
     */
    public function testClose()
    {
        $this->object->start()->sessionData('wow');
        $this->object->close()->start();
        $this->assertArrayHasKey('wow', $this->getPrivateProperty('data'));
    }

    /**
     * Tests Session->abort()
     *
     * @covers Phossa2\Session\Session::abort()
     */
    public function testAbort()
    {
        $this->object->start()->abort();
        $this->assertEquals(null, $this->getPrivateProperty('data'));
    }

    /**
     * Tests Session->reset()
     *
     * @covers Phossa2\Session\Session::reset()
     */
    public function testReset()
    {
        // add data
        $this->object->start()->sessionData('wow');
        $this->assertArrayHasKey('wow', $this->getPrivateProperty('data'));

        // reset
        $this->object->reset();
        $this->assertEquals([], $this->getPrivateProperty('data'));
    }

    /**
     * Tests Session->destroy()
     *
     * @covers Phossa2\Session\Session::destroy()
     */
    public function testDestroy()
    {
        // create some data
        $this->object->start()->sessionData('wow');
        $this->object->close()->start();
        $this->assertArrayHasKey('wow', $this->getPrivateProperty('data'));

        $this->object->destroy()->start();
        $this->assertEquals([], $this->getPrivateProperty('data'));
    }

    /**
     * Tests Session->setName()
     *
     * @covers Phossa2\Session\Session::setName()
     * @covers Phossa2\Session\Session::getName()
     */
    public function testSetName()
    {
        $this->object->setName('bingo');
        $this->assertEquals('bingo', $this->object->getName());
    }

    /**
     * Tests Session->setId()
     *
     * @covers Phossa2\Session\Session::setId()
     */
    public function testSetId()
    {
        $this->object->setId('bingo');
        $this->assertEquals('bingo', $this->object->getId());
    }

    /**
     * Tests Session->getId()
     *
     * @covers Phossa2\Session\Session::getId()
     */
    public function testGetId()
    {
        // get from client
        $_COOKIE['session'] = 'test';
        $this->assertEquals('test', $this->object->getId());
        unset($_COOKIE['session']);

        // new id
        $this->object->setId('');
        $this->assertEquals(32, strlen($this->object->getId()));
    }

    /**
     * Tests Session->newId()
     *
     * @covers Phossa2\Session\Session::newId()
     */
    public function testNewId()
    {
        $this->object->newId();
        $old = $this->object->getId();
        $this->assertEquals(32, strlen($old));

        // different id for each newId()
        $this->assertTrue($old !== $this->object->newId()->getId());
    }

    /**
     * Tests Session->sessionData()
     *
     * @covers Phossa2\Session\Session::sessionData()
     */
    public function testSessionData()
    {
        $wow1 = $this->object->start()->sessionData('wow');
        $wow1['test'] = 'test';

        $this->object->close()->start();
        $wow2 = $this->object->sessionData('wow');
        $this->assertEquals(['test' => 'test'], $wow2->getArrayCopy());
    }
}

