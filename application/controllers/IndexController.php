<?php
namespace application\controllers;

use application\base\BaseController;
use common\models\Post;
use rogeecn\TagEditor\EditorAsset;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        $query        = Post::find();
        $dataProvider = $this->getArticleListDataProvider($query);

        return $this->render([
            'dataProvider' => $dataProvider,
        ]);
    }
}
