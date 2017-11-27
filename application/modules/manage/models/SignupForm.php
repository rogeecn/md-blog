<?php
namespace application\modules\manage\models;

use common\models\User;
use yii\base\Model;

class SignupForm extends Model
{
    public $nickname;
    public $email;
    public $password;
    public $verifyCode;

    public function attributeLabels()
    {
        return [
            'email'      => '电子邮箱',
            'nickname'   => '用户名称',
            'password'   => '密码',
            'verifyCode' => '验证码',
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nickname', 'trim'],
            ['nickname', 'required'],
            ['nickname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此邮箱已经被注册'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return NULL;
        }

        $user           = new User();
        $user->nickname = $this->nickname;
        $user->email    = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : NULL;
    }
}
