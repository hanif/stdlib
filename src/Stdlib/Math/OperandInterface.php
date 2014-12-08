<?php

namespace Stdlib\Math;

/**
 * Interface OperandInterface
 * @package Stdlib\Math
 */
interface OperandInterface
{
    /**
     * @param mixed $number
     * @return bool
     */
    public function eq($number);

    /**
     * @param mixed $number
     * @return bool
     */
    public function lte($number);

    /**
     * @param mixed $number
     * @return bool
     */
    public function gt($number);

    /**
     * @param mixed $operand
     * @return string
     */
    public function abs($operand);

    /**
     * @param mixed $number
     * @return bool
     */
    public function gte($number);

    /**
     * @param mixed $operand
     * @return string
     */
    public function mul($operand);

    /**
     * @param mixed $operand
     * @return string
     */
    public function add($operand);

    /**
     * @param int $scale
     * @return string
     */
    public function format($scale);

    /**
     * @param mixed $number
     * @return bool
     */
    public function lt($number);

    /**
     * @param mixed $operand
     * @return string
     */
    public function div($operand);

    /**
     * @param mixed $operand
     * @return string
     */
    public function mod($operand);

    /**
     * @return string
     */
    public function sqrt();

    /**
     * @param mixed $operand
     * @return string
     */
    public function pow($operand);

    /**
     * @param mixed $operand
     * @return string
     */
    public function comp($operand);

    /**
     * @param mixed $operand
     * @return string
     */
    public function sub($operand);
}