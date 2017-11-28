<?php

namespace common\models;

use cebe\markdown\GithubMarkdown;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $slug
 * @property string  $description
 * @property integer $author
 * @property string  $layout
 * @property string  $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \common\base\ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['title', 'author', 'layout', 'type'], 'required'],
            [['description'], 'string'],
            [['author', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'layout', 'type'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => 'Title',
            'slug'        => 'Slug',
            'description' => 'Description',
            'author'      => 'Author',
            'layout'      => 'Layout',
            'type'        => 'Type',
            'status'      => 'Status',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
    }

    public function getContent()
    {
        return $this->hasOne(Content::className(), ['post_id' => 'id']);
    }

    public function getTags()
    {

        $tagNames = $this->getTagModel();
        $names    = ArrayHelper::getColumn($tagNames, "name");

        return implode(",", $names);
    }

    public function getTagModel()
    {
        $tagIDs   = PostTag::getCurrentTags($this->primaryKey);
        $tagNames = Tag::find()->where(['id' => $tagIDs])->all();

        return $tagNames;
    }

    public function descriptionHtml()
    {
        $parser = new GithubMarkdown();

        return $parser->parse($this->description);
    }
}
