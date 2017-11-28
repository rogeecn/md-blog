<?php
namespace application\modules\manage\controllers\post;


use application\base\AuthController;
use application\modules\manage\models\PostForm;
use common\utils\Request;

class EditController extends AuthController
{
    public function actionIndex($id)
    {
        $model = new PostForm($id);

        if (Request::isPost() && $model->load(Request::input()) && $model->save()) {
            return $this->redirect("/");
        }

        return $this->render("index", [
            'model' => $model,
        ]);
    }
}
