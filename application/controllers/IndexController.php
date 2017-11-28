<?php
namespace application\controllers;

use application\base\BaseController;
use common\models\Post;
use yii\data\ActiveDataProvider;

class IndexController extends BaseController
{
    public function actionIndex()
    {

        $query        = Post::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render([
            'dataProvider' => $dataProvider,
        ]);
    }
}
