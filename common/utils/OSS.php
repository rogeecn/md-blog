<?php
namespace common\utils;

class OSS
{
    /** @var  AliyunOSS */
    private static $_client;

    private static function instance()
    {
        if (is_null(self::$_client)) {
            self::$_client = AliyunOSS::boot(
                Param::Get("oss.city"),
                Param::Get("oss.network_type"),
                Param::Get("oss.is_internal"),
                Param::Get("oss.access_key_id"),
                Param::Get("oss.access_key_secret")
            );

            self::$_client->setBucket(Param::Get("oss.bucket"));
        }

        return self::$_client;
    }

    public static function getContent($filePath)
    {
        return self::instance()->getObject(null, $filePath);
    }

    public static function putContent($content, $filePath = "/", $options = [])
    {
        return self::instance()->uploadContent($filePath, $content, $options);
    }


    public static function putFile($fromFile, $dstFile = "/")
    {
        return self::instance()->uploadFile($dstFile, $fromFile);
    }

    public static function delete($dstFile)
    {
        self::instance()->deleteObject(Param::Get("oss.bucket"), $dstFile);
    }
}