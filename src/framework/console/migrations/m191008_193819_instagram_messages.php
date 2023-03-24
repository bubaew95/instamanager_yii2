<?php

namespace console\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m191008_193819_instagram_messages extends Migration
{
    const TableName = '{{%instagram_messages}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'             => $this->primaryKey()->unsigned(),
            'id_direct'      => $this->integer()->unsigned()->notNull()->comment('Директ'),
            'thread_item_id' => $this->string(512)->notNull()->comment('Id сообщения'),
            'text'           => $this->text()->null()->comment('Текст сообщения'),
            'isInterlocutor' => $this->boolean()->defaultValue(0)->comment('Собеседник'),
            'created_at'    => $this->bigInteger()->unsigned()->defaultValue(0)->comment('Дата создания'),
        ], $tableOptions);

        $this->addForeignKey(
          'ID_DIRECT_KEY',
          self::TableName,
          'id_direct',
          '{{%instagram_direct}}',
          'id',
          'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('ID_DIRECT_KEY', self::TableName);
        $this->dropTable(self::TableName);
    }
}