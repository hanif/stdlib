<?php

namespace StdlibTest\Util;

use Stdlib\Util\Chainable;

/**
 * Class ChainableTest
 * @package StdlibTest\Util
 */
class ChainableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testIfWrappedObjectReturnsOriginalObject()
    {
        $this->assertTrue(Chainable::wrap(new \StdClass) instanceof \StdClass);
        $this->assertTrue(Chainable::wrap(new HelloWorld) instanceof HelloWorld);

        $helloWorld = new HelloWorld;
        $this->assertEquals('Hello World!', $helloWorld->__toString());
    }

    /**
     * @test
     */
    public function testIfWrappedScalarsReturnsChainable()
    {
        $this->assertTrue(Chainable::wrap([]) instanceof Chainable);
        $this->assertTrue(Chainable::wrap("") instanceof Chainable);
        $this->assertTrue(Chainable::wrap(true) instanceof Chainable);
    }

    /**
     * @test
     */
    public function testStringConversion()
    {
        $this->assertEquals("Hello World!", (string)Chainable::wrap(new HelloWorld));
        $this->assertEquals("", (string)Chainable::wrap([]));
    }
}

/**
 * Class HelloWorld
 * @package StdlibTest\Util
 */
class HelloWorld
{
    public function __toString()
    {
        return "Hello World!";
    }
}