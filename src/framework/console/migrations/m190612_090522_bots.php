<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190612_090522_bots
 */
class m190612_090522_bots extends Migration
{
    const TableName = '{{%bots}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_instagram'      => $this->integer()->unsigned()->notNull()->comment('ID инстаграм'),
            'pid'               => $this->smallInteger(5)->null()->comment('PID запушенной консоли'),

            'allowdirect'       => $this->smallInteger(1)->defaultValue(0)->comment('Ответить на запрос в директе'),
            'answercomment'     => $this->smallInteger(1)->defaultValue(0)->comment('Ответить на комментарий в директ'),
            'isII'              => $this->smallInteger(1)->defaultValue(0)->comment('Искувственный интеллект'),
            'webhook'           => $this->string(255)->null()->comment('Webhook'),

            'status'            => $this->smallInteger(1)->unsigned()->defaultValue(0)->comment('Статус'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата запуска'),
        ], $tableOptions);

        /**
         * Внещний ключ id_instagram
         */
        $this->addForeignKey(
            'BOTS_ID_INSTAGRAM_KEY_1',
            self::TableName,
            'id_instagram',
            '{{%instagram}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('BOTS_ID_INSTAGRAM_KEY_1', self::TableName);
        $this->dropTable(self::TableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_090522_bots cannot be reverted.\n";

        return false;
    }
    */
}
