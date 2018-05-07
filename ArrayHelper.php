<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2018/5/4 18:37
 * description:
 */

use yii\helpers\ArrayHelper as BaseArrayHelper;

class ArrayHelper extends BaseArrayHelper
{
    /**
     * 删除第一个元素并且不会重组数组键值
     * Deletes the first element and does not reorganize the array key values
     * @param $array array
     * @return array
     */
    public static function arrayShift(array $array)
    {
        return array_slice($array, 1, null, true);
    }
    
    /**
     * 数组模糊搜索
     * https://stackoverflow.com/questions/5808923
     * @param $str string 字符串
     * @param $data array 数据源
     * @return array
     */
    public static function arraySearch($str = '', $data)
    {
        if (!$str) {
            return $data;
        }
        $input = preg_quote($str, '~'); // don't forget to quote input string!
        return preg_grep('~' . $input . '~', $data);
    }
}
