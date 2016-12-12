<?php

use yii\db\Migration;

class m161212_085455_family extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%family}}', [
            'id' => $this->primaryKey(),
            'family_name' => $this->string()->unique(),

        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%family}}');
    }
}
