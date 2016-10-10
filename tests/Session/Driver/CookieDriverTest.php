<?php

namespace Phossa2\Session\Driver;

/**
 * CookieDriver test case.
 */
class CookieDriverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CookieDriver
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new CookieDriver();
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
     * Tests CookieDriver->get()
     *
     * @covers Phossa2\Session\Driver\CookieDriver::get()
     */
    public function testGet()
    {
        $id = 'bingo';
        $_COOKIE['test'] = $id;

        // found
        $this->assertEquals($id, $this->object->get('test'));

        // not found
        $this->assertEquals('', $this->object->get('notFound'));

        unset($_COOKIE['test']);
    }

    /**
     * Tests CookieDriver->set()
     *
     * @covers Phossa2\Session\Driver\CookieDriver::set()
     */
    public function testSet()
    {
        $name = 'test';
        $id = 'bingo';
        $this->object->set($name, $id);
        $this->assertEquals([$name => $id], $this->getPrivateProperty('cookies'));
    }

    /**
     * Tests CookieDriver->del()
     *
     * @covers Phossa2\Session\Driver\CookieDriver::del()
     */
    public function testDel()
    {
        $name = 'test';
        $this->object->del($name);
        $this->assertEquals([$name => null], $this->getPrivateProperty('cookies'));
    }
}

