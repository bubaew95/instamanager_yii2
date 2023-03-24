<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');

echo "<?php\n";
?>

namespace <?= $ns ?>\events;

use yii\base\Event;

/**
* Default controller for the `<?= $generator->moduleID ?>` event
*/
class <?= ucfirst($generator->moduleID) ?>Event extends Event
{
    /**
     * @param array $config
    */
    public function __construct($params = null, $config = [])
    {
        parent::__construct($config);
    }
}
