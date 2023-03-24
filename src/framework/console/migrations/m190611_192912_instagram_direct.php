<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_192912_instagram_direct
 */
class m190611_192912_instagram_direct extends Migration
{
    const TableName = '{{%instagram_direct}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_user'           => $this->integer()->unsigned()->notNull()->comment('Пользователь'),
            'id_project'        => $this->integer()->unsigned()->notNull()->comment('Проект'),
            'id_instagram'      => $this->integer()->unsigned()->null()->comment('ID инстаграм'),
            'thread_id'         => $this->string(255)->notNull()->comment('ID диалога'),
            'user_id'           => $this->bigInteger()->unsigned()->notNull()->comment('ID собеседника'),
            'img'               => $this->string(512)->null()->comment('Изображение'),
            'user_name'         => $this->string(255)->null()->comment('Логин собеседника'),
            'isType'            => $this->boolean()->defaultValue(0)->comment('Печатает'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_user
         */
        $this->addForeignKey(
            'ID_USER_INSTAGRAM_KEY_1',
            self::TableName,
            'id_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_project
         */
        $this->addForeignKey(
            'ID_PROJECT_INSTAGRAM_KEY_2',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_instagram
         */
        $this->addForeignKey(
            'INSTAGRAM_DIRECT_ID_INSTAGRAM_KEY_3',
            self::TableName,
            'id_instagram',
            '{{%instagram}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ID_USER_INSTAGRAM_KEY_1', self::TableName);
        $this->dropForeignKey('ID_PROJECT_INSTAGRAM_KEY_2', self::TableName);
        $this->dropForeignKey('INSTAGRAM_DIRECT_ID_INSTAGRAM_KEY_3', self::TableName);
        $this->dropTable(self::TableName);
    }
}
