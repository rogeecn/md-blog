<?php
namespace common\utils;

class Json
{
    public static function success($data = [])
    {
        return self::output(0, $data);
    }

    public static function error($data = [], $code = 1)
    {
        return self::output($code, $data);
    }

    private static function output($code, $data)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data                        = [
            'code' => $code,
            'data' => $data,
        ];

        return $data;
    }
}