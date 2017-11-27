<?php
namespace common\utils;
/**
 * 封装请求参数获取
 */

class Request
{
    private static function getRequest()
    {
        return \Yii::$app->getRequest();
    }

    public static function rawInput()
    {
        return self::getRequest()->getRawBody();
    }

    public static function input($param = null, $default = null)
    {
        $val = self::cookie($param, null);
        if ($val !== null) {
            return self::cookie($param, $default);
        }

        $val = self::post($param, null);
        if ($val !== null) {
            return self::post($param, $default);
        }

        return self::get($param, $default);
    }

    public static function get($param = null, $default = null)
    {
        return self::getRequest()->get($param, $default);
    }

    public static function post($param = null, $default = null)
    {
        return self::getRequest()->post($param, $default);
    }

    public static function params()
    {
        return self::getRequest()->getParams();
    }

    public static function isAjax()
    {
        return self::getRequest()->getIsAjax();
    }

    public static function isPost()
    {
        return self::getRequest()->getIsPost();
    }

    public static function isPut()
    {
        return self::getRequest()->getIsPut();
    }

    public static function isPjax()
    {
        return self::getRequest()->getIsPjax();
    }

    public static function ip()
    {
        return self::getRequest()->getUserIP();
    }

    public static function getHostInfo()
    {
        return self::getRequest()->getHostInfo();
    }

    public static function cookie($key, $default = null)
    {
        return self::getRequest()->getCookies()->getValue($key, $default);
    }
}