<?php
namespace application\modules\manage\controllers\post;

use application\base\AuthRestController;
use common\models\Tag;
use common\utils\Request;
use yii\helpers\ArrayHelper;

class TagController extends AuthRestController
{
    public function actionIndex()
    {
        $term = Request::input("term");
        $term = trim($term);
        if (empty($term)) {
            return [];
        }
        $tagModel = Tag::find()->where(['like', 'name', $term])->limit(10)->all();
        $tagList  = ArrayHelper::getColumn($tagModel, "name");

        return $tagList;
    }
}