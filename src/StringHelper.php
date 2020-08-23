<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2020/2/18 13:10
 * description:
 */

namespace yiier\helpers;

class StringHelper
{
    /**
     * after('@', 'biohazard@online.ge');
     * returns 'online.ge'
     * @param string $str
     * @param string $text
     * @return false|string
     */
    public static function after(string $str, string $text)
    {
        if (!is_bool(strpos($text, $str))) {
            return substr($text, strpos($text, $str) + strlen($str));
        }
        return $text;
    }

    /**
     * afterLast('[', 'sin[90]*cos[180]');
     * returns '180]'
     * @param string $str
     * @param string $text
     * @return false|string
     */
    public static function afterLast(string $str, string $text)
    {
        if (!is_bool(self::strrevpos($text, $str))) {
            return substr($text, self::strrevpos($text, $str) + strlen($str));
        }
    }

    /**
     * before('@', 'biohazard@online.ge');
     * returns 'biohazard'
     * @param string $str
     * @param string $text
     * @return false|string
     */
    public static function before(string $str, string $text)
    {
        if (strpos($text, $str) === false) {
            return $text;
        }
        return substr($text, 0, strpos($text, $str));
    }

    /**
     * beforeLast('[', 'sin[90]*cos[180]');
     * returns 'sin[90]*cos'
     * @param string $str
     * @param string $text
     * @return false|string
     */
    public static function beforeLast(string $str, string $text)
    {
        return substr($text, 0, self::strrevpos($text, $str));
    }

    /**
     * between('@', '.', 'biohazard@online.ge');
     * returns 'online'
     * @param string $str1
     * @param string $str2
     * @param string $text
     * @return false|string
     */
    public static function between(string $str1, string $str2, string $text)
    {
        return self::before($str2, self::after($str1, $text));
    }

    /**
     * betweenLast('[', ']', 'sin[90]*cos[180]');
     * returns '180'
     * @param string $str1
     * @param string $str2
     * @param string $text
     * @return false|string
     */
    public static function betweenLast(string $str1, string $str2, string $text)
    {
        return self::afterLast($str1, self::beforeLast($str2, $text));
    }


    /**
     * use strrevpos function in case your php version does not include it
     * @param string $text
     * @param string $str
     * @return bool|false|int
     */
    protected static function strrevpos(string $text, string $str)
    {
        $revPos = strpos(strrev($text), strrev($str));
        if ($revPos === false) {
            return false;
        } else {
            return strlen($text) - $revPos - strlen($str);
        }
    }
}
