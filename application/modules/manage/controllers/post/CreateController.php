<?php
namespace application\modules\manage\controllers\post;

use application\base\AuthController;
use application\modules\manage\models\PostForm;
use common\utils\Request;

class CreateController extends AuthController
{
    public function actionIndex()
    {
        $model = new PostForm();
        if (Request::isPost() && $model->load(Request::input()) && $model->save()) {
            return $this->redirect("/result/success");
        }

        return $this->render("index", [
            'model' => $model,
        ]);
    }
}