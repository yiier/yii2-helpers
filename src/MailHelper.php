<?php

namespace yiier\helpers;

/**
 * Class MailHelper
 * @package common\helpers
 */
class MailHelper
{

    /**
     * @var array MX 服务器所对应的 URL
     */
    static $mxServerWebAppUrl = [

        // 163、126
        'qiye163mx01.mxmail.netease.com' => 'http://qiye.163.com',
        'qiye163mx02.mxmail.netease.com' => 'http://qiye.163.com',
        // qq.com
        'mxbiz1.qq.com' => 'http://exmail.qq.com',
        'mxbiz2.qq.com' => 'http://exmail.qq.com',
        // gmail
        'aspmx.l.google.com' => 'http://mail.google.com',
        'alt1.aspmx.l.google.com' => 'http://mail.google.com',
        'alt2.aspmx.l.google.com' => 'http://mail.google.com',
        'aspmx2.googlemail.com' => 'http://mail.google.com',
        'aspmx3.googlemail.com' => 'http://mail.google.com',
        'aspmx4.googlemail.com' => 'http://mail.google.com',
        'aspmx5.googlemail.com' => 'http://mail.google.com',

    ];

    /**
     * Get mail web application url
     *
     * @example `bob@idarex.com` Web url is `http://exmail.qq.com`
     * @param $email
     * @return string
     */
    public static function getWebAppUrl($email)
    {
        list(, $emailDomain) = explode('@', $email);

        switch ($emailDomain) {
            case "163.com":
                return "http://mail.163.com";
                break;
            case "qq.com":
                return "http://mail.qq.com";
                break;
            case "126.com":
                return "http://mail.126.com";
                break;
            case "gmail.com":
                return "http://mail.google.com";
                break;
            default:
                $mxHosts = [];
                if (getmxrr($emailDomain, $mxHosts)) {
                    foreach ($mxHosts as $row) {
                        if (isset(static::$mxServerWebAppUrl[$row])) {
                            return static::$mxServerWebAppUrl[$row];
                        }
                    }
                }

                return "http://mail.{$emailDomain}";
                break;
        }
    }
}
