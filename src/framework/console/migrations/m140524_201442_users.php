<?php
namespace console\migrations;
use yii\db\Migration;

class m140524_201442_users extends Migration
{
    const TableName = '{{%users}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

       $this->createTable(self::TableName, [
           'id'             => $this->primaryKey()->unsigned(),
           'name'           => $this->string(255)->defaultValue(null)->comment('ФИО'),
           'phone'          => $this->string(30)->defaultValue(null)->comment('Телефон'),
           'email'          => $this->string()->notNull()->unique(),
           'auth_key'       => $this->string(32)->notNull(),
           'password_hash'  => $this->string()->notNull(),
           'password_reset_token' => $this->string()->unique(),
           'status'         => $this->smallInteger()->notNull()->defaultValue(10),
           'created_at'     => $this->integer()->unsigned()->notNull(),
           'updated_at'     => $this->integer()->unsigned()->notNull(),
       ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable(self::TableName);
    }
}
