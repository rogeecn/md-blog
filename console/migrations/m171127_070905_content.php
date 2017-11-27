<?php

use yii\db\Migration;

class m171127_070905_content extends Migration
{
    private $_table = '{{%content}}';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'         => $this->primaryKey(),
            'post_id'    => $this->integer()->notNull(),
            'content'    => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}

