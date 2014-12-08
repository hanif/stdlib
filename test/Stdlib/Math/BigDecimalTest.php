<?php

namespace StdlibTest\Math;

use Stdlib\Math\BigDecimal;

/**
 * Class BigDecimalTest
 * @package StdlibTest\Math
 */
class BigDecimalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testIfMultiplicationResultValid()
    {
        $n = new BigDecimal('12345678900987654321');
        $val = $n->mul(12345);

        $this->assertEquals('152407406032692592592745', $val->getValue());
    }

    /**
     * @test
     */
    public function testIfDivisionResultValid()
    {
        $n = new BigDecimal('123456789009876543215', 0);
        $val = $n->div(5);

        $this->assertEquals('24691357801975308643', $val->getValue());
    }

    /**
     * @test
     */
    public function testIfAdditionResultValid()
    {
        $n = new BigDecimal('1234567890.0987654321');
        $val = $n->add('1234567890.0987654321');

        $this->assertEquals('2469135780.1975307', $val->getValue());
    }

    /**
     * @test
     */
    public function testIfSubtractionResultValid()
    {
        $n = new BigDecimal('1234567890.09876543215');
        $val = $n->sub('123456789.9876543215');

        $this->assertEquals('1111111100.1111112', $val->getValue());
    }

}