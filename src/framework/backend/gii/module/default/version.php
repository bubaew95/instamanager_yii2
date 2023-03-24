<?php
/**
 * This is the template for generating a module class file.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);

echo "<?php\n";
?>

namespace <?= "{$ns}\\modules\\{$className}" ?>;

use common\components\WebApplication;
use common\components\VersionModule;


/**
* <?= $generator->moduleID ?> module definition class
*/
class <?= ucfirst($className) ?> extends VersionModule
{

    public static function getEventHandlers()
    {
        return [

        ];
    }

    /** @inheritdoc */
    public static function getUrlRules()
    {
        return[
            'GET /modules/<?=$generator->moduleID?>' => '/<?=$generator->moduleID?>/default',
        ];
    }

}
