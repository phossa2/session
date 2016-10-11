<?php

namespace Phossa2\Session\Generator;

use Phossa2\Uuid\Uuid;

/**
 * UuidGenerator test case.
 */
class UuidGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var UuidGenerator
     */
    private $uuidGenerator;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->uuidGenerator = new UuidGenerator(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->uuidGenerator = null;
        parent::tearDown();
    }

    /**
     * Tests UuidGenerator->generate()
     */
    public function testGenerate()
    {
        $uuid = $this->uuidGenerator->generate();
        $info = Uuid::info($uuid);
        $this->assertEquals(Uuid::TYPE_SESSION, $info['type']);
    }
}

