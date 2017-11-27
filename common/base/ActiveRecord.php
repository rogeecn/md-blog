<?php
namespace common\base;


use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{
    protected $enableTimeBehavior = TRUE;

    public function behaviors()
    {
        $behaviors = [];
        if ($this->enableTimeBehavior) {
            $behaviors[] = [
                'class' => TimestampBehavior::className(),
            ];
        }

        return $behaviors;
    }

    public static function command($sql, $params)
    {
        return self::getDb()->createCommand($sql, $params);
    }
}