<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string  $name
 * @property integer $ref_count
 */
class Tag extends \common\base\ActiveRecord
{
    protected $enableTimeBehavior = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ref_count'], 'integer'],
            [['ref_count'], 'default', 'value' => 0],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'name'      => 'Name',
            'ref_count' => 'Ref Count',
        ];
    }

    public static function getTagIDs($tags)
    {
        $models = self::find()->where(['name' => $tags])->all();

        $existTags   = ArrayHelper::getColumn($models, 'name');
        $existTagIDs = ArrayHelper::getColumn($models, 'id');
//        self::addTagRef($existTagIDs);

        $notExistTags = array_diff($tags, $existTags);

        $newTagResult = self::addTags($notExistTags);
        $newTagID     = array_values($newTagResult);

        $retList = array_merge($newTagID, $existTagIDs);
        sort($retList);

        return $retList;
    }

    public static function addTagRef($tagIDs)
    {
        if (empty($tagIDs)) {
            return true;
        }

        $sql = sprintf('update %s set ref_count = ref_count+1 where id in (%s)', self::tableName(), implode(",", $tagIDs));

        return self::command($sql, [])->execute();
    }

    public static function descTagRef($tagIDs)
    {
        if (empty($tagIDs)) {
            return true;
        }

        $sql = sprintf('update %s set ref_count = ref_count-1 where id in (%s)', self::tableName(), implode(",", $tagIDs));

        return self::command($sql, [])->execute();
    }


    public static function addTags($tags)
    {
        $result = [];
        foreach ($tags as $tag) {
            $model            = new self();
            $model->name      = $tag;
            $model->ref_count = 0;
            $model->save();
            $result[$tag] = $model->primaryKey;
        }

        return $result;
    }

    public static function totalCount()
    {
        return self::find()->count();
    }
}
