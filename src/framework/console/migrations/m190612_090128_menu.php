<?php
namespace console\migrations;
use yii\db\Migration;

/**
 * Class m190612_090128_menu
 */
class m190612_090128_menu extends Migration
{
    const TableName = '{{%menu}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TableName, [
            'id'        => $this->primaryKey()->unsigned(),
            'id_shop'   => $this->integer()->unsigned()->notNull()->comment('Магазин'),
            'name'      => $this->string(255)->notNull()->comment('Название'),
            'icon'      => $this->string(35)->null()->comment('Иконка'),
            'tree'       => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Дерево'),
            'lft'       => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Левая сторона'),
            'rgt'       => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Правая сторона'),
            'depth'     => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Глубина'),
            'position'  => $this->integer()->unsigned()->notNull()->defaultValue(0)->defaultValue(0)->comment('Позиция'),
            'created_at'  => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Дата создания'),
            'updated_at'  => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Дата изменения'),
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
