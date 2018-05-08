<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2015/12/29 18:37
 * description:
 */

namespace yiier\helpers;

class Security
{
    /**
     *  创建一个随机字符串
     * @param   string  the type of string
     * @param   int     the number of characters
     * @return  string  the random string
     */
    public static function random($type = 'alnum', $length = 16)
    {
        switch ($type) {
            case 'basic':
                return mt_rand();
                break;

            default:
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
            case 'distinct':
            case 'hexdec':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;

                    default:
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;

                    case 'numeric':
                        $pool = '0123456789';
                        break;

                    case 'nozero':
                        $pool = '123456789';
                        break;

                    case 'distinct':
                        $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                        break;

                    case 'hexdec':
                        $pool = '0123456789abcdef';
                        break;
                }

                $str = '';
                for ($i = 0; $i < $length; $i++) {
                    $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
                }
                return $str;
                break;

            case 'unique':
                return md5(uniqid(mt_rand()));
                break;

            case 'sha1' :
                return sha1(uniqid(mt_rand(), true));
                break;
        }
    }


    public static function generateSalt()
    {
        return self::random('unique');
    }

    /**
     * @param string $salt
     * @param string $password
     * @return string
     */
    public static function generatePassword($salt, $password)
    {
        return md5($salt . $password);
    }

}