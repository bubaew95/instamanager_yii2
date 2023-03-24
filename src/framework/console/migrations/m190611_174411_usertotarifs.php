<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_174411_usertotarifs
 */
class m190611_174411_usertotarifs extends Migration
{
    const TableName = '{{%user_to_tarifs}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_user'           => $this->integer()->unsigned()->defaultValue(0)->comment('ID клиента'),
            'id_tarif'        => $this->integer()->unsigned()->defaultValue(0)->comment('ID аккаунта'),
        ], $tableOptions);

        /**
         * Внешний ключ для id_user
         */
        $this->addForeignKey(
            'USER_TO_TARIFS_ID_USER_KEY_1',
            self::TableName,
            'id_user',
            '{{%users}}',
            'id'
        );

        /**
         * Внешний ключ для id_service
         */
        $this->addForeignKey(
            'USER_TO_TARIFS_ID_SERVICE_KEY_2',
            self::TableName,
            'id_tarif',
            '{{%tarifs}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('USER_TO_TARIFS_ID_USER_KEY_1', self::TableName);
        $this->dropForeignKey('USER_TO_TARIFS_ID_SERVICE_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }
}
