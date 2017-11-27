<?php
namespace common\utils;


use yii\base\Component;

/**
 * 便捷获取param参数
 * Class Param
 *
 * @package common\util
 */
class Param extends Component
{
    public static function Get($key)
    {
        $params = \Yii::$app->params;
        $keys   = explode('.', $key);
        foreach ($keys as $key) {
            if (!isset($params[$key])) {
                return FALSE;
            }

            $params = $params[$key];
        }

        return $params;
    }
}