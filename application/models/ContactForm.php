<?php

namespace application\models;

use Yii;
use yii\base\Model;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'       => '姓名',
            'email'      => '电子邮箱',
            'subject'    => '标题',
            'body'       => '内容',
            'verifyCode' => '验证码',
        ];
    }

    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
                                ->setTo($email)
                                ->setFrom([$this->email => $this->name])
                                ->setSubject($this->subject)
                                ->setTextBody($this->body)
                                ->send();
    }
}
