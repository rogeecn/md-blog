<?php
namespace application\controllers;

use application\base\BaseController;
use common\models\Post;
use common\utils\Request;

class SearchController extends BaseController
{
    public function actionIndex()
    {
        $keyword = Request::input("keyword");
        if (empty($keyword)) {
            return $this->goBack();
        }


        $query = Post::find();
        $query->andFilterWhere(['like', 'title', $keyword]);
        $dataProvider = $this->getArticleListDataProvider($query);

        return $this->render([
            'keyword'      => $keyword,
            'dataProvider' => $dataProvider,
        ]);
    }
}
