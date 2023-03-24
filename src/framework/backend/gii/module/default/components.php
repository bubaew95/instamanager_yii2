<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 15/09/2019
 * Time: 20:04
 */
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);

echo "<?php\n";
?>

namespace <?= "{$ns}\\modules\\{$className}\\components" ?>;

abstract class EventHandler
{

}