<?php

namespace poprigun\chat\migration;
/* @var $this \yii\web\View */

use poprigun\chat\models\InnerMessage;
use yii\db\Schema;
use yii\db\Migration;

class m150818_115092_inner_message_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=0';
        }
        $this->createTable('{{%inner_message}}', [
            'id'                       => 'INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'dialog_id'                => 'INT(11) NOT NULL',
            'user_id'                  => 'INT(11) UNSIGNED NOT NULL',
            'message'                  => 'VARCHAR(2000) NULL DEFAULT NULL ',
            'view'                     => 'TINYINT(1) NOT NULL DEFAULT '.InnerMessage::NEW_MESSAGE,
            'status'                   => 'TINYINT(1) NOT NULL DEFAULT '.InnerMessage::STATUS_ACTIVE,
            'updated_at'               => 'DATETIME DEFAULT NULL',
            'created_at'               => 'DATETIME DEFAULT NULL',
        ], $tableOptions);

        $this->createIndex('idx-inner_message-dialog_id','{{%inner_message}}','dialog_id');
        $this->createIndex('idx-inner_message-user_id','{{%inner_message}}','user_id');

        $this->addForeignKey('fk-inner_message-dialog_id', '{{%inner_message}}', 'dialog_id', '{{%inner_message_dialog}}', 'id','CASCADE','CASCADE');
        $this->addForeignKey('fk-inner_message-user_id', '{{%inner_message}}', 'user_id', '{{%user}}', 'id','CASCADE','CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk-inner_message-dialog_id', '{{%inner_message}}');
        $this->dropForeignKey('fk-inner_message-user_id', '{{%inner_message}}');
        $this->dropTable('{{%inner_message}}');
    }
}
