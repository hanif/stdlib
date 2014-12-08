<?php

namespace Stdlib\Util;

/**
 * Class CollectionUtil
 * @package Stdlib\Util
 */
class CollectionUtil
{
    /**
     * @param array $arr
     * @param mixed $element
     * @return bool
     */
    public static function contains($arr, $element)
    {
        if (in_array($element, $arr) OR array_search($element, $arr)) {
            return true;
        }
        return false;
    }

    /**
     * @param array $arr
     * @param callable $callback
     * @return \Generator
     */
    public static function each($arr, callable $callback)
    {
        foreach ($arr as $key => $val) {
            yield $callback($val, $key);
        }
    }

    /**
     * @param array $arr
     * @param callable $callback
     * @return array
     */
    public static function collect($arr, callable $callback)
    {
        $data = [];
        foreach ($arr as $key => $val) {
            $result = $callback($val, $key, $data);
            if (is_array($result)) {
                if (sizeof($result) === 1) {
                    list($key, $value) = each($result);
                    $data[$key] = $value;
                } else {
                    $data = array_merge($data, $result);
                }
            } else {
                $data[] = $result;
            }
        }
        return $data;
    }

    /**
     * @param array $arr
     * @param string $key
     * @param string $val
     * @return array
     */
    public static function createAssoc($arr, $key, $val)
    {
        $data = [];
        foreach ($arr as $elem) {
            if (is_array($elem) || ($elem instanceof \ArrayObject)) {
                if (isset($elem[$key]) && isset($elem[$val])) {
                    $data[$elem[$key]] = $elem[$val];
                }
            } else if (is_object($elem)) {
                $keyMethod = sprintf('get%s', $key);
                $valueMethod = sprintf('get%s', $val);
                if (method_exists($elem, $keyMethod) && method_exists($elem, $valueMethod)) {
                    $data[$elem->{$keyMethod}()] = $elem->{$valueMethod}();
                }
            }
        }
        return $data;
    }
}