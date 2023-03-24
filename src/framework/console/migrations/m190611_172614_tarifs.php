<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190611_172614_accounts
 */
class m190611_172614_tarifs extends Migration
{
    const TableName = '{{%tarifs}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'                => $this->primaryKey()->unsigned(),
            'logo'              => $this->string(255)->comment('Логотип'),
            'name'              => $this->string(255)->comment('Название услуги'),
            'text'              => $this->string(512)->comment('Описание'),
            'price'             => $this->decimal(8,2)->defaultValue(0)->comment('Цена'),
            'count_projects'    => $this->smallInteger(2)->defaultValue(1)->comment('Количество проектов'),
            'isII'              => $this->smallInteger(1)->defaultValue(0)->comment('Искувственный интеллект'),
            'visible'           => $this->smallInteger(1)->defaultValue(0)->comment('Видимость'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TableName);
    }
}
