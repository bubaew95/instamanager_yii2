<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190617_211134_notify
 */
class m190617_211134_notify extends Migration
{
    const TableName = '{{%notify}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'            => $this->primaryKey()->unsigned(),
            'id_user'       => $this->integer()->unsigned()->notNull()->comment('Пользователь'),
            'status'        => $this->string(15)->notNull()->comment('Статус оповещения'),
            'text'          => $this->string(255)->notNull()->comment('Текст оповещения'),
            'isAllPage'     => $this->smallInteger(1)->defaultValue(0)->comment('Оповещение на всю страницу'),
            'created_at'    => $this->integer()->unsigned()->defaultValue(0)->comment('Дата оповещения'),
            'isSaw'         => $this->smallInteger(1)->defaultValue(0)->comment('Клиент видел'),
        ], $tableOptions);

        /**
         * Внещний ключ id_product
         */
        $this->addForeignKey(
            'NOTIFY_ID_USER_KEY_1',
            self::TableName,
            'id_user',
            '{{%users}}',
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
        $this->dropForeignKey('NOTIFY_ID_USER_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }

}
