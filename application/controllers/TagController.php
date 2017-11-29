<?php
namespace application\controllers;

use application\base\BaseController;
use common\extend\Pagination;
use common\models\Tag;
use yii\data\ActiveDataProvider;

class TagController extends BaseController
{
    public function actionIndex()
    {
        $query = Tag::find()->orderBy(['ref_count' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'class'           => Pagination::className(),
                'defaultPageSize' => $this->pageItemCount * 20,
            ],
        ]);

        return $this->render([
            'dataProvider' => $dataProvider,
        ]);
    }
}
