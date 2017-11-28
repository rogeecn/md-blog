<?php
use yiier\editor\EditorMdWidget;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \application\modules\manage\models\PostForm */

$editorOptions = [
    'options'       => [// html attributes
        'id' => 'content',
    ],
    'clientOptions' => [
        'height'               => '500',
        // 'previewTheme' => 'dark',
        //            'editorTheme'          => 'pastel-on-dark',
        'markdown'             => '',
        'codeFold'             => TRUE,
        'saveHTMLToTextarea'   => TRUE,    // 保存 HTML 到 Textarea
        'searchReplace'        => TRUE,
        'syncScrolling'        => TRUE,
        'watch'                => FALSE,
        'htmlDecode'           => 'style,script,iframe|on*',            // 开启 HTML 标签解析，为了安全性，默认不开启
        'toolbar '             => FALSE,             //关闭工具栏
        'previewCodeHighlight' => FALSE, // 关闭预览 HTML 的代码块高亮，默认开启
        'emoji'                => TRUE,
        'taskList'             => TRUE,
        'tocm           '      => FALSE,         // Using [TOCM]
        'tex'                  => FALSE,    // 开启科学公式TeX语言支持，默认关闭
        'flowChart'            => FALSE,             // 开启流程图支持，默认关闭
        'sequenceDiagram'      => FALSE,       // 开启时序/序列图支持，默认关闭,
        // 'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
        // 'dialogShowMask' => false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
        // 'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
        // 'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
        // 'dialogMaskBgColor' => '#000', // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
        'imageUpload'          => TRUE,
        'imageFormats'         => ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'],
        'imageUploadURL'       => '/manage/post/image/upload?type=default&filekey=editormd-image-file',
        'toolbarIcons'         => [
            "h2",
            "h3",
            "h4",
            "h5",
            "h6",
            "bold",
            "del",
            "italic",
            "quote",
            "link",
            "image",
            "code-block",
            "table",
            "emoji",
            "|",
            "list-ul",
            "list-ol",
            "hr",
            "pagebreak",
            "|",
            "preview",
            "watch",
            "fullscreen",
        ],
    ],
];
?>
<style>

    .editormd-fullscreen {
        z-index: 9999999;
    }
</style>
<?php
$form = \yii\bootstrap\ActiveForm::begin();
?>
<?= $form->errorSummary($model); ?>

<div class="row">
    <div class="col-md-10">

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, "title") ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, "slug") ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, "tag") ?>
            </div>
        </div>

        <?= $form->field($model, "content")->widget(EditorMdWidget::className(), $editorOptions) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, "type")->radioList($model->typeList()) ?>
        <?= $form->field($model, "status")->radioList($model->statusList()) ?>
        <?= $form->field($model, "layout")->dropDownList($model->layoutList()) ?>
        <?= \yii\bootstrap\Html::submitButton("提交", ['class' => 'btn btn-primary btn-block btn-lg']) ?>
    </div>
</div>


<?php \yii\bootstrap\ActiveForm::end() ?>
