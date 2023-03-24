<?php

namespace console\migrations;

use yii\db\Migration;

class m160409_122700_add_module_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%module}}', [
            'id' => $this->primaryKey()->unsigned(),
            'm_name' => $this->string()->notNull()->unique()->comment('ID модуля'),
            'img' => $this->string(255)->comment('Изображение'),
            'name' => $this->string()->notNull(),
            'text'  => $this->string(255)->comment('Описание'),
            'version_id' => $this->integer()->unsigned(),
            'source' => $this->string()->unique()->notNull(),
            'active' => $this->boolean()->defaultValue(true)->comment('Активность'),
        ]);

        $this->createTable('module_version', [
            'id' => $this->primaryKey()->unsigned(),
            'version' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'source' => $this->string()->unique()->notNull(),
            'module_id' => $this->integer()->unsigned(),//$this->string()->notNull(),
        ]);

//        $this->addPrimaryKey(
//            'module_version_pk',
//            'module_version',
//            'module_id'
//        );

        $this->addForeignKey(
            'module_version_id__module_version_id',
            'module',
            'version_id',
            'module_version',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'module_version_module_id__module_id',
            'module_version',
            'module_id',
            'module',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('module_version_module_id__module_id','module_version');
        $this->dropForeignKey('module_version_id__module_version_id','module');
        $this->dropTable('module_version');
        $this->dropTable('module');
    }
}
