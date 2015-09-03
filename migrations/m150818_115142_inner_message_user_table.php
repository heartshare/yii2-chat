<?php

namespace poprigun\chat\migration;

use yii\db\Schema;
use yii\db\Migration;

class m150818_115142_inner_message_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=0';
        }

        $this->createTable('{{%inner_message_user}}', [
            'id'                       => 'INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'dialog_id'                => 'INT(11) NOT NULL',
            'user_id'                  => 'INT(11) UNSIGNED NOT NULL',
            'updated_at'               => 'DATETIME DEFAULT NULL',
            'created_at'               => 'DATETIME DEFAULT NULL',
        ], $tableOptions);

        $this->createIndex('idx-inner_message_user-dialog_id','{{%inner_message_user}}','dialog_id');
        $this->createIndex('idx-inner_message_user-user_id','{{%inner_message_user}}','user_id');

        $this->addForeignKey('fk-inner_message_user-dialog_id', '{{%inner_message_user}}', 'dialog_id', '{{%inner_message_dialog}}', 'id','CASCADE','CASCADE');
        $this->addForeignKey('fk-inner_message_user-user_id', '{{%inner_message_user}}', 'user_id', '{{%user}}', 'id','CASCADE','CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk-inner_message_user-dialog_id', '{{%inner_message_user}}');
        $this->dropForeignKey('fk-inner_message_user-user_id', '{{%inner_message_user}}');
        $this->dropTable('{{%inner_message_user}}');
    }
}
