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
     * 人民币元转换成分
     * @param $data
     * @return mixed
     */
    public static function toFen($data)
    {
        return bcmul((float)$data, 100);
    }

    /**
     * 分转换成人民币元（保留两位小数）
     * @param $data integer
     * @return float
     */
    public static function toYuan($data)
    {
        return bcdiv($data, 100, 2);
    }
}
