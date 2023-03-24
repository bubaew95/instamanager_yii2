<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190617_213326_process
 */
class m190617_213326_process extends Migration
{

    const TableName = '{{%process}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'id_user'       => $this->integer()->unsigned()->notNull()->comment('Пользователь'),
            'id_project'    => $this->integer()->unsigned()->notNull()->comment('Проект'),
            'isProcess'     => $this->smallInteger(1)->defaultValue(0)->comment('Процесс'),
            'key'           => $this->string(255)->null()->comment('Ключ'),
            'created_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата процесса'),
            'updated_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата обновления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_product
         */
        $this->addForeignKey(
            'PROCESS_ID_USER_KEY_1',
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
            'PROGRESS_ID_PROJECT_KEY_2',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

        /**
         * Индексация поля
         */
        $this->createIndex(
            'index_ID_USER',
            self::TableName,
            'id_user'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('PROCESS_ID_USER_KEY_1', self::TableName);
        $this->dropForeignKey('PROGRESS_ID_PROJECT_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }

}
