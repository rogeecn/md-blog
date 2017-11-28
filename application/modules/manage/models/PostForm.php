<?php
namespace application\modules\manage\models;

use common\models\Content;
use common\models\Post;
use common\models\PostTag;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PostForm extends Model
{
    const CONTENT_SEPARATOR = "[========]";

    public $tag;
    public $title;
    public $slug;
    public $content;
    public $layout;
    public $status = 0;
    public $type   = 0;

    /** @var  Post */
    private $postModel;
    private $_id;

    public function __construct($id = NULL)
    {
        $this->_id = $id;
        if ($this->isNewRecord()) {
            $this->postModel = new Post();
        } else {
            $this->postModel = Post::findOne($id);
            if (!$this->postModel) {
                throw new NotFoundHttpException();
            }

            $this->initFormData();
        }

        parent::__construct([]);
    }

    public function isNewRecord()
    {
        return is_null($this->_id);
    }

    public function rules()
    {
        return [
            [['tag', 'title', 'status', 'content', 'type', 'layout'], 'required'],
            [['title', 'slug', 'content', 'layout'], 'string'],
            [['title', 'slug'], 'trim'],
            [['slug'], 'unique'],
            [['slug'], 'match', 'pattern' => '/^[a-z|0-9|\-]+$/'],
        ];
    }

    public function getStatus($id)
    {
        $list = $this->statusList();

        return $list[$id];
    }

    public function statusList()
    {
        return ['发布', '草稿', '删除'];
    }

    public function layoutList()
    {
        $configFile = \Yii::getAlias("@application/views/theme.json");
        if (!is_file($configFile)) {
            return [
                'default' => 'default',
            ];
        }
        $configContent = file_get_contents($configFile);
        $config        = json_decode($configContent, TRUE);
        $templates = ArrayHelper::map($config['templates'], "file", "name");

        return $templates;
    }

    public function typeList()
    {
        return ["文章", '页面'];
    }

    public function attributeLabels()
    {
        return [
            'tag'     => '标签',
            'title'   => '标题',
            'slug'    => '别名',
            'content' => '文章内容',
            'status'  => '状态',
            'type'    => '类型',
            'layout'  => '模板',
        ];
    }


    protected function getContentDescription()
    {
        $pos = strpos($this->content, self::CONTENT_SEPARATOR);
        if (FALSE === $pos) {
            return "";
        }

        return substr($this->content, 0, $pos);
    }

    public function getId()
    {
        return $this->postModel->primaryKey;
    }

    public function save()
    {
        $trans = \Yii::$app->getDb()->beginTransaction();
        try {
            $this->postModel->setAttributes([
                'title'       => $this->title,
                'slug'        => $this->slug,
                'type'        => $this->type,
                'status'      => $this->status,
                'layout'      => $this->layout,
                'description' => $this->getContentDescription(),
            ]);

            # 更新时不能更新用户ID
            if ($this->isNewRecord()) {
                $this->postModel->author = \Yii::$app->getUser()->getId();
            }

            if (!$this->postModel->save()) {
                foreach ($this->postModel->getErrors() as $attribute => $errorString) {
                    $this->addError($attribute, implode("\n", $errorString));
                }
                throw new Exception("save post fail");
            }

            /** @var Content $contentModel */
            if ($this->isNewRecord()) {
                $contentModel          = new Content();
                $contentModel->post_id = $this->postModel->primaryKey;
            } else {
                $contentModel = $this->postModel->content;
            }
            $contentModel->content = $this->content;

            if (!$contentModel->save()) {
                foreach ($contentModel->getErrors() as $attribute => $errorString) {
                    $this->addError("content." . $attribute, implode("\n", $errorString));
                }
                throw new Exception("save content fail");
            }

            PostTag::savePostTags($this->postModel->primaryKey, $this->getTagArray());

            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();

            return FALSE;
        }

        return TRUE;
    }

    protected function getTagArray()
    {
        $tag = strtr($this->tag, [
            "，" => ",",
            " " => "",
            ":" => "",
        ]);
        $tag = explode(",", $tag);
        $tag = array_unique(array_filter($tag));

        return $tag;
    }

    public function initFormData()
    {
        $this->title  = $this->postModel->title;
        $this->slug   = $this->postModel->slug;
        $this->status = $this->postModel->status ?: 0;
        $this->layout = $this->postModel->layout;
        $this->type   = $this->postModel->type;

        $this->content = $this->postModel->content->content;

        $this->tag = $this->postModel->getTags();
    }
}
