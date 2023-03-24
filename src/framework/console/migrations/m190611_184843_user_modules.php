<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_184843_user_modules
 */
class m190611_184843_user_modules extends Migration
{
    const TableName = '{{%user_modules}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_project'        => $this->integer()->unsigned()->notNull()->comment('ID проекта'),
            'id_module'         => $this->integer()->unsigned()->notNull()->comment('ID модуля'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
        ], $tableOptions);


        /**
         * Внещний ключ id_project
         */
        $this->addForeignKey(
            'USER_MODULES_ID_PROJECT_KEY_1',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_module
         */
        $this->addForeignKey(
            'USER_MODULES_ID_MODULE_KEY_2',
            self::TableName,
            'id_module',
            '{{%module}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('USER_MODULES_ID_PROJECT_KEY_1', self::TableName);
        $this->dropForeignKey('USER_MODULES_ID_MODULE_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }
}
