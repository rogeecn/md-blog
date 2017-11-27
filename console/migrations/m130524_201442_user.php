<?php
use yii\db\Migration;

class m130524_201442_user extends Migration
{
    private $_table = '{{%user}}';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'                   => $this->primaryKey(),
            'email'                => $this->string()->notNull()->unique(),
            'nickname'             => $this->string()->notNull()->defaultValue(""),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status'               => $this->smallInteger()->notNull()->defaultValue(\common\models\User::STATUS_ACTIVE),
            'created_at'           => $this->integer(),
            'updated_at'           => $this->integer(),
        ]);

        $user           = new \common\models\User();
        $user->nickname = 'Rogee';
        $user->email    = 'rogeecn@qq.com';
        $user->setPassword('admin');
        $user->generateAuthKey();

        $user->save();
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
