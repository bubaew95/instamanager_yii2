<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_185448_products
 */
class m190611_185448_products extends Migration
{
    const TableName = '{{%products}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_project'        => $this->integer()->unsigned()->notNull()->comment('ID проекта'),
            'name'              => $this->string(255)->notNull()->comment('Название продукта'),
            'latin_name'        => $this->string(255)->notNull()->comment('Латинское название'),
            'img'               => $this->string(512)->null()->comment('Изображение'),
            'text'              => $this->text()->null()->comment('Описание товара'),
            'discount'          => $this->tinyInteger(2)->unsigned()->defaultValue(0)->comment('Скидка'),
            'price'             => $this->decimal(8,2)->notNull()->comment('Цена товара'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
            'instaData'         => $this->tinyInteger(1)->defaultValue(0)->comment('выгрузка из инстаграмма'),
        ], $tableOptions);

        /**
         * Внещний ключ id_project
         */
        $this->addForeignKey(
            'PRODUCTS_ID_PROJECT_KEY_1',
            self::TableName,
            'id_project',
            '{{%projects}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('PRODUCTS_ID_PROJECT_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_185448_products cannot be reverted.\n";

        return false;
    }
    */
}
