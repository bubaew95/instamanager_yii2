<?php

namespace common\modules\luis\modules\v1\migrations;

use yii\db\Migration;

class m160417_154728_luis_migrate extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%luis}}', [
            'id'                => $this->primaryKey()->unsigned(),
            'user_id'           => $this->bigInteger()->unsigned()->comment('Пользователь'),
            'app_key'           => $this->string(255)->notNull()->comment('Ключ'),
            'subscription_key'  => $this->string(255)->notNull()->comment('Ключ подписки'),
            'verbose'           => $this->boolean()->defaultValue(true)->comment('Показать весь массив'),
            'active'            => $this->boolean()->defaultValue(true)->comment('Активность'),
        ], $tableOptions);

        //Сделать связь с пользователями
    }

    public function safeDown()
    {
        $this->dropTable('{{%luis}}');
    }
}
