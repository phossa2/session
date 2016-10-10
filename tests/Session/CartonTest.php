<?php

namespace Phossa2\Session;

/**
 * Carton test case.
 */
class CartonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Carton
     */
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $sess = new Session();
        $this->object = new Carton('wow', $sess);
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
     * Tests Carton->getName()
     *
     * @covers Phossa2\Session\Carton::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('wow', $this->object->getName());
    }

    /**
     * Tests Carton->toArray()
     *
     * @covers Phossa2\Session\Carton::toArray()
     */
    public function testToArray()
    {
        $this->object['wow'] = 'bingo';
        $this->assertEquals(['wow' => 'bingo'], $this->object->toArray());
    }

    /**
     * Tests Carton->fromArray()
     *
     * @covers Phossa2\Session\Carton::fromArray()
     */
    public function testFromArray()
    {
        $a = ['wow' => 'bingo'];
        $this->object->fromArray($a);
        $this->assertEquals(['wow' => 'bingo'], $this->object->toArray());
    }

    /**
     * Tests Carton->offsetExists()
     *
     * @covers Phossa2\Session\Carton::offsetExists()
     * @covers Phossa2\Session\Carton::offsetSet()
     * @covers Phossa2\Session\Carton::offsetGet()
     * @covers Phossa2\Session\Carton::offsetUnset()
     */
    public function testOffsetExists()
    {
        $this->assertFalse(isset($this->object['wow']));
        $this->object['wow'] = 'bingo';
        $this->assertTrue(isset($this->object['wow']));
        unset($this->object['wow']);
        $this->assertFalse(isset($this->object['wow']));
    }

    /**
     * Tests Carton->__isset()
     *
     * @covers Phossa2\Session\Carton::__isset()
     * @covers Phossa2\Session\Carton::__set()
     * @covers Phossa2\Session\Carton::__get()
     * @covers Phossa2\Session\Carton::__unset()
     */
    public function test__Isset()
    {
        $this->assertFalse(isset($this->object->name));
        $this->object->name = 'bingo';
        $this->assertTrue(isset($this->object->name));
        unset($this->object->name);
        $this->assertFalse(isset($this->object->name));
    }

    /**
     * Tests Carton->count()
     */
    public function testCount()
    {
        $this->assertTrue(0 === count($this->object));
        $this->object['wow'] = 'bingo';
        $this->assertTrue(1 === count($this->object));
    }

    /**
     * Tests Carton->getIterator()
     */
    public function testGetIterator()
    {
        $this->object['wow'] = 'bingo';
        foreach ($this->object as $n => $v) {
            $this->assertEquals('wow', $n);
        }
    }
}

