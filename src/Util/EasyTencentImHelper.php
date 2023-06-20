<?php
declare (strict_types=1);

namespace Lishun\EasyTencentIm\Util;


use Closure;
use Exception;

class EasyTencentImHelper
{
    /**
     * 返回一个数据范围
     * @param int $min
     * @param int $max
     * @return int
     * @throws Exception
     */
    public static function randomNumberRange(
        int $min = 0,
        int $max = 10000000000
    ): int {
        mt_rand();
        return random_int($min, $max);
    }

    /**
     * 递归数组排空
     * @param array $arr
     * @param bool $kv 是否重置键值对
     * @return array
     */
    public static function arrayFilter(
        array $arr = [],
        bool  $kv = false
    ): array {
        if (count($arr) < 1) {
            return [];
        }
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = self::arrayFilter($v, $kv);
            }
            if (is_null($arr[$k])) {
                unset($arr[$k]);
            }
        }
        return $kv ? array_values($arr) : $arr;
    }


    /**
     * 将对象或对象数组转换为数组
     * @param mixed $object
     * @param array $properties
     * @param bool $recursive
     * @return array
     */
    public static function toArray(
        mixed $object,
        array $properties = [],
        bool  $recursive = true
    ): array {
        if (is_array($object)) {
            if ($recursive) {
                foreach ($object as $key => $value) {
                    if (is_array($value) || is_object($value)) {
                        $object[$key] = static::toArray($value, $properties, true);
                    }
                }
            }

            return $object;
        }

        if (is_object($object)) {
            if (!empty($properties)) {
                $className = get_class($object);
                if (!empty($properties[$className])) {
                    $result = [];
                    foreach ($properties[$className] as $key => $name) {
                        if (is_int($key)) {
                            $result[$name] = $object->$name;
                        } else {
                            $result[$key] = static::getValue($object, $name);
                        }
                    }

                    return $recursive ? static::toArray($result, $properties) : $result;
                }
            }

//            if ($object instanceof Arrayable ) {
            if (method_exists($object, 'toArray')) {
                $result = $object->toArray();
            } else {
                $result = [];
                /** @var array $object */
                foreach ($object as $key => $value) {
                    $result[$key] = $value;
                }
            }
            return $recursive ? static::toArray($result, $properties) : $result;
        }

        return [$object];
    }

    public static function getValue(
        $array,
        $key,
        $default = null
    ) {
        if ($key instanceof Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }

        if (is_string($key) && ($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessable beforehand
            return $array->$key;
        }

        if (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        }

        return $default;
    }

}