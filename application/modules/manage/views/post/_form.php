<?php
use yiier\editor\EditorMdWidget;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \application\modules\manage\models\PostForm */

?>
<style>
    div.radio {
        display: inline-block;
        border: 1px solid lightgray;
        padding: 2px 5px;
        margin-right: 15px;
    }

    .editormd-fullscreen {
        z-index: 9999999;
    }
</style>
<?php
$form = \yii\bootstrap\ActiveForm::begin();
?>
<?= $form->errorSummary($model); ?>

<?= $form->field($model, "title") ?>
<?= $form->field($model, "slug") ?>

<?= $form->field($model, "content")->widget(EditorMdWidget::className(), [
    'options'       => [// html attributes
        'id' => 'content',
    ],
    'clientOptions' => [
        'height'               => '640',
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
        'imageUploadURL'       => '/file/blog-upload?type=default&filekey=editormd-image-file',
    ],
]) ?>

<?= $form->field($model, "tag") ?>
<?= $form->field($model, "status")->radioList($model->statusList()) ?>
<?= $form->field($model, "type")->radioList($model->typeList()) ?>
<?= $form->field($model, "layout")->dropDownList($model->layoutList()) ?>

<?= \yii\bootstrap\Html::submitButton("提交", ['class' => 'btn btn-primary']) ?>

<?php \yii\bootstrap\ActiveForm::end() ?>
