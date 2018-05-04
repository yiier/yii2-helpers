<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2016/1/11 14:47
 * description:
 */

namespace common\helpers;


class Setup
{
    /**
     * 人民币元转换成分
     * @param $data
     * @return mixed
     */
    public static function toFen($data)
    {
        return bcmul((float)$data, 100);
    }

    /**
     * 分转换成人民币元
     * @param $data
     * @param bool $float
     * @return integer|float
     */
    public static function toYuan($data, $float = false)
    {
        $num = $data ? round(($data / 100), 2) : 0;
        return $float ? sprintf("%.2f", $num) : $num;
    }
}