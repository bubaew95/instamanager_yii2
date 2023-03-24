<?php

namespace console\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m191006_132245_shops extends Migration
{
    const TableName = '{{%shops}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'id_project'    => $this->integer()->unsigned()->notNull()->comment('Проект'),
            'id_theme'      => $this->integer()->unsigned()->notNull()->comment('Тема'),
            'img'           => $this->string(255)->notNull()->comment('Изображение'),
            'name'          => $this->string(100)->notNull()->comment('Название'),
            'latin_name'    => $this->string(120)->notNull()->unique()->comment('Латинское название'),
            'text'          => $this->string(512)->null()->comment('Описание'),
            'keywords'      => $this->string(255)->null()->comment('Ключевые слов'),
            'description'   => $this->string(255)->null()->comment('Краткое описание'),
            'created_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата создания'),
            'updated_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата изменения'),
        ], $tableOptions);

        $this->addForeignKey(
            'PROJECT_ID_KEY',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'THEME_ID_KEY',
            self::TableName,
            'id_theme',
            '{{%themes}}',
            'id',
            'CASCADE'
        );

        /**
         * Внешний ключ для id_shop с таблицей меню
         */
        $this->addForeignKey(
            'MENU_ID_SHOP_KEY_1',
            '{{%menu}}',
            'id_shop',
            self::TableName,
            'id'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey('PROJECT_ID_KEY', self::TableName);
        $this->dropForeignKey('THEME_ID_KEY', self::TableName);
        $this->dropTable(self::TableName);
    }
}