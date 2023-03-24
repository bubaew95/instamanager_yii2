<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_183409_projects
 */
class m190611_183409_projects extends Migration
{
    const TableName = '{{%projects}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_user_to_tarif'   => $this->integer()->unsigned()->notNull()->comment('ID пользователя'),
            'name' => $this->string(255)->notNull()->comment('Название проекта'),
            'created_at' => $this->integer()->unsigned()->defaultValue(0)->comment('Дата создания'),
            'updated_at' => $this->integer()->unsigned()->defaultValue(0)->comment('Дата обновления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_user
         */
        $this->addForeignKey(
            'PROJECTS_ID_ACC_KEY_1',
            self::TableName,
            'id_user_to_tarif',
            '{{%user_to_tarifs}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('PROJECTS_ID_ACC_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }
}
