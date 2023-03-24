<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_180941_payments
 */
class m190611_180941_payments extends Migration
{
    const TableName = '{{%payments}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_user_to_farif'            => $this->integer()->unsigned()->notNull()->comment('ID клиента'),
            'bought'            => $this->decimal(8, 2)->notNull()->comment('Оплаченная цена'),
            'demo'              => $this->smallInteger(1)->defaultValue(0)->comment('Демо версия'),
            'created_at'        => $this->integer()->unsigned()->notNull()->comment('Дата первой оплаты'),
            'updated_at'        => $this->integer()->unsigned()->notNull()->comment('Дата последней оплаты'),
            'date_end'          => $this->integer()->unsigned()->notNull()->comment('Дата окончания'),
        ], $tableOptions);

        /**
         * Внещний ключ id_user
         */
        $this->addForeignKey(
            'PAYMENTS_ID_ACC_KEY_1',
            self::TableName,
            'id_user_to_farif',
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
        $this->dropForeignKey('PAYMENTS_ID_ACC_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }

}
