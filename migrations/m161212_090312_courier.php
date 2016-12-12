<?php

use yii\db\Migration;

class m161212_090312_courier extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%courier}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'phone' => $this->integer()->unique(),
            'city' => $this->string(),
            'cost' => $this->integer()

        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%courier}}');
    }
}
