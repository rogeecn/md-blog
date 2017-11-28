<?php
namespace application\controllers;

use application\base\BaseController;
use common\models\Post;
use common\models\PostTag;
use common\models\Tag;
use common\utils\Request;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class TagListController extends BaseController
{
    public function actionIndex()
    {
        $tagName = Request::input("id");
        $tagID   = Tag::find()->where(['name' => $tagName])->one();
        if (!$tagID) {
            throw new NotFoundHttpException("TAG 未找到, " . $tagName);
        }

        $page       = Request::input("page", 1);
        $postTags   = PostTag::find()
                             ->where(['tag_id' => $tagID])
                             ->limit($this->pageItemCount)
                             ->offset(($page - 1) * $this->pageItemCount)
                             ->all();
        $tagPostIDs = ArrayHelper::getColumn($postTags, "post_id");

        $query        = Post::find()->where(['id' => $tagPostIDs]);
        $dataProvider = $this->getArticleListDataProvider($query);

        return $this->render([
            'dataProvider' => $dataProvider,
            'tag'          => $tagName,
        ]);
    }

}
