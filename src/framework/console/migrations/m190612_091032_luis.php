<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190612_091032_luis
 */
class m190612_091032_luis extends Migration
{
    const TableName = '{{%luis}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_project'        => $this->integer()->unsigned()->comment('Проект'),
            'id_tarif'          => $this->integer()->unsigned()->comment('Тариф'),
            'app_key'           => $this->string(255)->notNull()->comment('Ключ'),
            'subscription_key'  => $this->string(255)->notNull()->comment('Ключ подписки'),
            'verbose'           => $this->boolean()->defaultValue(true)->comment('Показать весь массив'),
            'active'            => $this->boolean()->defaultValue(true)->comment('Активность'),
        ], $tableOptions);

        /**
         * Внещний ключ id_project
         */
        $this->addForeignKey(
            'LUIS_ID_PROJECT_KEY_1',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_user_module
         */
        $this->addForeignKey(
            'LUIS_ID_VERSION_KEY_2',
            self::TableName,
            'id_tarif',
            '{{%tarifs}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('LUIS_ID_PROJECT_KEY_1', self::TableName);
        $this->dropForeignKey('LUIS_ID_VERSION_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }
}
