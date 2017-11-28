<?php
namespace application\controllers;

use application\base\BaseController;
use common\extend\Pagination;
use common\models\Post;
use common\models\Tag;
use common\utils\UserSession;
use yii\data\ActiveDataProvider;

class TagController extends BaseController
{
    public function actionIndex()
    {
        $query = Tag::find();

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'class'           => Pagination::className(),
                'defaultPageSize' => $this->pageItemCount * 10,
            ],
        ]);

        return $this->render([
            'dataProvider' => $dataProvider,
        ]);
    }
}
