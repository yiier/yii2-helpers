<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2018/5/4 18:37
 * description:
 */
namespace yiier\helpers;

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
     * @link https://stackoverflow.com/questions/5808923
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
    
      /**
     * 检查是否存在 needles 任意一个值
     * echo inArrayAny( [3,9], [5,8,3,1,2] ); // true, since 3 is present
     * echo inArrayAny( [4,9], [5,8,3,1,2] ); // false, neither 4 nor 9 is present
     * @link https://stackoverflow.com/questions/7542694/in-array-multiple-values
     * @param $needles array
     * @param $haystack array
     * @return bool
     */
    public static function inArrayAny($needles, $haystack)
    {
        return !!array_intersect($needles, $haystack);
    }

    /**
     * 检查是否存在所有 needles
     * echo inArrayAll( [3,2,5], [5,8,3,1,2] ); // true, all 3, 2, 5 present
     * echo inArrayAll( [3,2,5,9], [5,8,3,1,2] ); // false, since 9 is not present
     * @link https://stackoverflow.com/questions/7542694/in-array-multiple-values
     * @param $needles
     * @param $haystack
     * @return bool
     */
    public static function inArrayAll($needles, $haystack)
    {
        return !array_diff($needles, $haystack);
    }

    /**
     * 对二维数组指定的字段进行排序
     * @param array $array 要被排序的数组
     * @param string $field 指定排序的字段
     * @param string $schema 排序的模式 ASC 升序 DESC 降序
     * @return mixed|array
     */
    public static function sort2DArray($array, $field = '', $schema = 'ASC')
    {
        usort($array, function($a, $b) use ($field, $schema) {
            $result = 0;
            if (is_array($a) && isset($a[$field])) {

                if ($a[$field] == $b[$field]) {
                    $result = 0;
                }

                if ($schema == 'ASC') {
                    $result = ($a[$field] < $b[$field]) ? -1 : 1;
                } else if ($schema == 'DESC') {
                    $result = ($a[$field] < $b[$field]) ? 1 : -1;
                }
            } else {

                if ($a == $b) {
                    $result = 0;
                }

                if ($schema == 'ASC') {
                    $result = ($a < $b) ? -1 : 1;
                } else if ($schema == 'DESC') {
                    $result = ($a < $b) ? 1 : -1;
                }
            }

            return $result;
        });

        return $array;
    }
}
