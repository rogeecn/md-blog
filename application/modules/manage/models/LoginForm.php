<?php
namespace application\modules\manage\models;

use common\models\User;
use common\utils\UserSession;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $verifyCode;
    public $rememberMe = TRUE;

    private $_user;


    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],

            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'      => '电子邮箱',
            'password'   => '密码',
            'rememberMe' => '记住我',
            'verifyCode' => '验证码',
        ];

    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '电子邮箱或密码错误');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return UserSession::login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return FALSE;
    }

    protected function getUser()
    {
        if ($this->_user === NULL) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
