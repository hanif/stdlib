<?php

namespace Stdlib\Math;

/**
 * Class BigDecimal
 * @package Stdlib\Math
 */
class BigDecimal implements OperandInterface
{
    const DEFAULT_SCALE = 20;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $scale;

    /**
     * @param mixed $value
     * @param int $scale
     */
    public function __construct($value = 0, $scale = self::DEFAULT_SCALE)
    {
        if ($value instanceof static) {
            $this->setScale($value->getScale());
            $this->setValue($value->getValue());
        } else {
            $this->setScale($scale);
            $this->setValue($value);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @param string $currency
     * @param string $placement
     * @return string
     */
    public function formatCurrency($currency, $placement = 'before')
    {
        $formatted = number_format((string)new BigDecimal($this->value, 2), 2);
        switch ($placement) {
            case '-1':
            case 'pre':
            case 'before':
            return $currency . ' ' . $formatted;

            case '1':
            case 'post':
            case 'after':
                return $formatted . ' ' . $currency;

            default:
                return $formatted;
        }
    }

    /**
     * @param int $scale
     * @throws \InvalidArgumentException
     */
    public function setScale($scale)
    {
        if (!is_int($scale)) {
            throw new \InvalidArgumentException('BigDecimal requires `scale` to be integer.');
        } else if ($scale < 0) {
            throw new \InvalidArgumentException('Scale cannot less than zero.');
        }

        $this->scale = $scale;
    }

    /**
     * @param int|string|float $value
     * @throws \InvalidArgumentException
     */
    public function setValue($value)
    {
        $this->value = $this->getValueOfAny($value);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param int $scale
     * @return string
     */
    public function format($scale = 2)
    {
        return number_format((string)new BigDecimal($this->value, $scale), $scale);
    }

    /**
     * @param mixed $operand
     * @return string
     */
    public function abs($operand)
    {
        return ltrim($operand, '-');
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function add($operand)
    {
        return new static(bcadd($this->value, $this->getValueOfAny($operand), $this->scale), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function sub($operand)
    {
        return new static(bcsub($this->value, $this->getValueOfAny($operand), $this->scale), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return string
     */
    public function comp($operand)
    {
        return bccomp($this->value, $this->getValueOfAny($operand), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function mul($operand)
    {
        return new static(bcmul($this->value, $this->getValueOfAny($operand), $this->scale), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function div($operand)
    {
        return new static(bcdiv($this->value, $this->getValueOfAny($operand), $this->scale), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function mod($operand)
    {
        return new static(bcmod($this->value, $this->getValueOfAny($operand)), $this->scale);
    }

    /**
     * @param mixed $operand
     * @return BigDecimal
     */
    public function pow($operand)
    {
        return new static(bcpow($this->value, $this->getValueOfAny($operand), $this->scale), $this->scale);
    }

    /**
     * @return BigDecimal
     */
    public function sqrt()
    {
        return new static(bcsqrt($this->value, $this->scale), $this->scale);
    }

    /**
     * @param mixed $number
     * @return bool
     */
    public function gt($number)
    {
        return $this->comp($number) > 0;
    }

    /**
     * @param mixed $number
     * @return bool
     */
    public function gte($number)
    {
        return $this->comp($number) >= 0;
    }

    /**
     * @param mixed $number
     * @return bool
     */
    public function lt($number)
    {
        return $this->comp($number) < 0;
    }

    /**
     * @param mixed $number
     * @return bool
     */
    public function lte($number)
    {
        return $this->comp($number) <= 0;
    }

    /**
     * @param mixed $number
     * @return bool
     */
    public function eq($number)
    {
        return $this->comp($number) === 0;
    }

    /**
     * @param mixed $operand
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function getValueOfAny($operand)
    {
        switch (true) {
            case $operand instanceof static:
                return $operand->getValue();

            case is_string($operand):
            case is_float($operand):
            case is_double($operand):
            case is_int($operand):
                $sign = (strpos($operand, '-') === 0) ? '-' : '';
                $operand = str_replace('_', null, ltrim($operand, '-+'));
                $operand = bcmul($operand, '1', $this->getScale());
                return sprintf('%s%s', $sign, $operand);

            default:
                throw new \InvalidArgumentException('Invalid number type given (expected: string, integer, float, or BigDecimal object).');
        }
    }
}