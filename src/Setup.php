<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2016/1/11 14:47
 * description:
 */

namespace yiier\helpers;

class Setup
{
    /**
     * 分转换成人民币元（保留两位小数）
     * @param $data integer
     * @return float
     */
    public static function toYuan($data)
    {
        if (in_array($data, [null, 0])) {
            return $data;
        }

        return bcdiv($data, 100, 2);
    }


    /**
     * 人民币元转换成分
     * @param $data integer
     * @return float
     */
    public static function toFen($data)
    {
        if (in_array($data, [null, 0])) {
            return $data;
        }

        return (int)bcmul((float)$data, 100);
    }


    /**
     * 错误信息
     * @param array $error
     * @return string
     */
    public static function errorMessage($error)
    {
        if (is_array($error)) {
            return array_values($error)[0];
        }
        return '';
    }
}
