<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190612_092623_orders
 */
class m190612_092623_orders extends Migration
{
    const TableName = '{{%orders}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'id_product'    => $this->integer()->unsigned()->notNull()->comment('ID продукта'),
            'qty'           => $this->integer()->unsigned()->defaultValue(0)->comment('Кол-во'),
            'price'         => $this->decimal(8, 2)->defaultValue(0)->comment('Цена'),
            'img'           => $this->string(255)->null()->comment('Изображение'),
            'created_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
            'updated_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата обновления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_product
         */
        $this->addForeignKey(
            'ORDERS_ID_PRODUCT_KEY_1',
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
        $this->dropForeignKey('ORDERS_ID_PRODUCT_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_092623_orders cannot be reverted.\n";

        return false;
    }
    */
}
