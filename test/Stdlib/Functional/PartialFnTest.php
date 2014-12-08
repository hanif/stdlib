<?php

namespace StdlibTest\Functional;

use Stdlib\Functional\PartialFn;

/**
 * Class PartialFnTest
 * @package StdlibTest\Functional
 */
class PartialFnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testIfCurryFunctionWorkAsExpected()
    {
        $add = PartialFn::create(function($a, $b) {
            return $a + $b;
        });

        $this->assertTrue(is_callable($add));

        $addOne = $add(1);
        $this->assertTrue($addOne instanceof PartialFn);
        $this->assertTrue(is_callable($addOne));

        $three = $addOne(2); // 1 + 2 = 3
        $this->assertEquals(3, $three);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testIfCurryThrowsExceptionIfCreatedFunctionHasNoParameter()
    {
        PartialFn::create(function() {});
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testIfCurryThrowsExceptionIfGivenArgsExceedExpected()
    {
        $add = PartialFn::create(function($a, $b) {
            return $a + $b;
        });

        $add(1, 2, 3);
    }
}