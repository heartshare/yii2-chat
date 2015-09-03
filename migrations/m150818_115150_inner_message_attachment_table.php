<?php

namespace poprigun\chat\migration;

use yii\db\Schema;
use yii\db\Migration;

class m150818_115150_inner_message_attachment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=0';
        }

        $this->createTable('{{%inner_message_attachment}}', [
            'id'                       => 'INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'message_id'               => 'INT(11) NOT NULL',
            'attachment'               => 'VARCHAR(500) NULL DEFAULT NULL',
            'updated_at'               => 'DATETIME DEFAULT NULL',
            'created_at'               => 'DATETIME DEFAULT NULL',
        ], $tableOptions);

        $this->createIndex('idx-inner_message_attachment-message_id','{{%inner_message_attachment}}','message_id');
        $this->addForeignKey('fk-inner_message_attachment-message_id', '{{%inner_message_attachment}}', 'message_id', '{{%inner_message}}', 'id','CASCADE','CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('fk-inner_message_attachment-message_id', '{{%inner_message_attachment}}');
        $this->dropTable('{{%inner_message_attachment}}');
    }
}
