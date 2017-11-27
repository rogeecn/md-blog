<?php
namespace common\extend;


use common\util\Util;

class Theme extends \yii\base\Theme
{
//    public function setTheme($themeName)
//    {
//        $this->setBasePath(sprintf("@themes/%s", $themeName));
//    }

    public function applyTo($path)
    {
        $applyFilePath = parent::applyTo($path);

        return Util::convertToThemeFile($applyFilePath);
    }
}