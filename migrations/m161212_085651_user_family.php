<?php

use yii\db\Migration;

class m161212_085651_user_family extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_family}}', [
            'user_id' => $this->integer()->notNull(),
            'family_id' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->addPrimaryKey('PK_liked', '{{%user_family}}', ['user_id', 'family_id']);

        $this->createIndex('user_family_user', '{{%user_family}}', 'user_id');
        $this->createIndex('user_family_family', '{{%user_family}}', 'family_id');

        $this->addForeignKey('FK_user_family_user', '{{%user_family}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('FK_user_family_travel', '{{%user_family}}', 'family_id', '{{%family}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_family_user', '{{%user_family}}');
        $this->dropForeignKey('FK_user_family_travel', '{{%user_family}}');
        $this->dropTable('{{%user_family}}');
    }
}
