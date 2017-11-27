<?php
namespace application\modules\manage\controllers\post;

use application\base\AuthRestController;
use common\utils\OSS;
use common\utils\Param;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ImageController extends AuthRestController
{
    public function actionUpload()
    {
        $allowImageExt  = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'];
        $uploadInstance = UploadedFile::getInstanceByName("editormd-image-file");
        $ext            = $uploadInstance->getExtension();
        if (!in_array($ext, $allowImageExt)) {
            return $this->message("非法文件类型");
        }

        $fileName = sprintf("blog/%s-%s.%s", $uploadInstance->getBaseName(), time(), $ext);
        $filePath = \Yii::getAlias(sprintf("@runtime/%s", $fileName));
        if (!is_dir(dirname($filePath))) {
            FileHelper::createDirectory(dirname($filePath));
        }

        if ($uploadInstance->saveAs($filePath)) {
            OSS::putFile($filePath, $fileName);
            unlink($filePath);
            $url = sprintf("%s/%s", Param::Get("oss.domain"), $fileName);

            return $this->message($url, 1);
        }

        return $this->message($this->getErrorMsg($uploadInstance->error));
    }

    private function message($message, $success = 0)
    {
        $array = [
            'success' => $success,
        ];

        if ($success == 1) {
            $array['url'] = $message;
        } else {
            $array['message'] = $message;
        }

        return $array;
    }

    private function getErrorMsg($code)
    {

        switch ($code) {
            case '0':
                $message = "文件上传成功";
                break;

            case '1':
                $message = "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
                break;

            case '2':
                $message = "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                break;

            case '3':
                $message = "文件只有部分被上传";
                break;

            case '4':
                $message = "没有文件被上传";
                break;

            case '6':
                $message = "找不到临时目录";
                break;

            case '7':
                $message = "写文件到硬盘时出错";
                break;

            case '8':
                $message = "某个扩展停止了文件的上传";
                break;

            case '999':
            default:
                $message = "未知错误，请检查文件是否损坏、是否超大等原因。";
                break;
        }

        return $message;
    }
}