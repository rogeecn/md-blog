<?php

use yii\db\Migration;

class m171127_070853_post extends Migration
{
    private $_table = '{{%post}}';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull()->unique(),
            'slug'        => $this->string()->notNull()->defaultValue(""),
            'description' => $this->text(),
            'author'      => $this->integer()->notNull(),
            'layout'      => $this->string()->notNull(),
            'type'        => $this->string()->notNull(),
            'status'      => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at'  => $this->integer(),
            'updated_at'  => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}

