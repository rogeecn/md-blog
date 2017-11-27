<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post_tag".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_id
 */
class PostTag extends \common\base\ActiveRecord
{
    protected $enableTimeBehavior = FALSE;

    public static function tableName()
    {
        return 'post_tag';
    }

    public static function getCurrentTags($postID)
    {
        $models = self::find()->where(['post_id' => $postID])->all();

        return ArrayHelper::getColumn($models, 'tag_id');
    }

    public static function removePostTags($postID, $pendingRemoveTags)
    {
        if (empty($pendingRemoveTags)) {
            return TRUE;
        }

        return self::deleteAll(['post_id' => $postID, 'tag_id' => $pendingRemoveTags]);
    }

    public static function addPostTags($postID, $pendingAddTags)
    {
        if (empty($pendingAddTags)) {
            return [];
        }

        $result = [];
        foreach ($pendingAddTags as $tagID) {
            $model = new self();
            $model->setAttributes([
                'post_id' => $postID,
                'tag_id'  => $tagID,
            ]);
            $result[$tagID] = $model->save();
        }

        return $result;
    }

    public static function removeTags($tagID = [])
    {
        if (empty($tagID)) {
            return 0;
        }

        return self::deleteAll(['tag_id' => $tagID]);
    }

    public static function savePostTags($postID, $tags)
    {
        $pendingTagID = Tag::getTagIDs($tags);
        $currentTags  = self::getCurrentTags($postID);

        $newTags = array_diff($pendingTagID, $currentTags);
        $delTags = array_diff($currentTags, $pendingTagID);

        self::removePostTags($postID, $delTags);
        self::addPostTags($postID, $newTags);

        Tag::addTagRef($newTags);
        Tag::descTagRef($delTags);

        return TRUE;
    }

    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'post_id' => 'Post ID',
            'tag_id'  => 'Tag ID',
        ];
    }
}
