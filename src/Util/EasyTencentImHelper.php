<?php
declare (strict_types=1);
namespace Lishun\EasyTencentIm\Util;


class EasyTencentImHelper
{
    /**
     * 去除为 null 的对象元素
     * @param object $data
     * @return array
     */
    public static function objFilterToArray(object $data): array
    {
        $res = get_object_vars($data);
        foreach ($res as $key=>$value){
            if ($value === null){
                unset($res[$key]);
            }
        }
        return $res;
    }

    /**
     * 返回一个数据范围
     * @param int $min
     * @param int $max
     * @return int
     */
    public static function randomNumberRange(int $min = 0, int $max = 10000000000): int
    {
        mt_rand();
        return random_int($min, $max);
    }

}