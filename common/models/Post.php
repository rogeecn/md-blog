<?php

namespace common\models;

use cebe\markdown\GithubMarkdown;
use common\utils\UserSession;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
    const STATUS_NORMAL = 0;
    const STATUS_DRAFT  = 1;
    const STATUS_REMOVE = 2;

    const TYPE_ARTICLE = 0;
    const TYPE_PAGE    = 1;

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

    public function beforeSave($insert)
    {
        if (empty($this->slug)) {
            $this->slug = sprintf("%s-%s", $this->generateRandomString(16), time());
        }

        return parent::beforeSave($insert);
    }

    public function generateRandomString($length)
    {
        $chars        = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $shuffleChars = str_shuffle($chars);

        return substr($shuffleChars, 0, $length);
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

    public function renderDescription()
    {
        $parser = new GithubMarkdown();

        return $parser->parse($this->description);
    }

    public function renderContent()
    {
        $content = $this->content->content;
        $parser  = new GithubMarkdown();

        $content = str_replace("[========]", "", $content);

        return $parser->parse($content);
    }

    public static function totalCount()
    {
        $condition = [
            'status' => self::STATUS_NORMAL,
            'type'   => self::TYPE_ARTICLE,
        ];
        if (!UserSession::isGuest()) {
            return self::find()->count();
        }

        return self::find()->where($condition)->count();
    }

    public function renderTitle()
    {
        $defaultTitle = Html::encode($this->title);
        if (UserSession::isGuest()) {
            return $defaultTitle;
        }

        $title = "";
        if ($this->author == UserSession::getId()) {
            switch ($this->status) {
                case self::STATUS_REMOVE:
                    $prefix = "[删除] ";
                    break;
                case self::STATUS_DRAFT:
                    $prefix = "[草稿] ";
                    break;
                default:
                    $prefix = "";
            }
            $title = $prefix . $defaultTitle;
        }

        return $title;
    }
}
