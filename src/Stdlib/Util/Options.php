<?php

namespace Stdlib\Util;

/**
 * Class Options
 * @package Stdlib\Util
 */
class Options
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        unset($this->options[$name]);
    }

    /**
     * @return Options
     */
    public function __clone()
    {
        return new self($this->options);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function fromArray(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value = null)
    {
        $this->options[$key] = $value;
    }
}