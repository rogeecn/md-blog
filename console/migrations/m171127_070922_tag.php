<?php

use yii\db\Migration;

class m171127_070922_tag extends Migration
{
    private $_table = '{{%tag}}';

    public function safeUp()
    {
        $this->createTable($this->_table, [
            'id'        => $this->primaryKey(),
            'name'      => $this->string()->notNull(),
            'ref_count' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}

