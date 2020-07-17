<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2018/5/4 18:37
 * description:
 */

namespace yiier\helpers;

class DateHelper
{
    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    /**
     * @param $dateStr
     * @param string $type
     * @param null $format
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function convert($dateStr, $type = 'datetime', $format = null)
    {
        if ($type === 'datetime') {
            $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        } elseif ($type === 'time') {
            $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        } else {
            $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }

    /**
     * 相对时间
     * @param $dateStr
     * @return string
     */
    public static function relative($dateStr)
    {
        return \Yii::$app->formatter->asRelativeTime($dateStr);
    }

    /**
     * 获取某天/当前天 最开始的时间戳
     * @param string $time 时间戳 或者 2016-7-25 11:02:21
     * @return int
     */
    public static function beginTimestamp($time = '')
    {
        $time = ($time) ?: time();
        $time = is_numeric($time) ? $time : strtotime($time);

        return strtotime(date('Y-m-d', $time));
    }


    /**
     * 获取某天/当前天 结束的时间戳 23:59:59
     * @param string $time 时间戳 或者 2016-7-25 11:02:21
     * @return int
     */
    public static function endTimestamp($time = '')
    {
        return self::beginTimestamp($time) + 24 * 3600 - 1;
    }

    /**
     * 判断是否是时间戳
     * @param $timestamp
     * @return bool
     */
    public static function isTimestamp($timestamp)
    {
        return (is_numeric($timestamp) && (int)$timestamp == $timestamp);
    }
}
