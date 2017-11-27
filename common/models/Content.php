<?php

namespace common\models;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string  $content
 */
class Content extends \common\base\ActiveRecord
{
    protected $enableTimeBehavior = FALSE;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'post_id' => 'Post ID',
            'content' => 'Content',
        ];
    }
}
