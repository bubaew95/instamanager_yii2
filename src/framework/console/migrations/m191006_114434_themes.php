<?php

namespace console\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m191006_114434_themes extends Migration
{
    const TableName = '{{%themes}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'name'          => $this->string(100)->notNull()->comment('Название'),
            'latin_name'    => $this->string(120)->notNull()->unique()->comment('Латинское название'),
            'text'          => $this->string(512)->null()->comment('Описание шаблона'),
            'img'           => $this->string(255)->notNull()->comment('Изображение'),
        ], $tableOptions);

        $this->insert(self::TableName, [
            'name' => 'По умолчанию',
            'latin_name' => 'shopx',
            'text' => 'Шаблон магазина по умолчанию',
            'img' => 'images/themes/shopx.png',
        ]);

    }

    public function safeDown()
    {
        $this->dropTable(self::TableName);
    }
}