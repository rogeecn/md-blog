<?php
namespace application\modules\manage\models;

use common\models\User;
use common\utils\UserSession;
use yii\base\Model;

class ManualResetPasswordForm extends Model
{
    public $password;
    public $new_password;
    public $confirm_password;
    public $verifyCode;

    /** @var  User */
    private $_user;

    public function attributeLabels()
    {
        return [
            'password'         => '密码',
            'new_password'     => '新密码',
            'confirm_password' => '重复密码',
            'verifyCode'       => '验证码',
        ];
    }

    public function rules()
    {
        return [
            [['password'], 'validatePassword'],
            [['password', 'new_password', 'confirm_password'], 'required'],
            [['password', 'new_password', 'confirm_password'], 'string', 'min' => 2],
            [['confirm_password'], 'compare', 'compareAttribute' => 'new_password'],

            ['verifyCode', 'captcha'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '原密码错误');
            }
        }
    }

    public function getUser()
    {
        if (is_null($this->_user)) {
            $this->_user = User::findOne(UserSession::getId());
        }

        return $this->_user;
    }

    public function resetPassword()
    {
        $user = $this->getUser();

        $user->setPassword($this->new_password);
        $user->removePasswordResetToken();

        return $user->save(FALSE);
    }
}
