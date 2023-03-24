<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_192329_instagram_data
 */
class m190611_192329_instagram_data extends Migration
{
    const TableName = '{{%instagram_data}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'           => $this->primaryKey()->unsigned(),
            'id_instagram' => $this->integer()->unsigned()->notNull()->comment('ID инстаграм'),
            'id_product'   => $this->integer()->unsigned()->defaultValue(0)->comment('ID продукта'),
            'media_id'     => $this->string(255)->unsigned()->notNull()->comment('ID медиа в инстаграме'),
            'link'         => $this->string(255)->null()->comment('Ссылка на медиа'),
            'likes'        => $this->integer()->unsigned()->defaultValue(0)->comment('Количество лайков'),
            'comments'     => $this->integer()->unsigned()->defaultValue(0)->comment('Количество комментариев'),
        ], $tableOptions);

        /**
         * Внещний ключ id_instagram
         */
        $this->addForeignKey(
            'INSTAGRAM_DATA_ID_INSTAGRAM_KEY_1',
            self::TableName,
            'id_instagram',
            '{{%instagram}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_product
         */
        $this->addForeignKey(
            'INSTAGRAM_DATA_ID_PRODUCT_KEY_2',
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
        $this->dropForeignKey('INSTAGRAM_DATA_ID_INSTAGRAM_KEY_1', self::TableName);
        $this->dropForeignKey('INSTAGRAM_DATA_ID_PRODUCT_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }
}
