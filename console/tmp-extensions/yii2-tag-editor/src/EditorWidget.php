<?php
namespace rogeecn\TagEditor;

use yii\bootstrap\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

class EditorWidget extends InputWidget
{
    /**
     * editor options
     *
     * @var array
     */
    public $clientOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        if ($this->hasModel()) {
            $this->name = empty($this->options['name']) ?
                Html::getInputName($this->model, $this->attribute) :
                $this->options['name'];

            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }

        echo Html::tag('div', '', $this->options);
        $this->registerClientScript();
    }

    protected function registerClientScript()
    {
        $view = $this->getView();
        EditorAsset::register($view);

        $id = $this->options['id'];

        $clientOptions = $this->initClientOptions();
        $clientOptions = Json::htmlEncode($clientOptions);
        $clientOptions = str_replace('\/', "/", $clientOptions);
        $js            = sprintf("$('#%s').tagEditor(%s);", $id, $clientOptions);
        $view->registerJs($js);
    }

    protected function initClientOptions()
    {
        $options = [
            'initialTags'      => explode(",", $this->value),
            'autocomplete'     => [
                'source'    => '/manage/post/tag',
                'minLength' => 2,
            ],
            'maxTags'          => 5,
            'maxLength'        => 20,
            'delimiter'        => ', ',
            "placeholder"      => "Enter tags",
            "forceLowercase"   => FALSE,
            "removeDuplicates" => TRUE,
            "clickDelete"      => FALSE,
            "animateDelete"    => 50,
            "sortable"         => FALSE,
        ];

        return array_merge($options, $this->clientOptions);
    }
}