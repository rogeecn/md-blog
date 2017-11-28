<?php
namespace application\controllers;

use application\base\BaseController;
use common\models\Post;
use common\utils\Request;
use common\utils\UserSession;
use yii\web\NotFoundHttpException;

class PageController extends BaseController
{
    public function actionIndex()
    {
        $id = Request::input("id");
        if (empty($id)) {
            $id = Request::input("pid");
        }

        /** @var Post $model */
        $model = Post::find()->where(['slug' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException("page not exist, id: " . $id);
        }

        if (UserSession::isGuest()) {
            if ($model->status != Post::STATUS_NORMAL) {
                throw new NotFoundHttpException("article has been removed!, " . $id);
            }
        }

        return $this->render("/template/" . $model->layout, [
            'model' => $model,
        ]);
    }
}
