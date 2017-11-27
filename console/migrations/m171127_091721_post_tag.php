<?php

use yii\db\Migration;

class m171127_091721_post_tag extends Migration
{
    private $_table = '{{%post_tag}}';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'      => $this->primaryKey(),
            'post_id' => $this->integer(),
            'tag_id'  => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}

