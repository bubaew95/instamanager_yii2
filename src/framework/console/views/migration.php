<?php
/* @var string $className The new migration class name */
/* @var string $namespace The new migration namespace */
echo "<?php\n";
?>

namespace <?= $namespace; ?>;

use yii\db\Schema;
use yii\db\Migration;

class <?= $className ?> extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "<?= $className ?> cannot be reverted.\n";
        return false;
    }
}