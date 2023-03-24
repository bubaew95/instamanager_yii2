<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_191637_instagram
 */
class m190611_191637_instagram extends Migration
{
    const TableName = '{{%instagram}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'id_project'    => $this->integer()->unsigned()->notNull()->comment('ID проекта'),
            'id_user'           => $this->integer()->unsigned()->notNull()->comment('ID клиента'),
            'user_acc_id'       => $this->bigInteger()->unsigned()->notNull()->comment('ID в интаграме'),
            'avatar'            => $this->string(255)->null()->comment('Аватарка'),
            'bg'                => $this->string(255)->null()->comment('Фоновое изображение'),
            'login'             => $this->string(255)->notNull()->comment('Логин инстаграма'),
            'password'          => $this->string(255)->notNull()->comment('Пароль инстаграма'),
            'allowdirect'       => $this->smallInteger(1)->defaultValue(0)->comment('Ответить на запросы в директ'),
            'answercomment'     => $this->smallInteger(1)->defaultValue(0)->comment('Ответить на комментарий в директ'),
            'created_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата добавления'),
            'updated_at'        => $this->integer()->unsigned()->defaultValue(0)->comment('Дата обновления'),
        ], $tableOptions);

        /**
         * Внещний ключ id_user
         */
        $this->addForeignKey(
            'INSTAGRAM_ID_USER_KEY_1',
            self::TableName,
            'id_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        /**
         * Внещний ключ id_user_module
         */
        $this->addForeignKey(
            'INSTAGRAM_ID_PROJECT_KEY_2',
            self::TableName,
            'id_project',
        '{{%projects}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('INSTAGRAM_ID_USER_KEY_1', self::TableName);
        $this->dropForeignKey('INSTAGRAM_ID_USER_MODULE_KEY_2', self::TableName);
        $this->dropTable(self::TableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_191637_instagram cannot be reverted.\n";

        return false;
    }
    */
}
