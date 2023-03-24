<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190612_091929_cart
 */
class m190612_091929_cart extends Migration
{
    const TableName = '{{%cart}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_product'        => $this->integer()->unsigned()->notNull()->comment('ID продукта'),
            'user_id'           => $this->integer()->unsigned()->notNull()->comment('ID пользователя инстаграм'),
            'thread_id'         => $this->string(255)->notNull()->comment('ID диалога'),
            'thread_item_id'    => $this->string(255)->notNull()->comment('ID сообщения'),
            'key'               => $this->string(255)->notNull()->comment('Ключ'),
            'value'             => $this->string(255)->notNull()->comment('Значение'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_product
         */
        $this->addForeignKey(
            'CART_ID_PRODUCT_KEY_1',
            self::TableName,
            'id_product',
            '{{%products}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('CART_ID_PRODUCT_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }
}
