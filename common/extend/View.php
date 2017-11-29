<?php
namespace common\extend;


use common\utils\Param;

class View extends \yii\web\View
{
    private $keywords;
    private $description;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function appendTitle($title, $seperator = '-')
    {
        $this->title = sprintf("%s %s %s", $title, $seperator, $this->title);
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function head()
    {
        $title = Param::Get("site.title");
        if (!empty($this->title)) {
            $title = sprintf("%s - %s", $this->title, $title);
        }

        echo Html::tag("title", $title);
        echo "\n";

        //register keywords
        $defaultKeywords = Param::Get('site.keywords');
        $this->registerMetaTag([
            'name'    => 'keyword',
            'content' => empty($this->keywords) ? $defaultKeywords : $this->keywords,
        ], 'keyword');

        //register description
        $defaultDescription = Param::Get("site.description");
        $this->registerMetaTag([
            'name'    => 'description',
            'content' => empty($this->description) ? $defaultDescription : $this->description,
        ], 'description');

        parent::head();

        echo "\n";
        echo Param::Get("site.code_top");
    }

    public function endBody()
    {
        parent::endBody();
        echo "\n";
        echo Param::Get("site.code_bottom");
    }

    public function ICPNumber()
    {
        $ICPNumber = Param::Get("site.icp_number");
        if (!empty($ICPNumber)) {
            return Html::a($ICPNumber, "http://www.miitbeian.gov.cn/", ['target' => '_blank']);
        }

        return "";
    }

    public function PoliceNumber()
    {
        $PoliceNumber = Param::Get("site.police_number");
        if (!empty($PoliceNumber)) {
            return Html::a($PoliceNumber, "#");
        }

        return "";
    }

    public function commonMetaTags($tags = ['viewport', 'format-detection', 'X-UA-Compatible', 'renderer', 'Cache-Control'], $options = [])
    {
        $defaultOptions = [];
        foreach ($tags as $tag) {
            $tagOptions = [];
            if (isset($options[$tag])) {
                $tagOptions = $options[$tag];
            }

            switch ($tag) {
                case 'viewport':
                    $defaultOptions = [
                        'name'    => $tag,
                        'content' => 'width=device-width,height=device-height,user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1',
                    ];
                    break;

                case 'format-detection':
                    //忽略电话号码和邮箱
                    $defaultOptions = [
                        'name'    => $tag,
                        'content' => 'telphone=no, email=no',
                    ];
                    break;
                case 'X-UA-Compatible': //优先使用 IE 最新版本和 Chrome
                    $defaultOptions = [
                        'name'    => $tag,
                        'content' => 'IE=edge,chrome=1',
                    ];
                    break;
                case 'renderer':
                    $defaultOptions = [
                        'name'    => $tag,
                        'content' => 'webkit',
                    ];
                    break;
                case 'Cache-Control': //不让百度转码
                    $defaultOptions = [
                        'name'    => $tag,
                        'content' => 'no-siteapp',
                    ];
                    break;
                default:
                    continue;
            }

            $tagOptions = array_merge($defaultOptions, $tagOptions);
            $this->registerMetaTag($tagOptions);
        }
    }


    protected function findViewFile($view, $context = NULL)
    {
        $path = parent::findViewFile($view, $context);
        if (substr($path, -9) == "index.php") {
            return substr($path, 0, -10) . ".php";
        }

        return $path;
    }
}