<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\gii\module;

use common\models\entities\Module;
use common\models\entities\ModuleVersion;
use yii\gii\CodeFile;
use yii\helpers\Html;
use Yii;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * This generator will generate the skeleton code needed by a module.
 *
 * @property string $controllerNamespace The controller namespace of the module. This property is read-only.
 * @property bool $modulePath The directory that contains the module class. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator
{
    public $moduleName;
    public $moduleText;
    public $moduleClass;
    public $moduleID;

    public $moduleImages;


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Module Generator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'This generator helps you to generate the skeleton code needed by a Yii module.';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['moduleID', 'moduleClass', 'moduleName', 'moduleText'], 'filter', 'filter' => 'trim'],
            [['moduleID', 'moduleClass', 'moduleName'], 'required'],
            [['moduleID'], 'match', 'pattern' => '/^[\w\\-]+$/', 'message' => 'Only word characters and dashes are allowed.'],
            [['moduleClass'], 'match', 'pattern' => '/^[\w\\\\]*$/', 'message' => 'Only word characters and backslashes are allowed.'],
            [['moduleText'], 'string', 'max' => 255],
            [['moduleClass'], 'validateModuleClass'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'moduleID' => 'Module ID',
            'moduleClass' => 'Module Class',
            'moduleName' => 'Название модуля',
            'moduleImages' => 'Изображение',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return [
            'moduleID' => 'This refers to the ID of the module, e.g., <code>admin</code>.',
            'moduleClass' => 'This is the fully qualified class name of the module, e.g., <code>app\modules\admin\Module</code>.',
            'moduleName' => 'Название модуля. Например: <code>Модуль Вконтакте</code>.',
            'moduleText' => 'Описание модуля.',
            'moduleImages' => 'Изображение.',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function successMessage()
    {
        if (Yii::$app->hasModule($this->moduleID)) {
            $link = Html::a('try it now', Yii::$app->getUrlManager()->createUrl($this->moduleID), ['target' => '_blank']);

            return "Модуль был успешно сгенерирован . You may $link.";
        }

        $saveModule = $this->saveModuleDB();
        if($saveModule['code'] == 'isset') {
            $output = <<<EOD
<p>Такая версия модуля уже существует.</p>
EOD;
        }else {
            $output = <<<EOD
<p>Модуль был успешно сгенерирован .</p>
EOD;
        }
        $code = <<<EOD
Модуль находится по адресу: {$this->moduleClass}
EOD;

        return $output . '<pre>' . highlight_string($code, true) . '</pre>';
    }

    private function saveModuleDB()
    {
        $isNewRecord = false;
        //Проверяем существование модуля
        $module = Module::findOne(['m_name' => $this->moduleID]);
        if(empty($module)) {
            $isNewRecord = true;
            $module             = new Module();
            $module->m_name     = $this->moduleID;
            $module->name       = $this->moduleName;
            $module->text       = $this->moduleText;
            $firstUp            = ucfirst($this->moduleID);
            $module->source     = "\\{$this->getNamespace()}\\{$firstUp}Module";
            $module->save();
        }
        $firstVersionUp = ucfirst($this->getClassName());
        //Проверяем существование версии модуля
        $moduleVersion = ModuleVersion::find()
                        ->where(['module_id' => $module->id])
                        ->andWhere(['version' => $firstVersionUp])->one();
        if(!empty($moduleVersion)) {
            return ['code' => 'isset'];
        }

        $moduleVersion              = new ModuleVersion();
        $moduleVersion->module_id   = $module->id;
        $moduleVersion->name        = "Версия {$firstVersionUp}";
        $moduleVersion->source      = "\\{$this->getNamespace()}\\modules\\{$this->getClassName()}\\{$firstVersionUp}";
        $moduleVersion->version     = $firstVersionUp;
        $moduleVersion->save();

        if($isNewRecord) {
            $updateModule = Module::findOne(['id' => $module->id]);
            $updateModule->version_id = $moduleVersion->id;
            return ['code' => $updateModule->save() ? 'success' : 'error'];
        }
        return ['code' => 'success'];
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        return ['module.php', 'controller.php', 'view.php', 'components.php', 'event.php', 'version.php', 'messages.php'];
    }


    /**
     * Получить версию модуля
     * @return bool|string
     */
    public function getClassName()
    {
        $className = $this->moduleClass;
        $pos = strrpos($className, '\\');
        return substr($className, $pos + 1);
    }

    /**
     * Получение пространства имен
     * @return string
     */
    public function getNamespace()
    {
        $className = $this->moduleClass;
        $pos = strrpos($className, '\\');
        return ltrim(substr($className, 0, $pos), '\\');
    }


    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getModulePath();

        $className = StringHelper::basename($this->moduleClass);

        $files[] = new CodeFile(
            $modulePath . '/events/'.ucfirst($this->moduleID).'Event.php',
            $this->render("event.php")
        );

        $files[] = new CodeFile(
            $modulePath . '/modules/'.$className.'/messages/ru-RU/'.$this->moduleID.'-message.php',
            $this->render("messages.php")
        );

        $files[] = new CodeFile(
            $modulePath . '/modules/'.$className.'/components/EventHandler.php',
            $this->render("components.php")
        );

        $files[] = new CodeFile(
        $modulePath . '/modules/'.$className.'/controllers/DefaultController.php',
            $this->render("controller.php")
        );

        $files[] = new CodeFile(
            $modulePath . '/modules/'.$className.'/views/default/index.php',
            $this->render("view.php")
        );

        $files[] = new CodeFile(
            $modulePath . '/modules/'.$className.'/' .ucfirst($className).'.php',
            $this->render("version.php")
        );

        $files[] = new CodeFile(
        $modulePath . '/' . ucfirst($this->moduleID) . 'Module.php',
            $this->render("module.php")
        );

        return $files;
    }

    /**
     * Validates [[moduleClass]] to make sure it is a fully qualified class name.
     */
    public function validateModuleClass()
    {
        if (strpos($this->moduleClass, '\\') === false || Yii::getAlias('@' . str_replace('\\', '/', $this->moduleClass), false) === false) {
            $this->addError('moduleClass', 'Module class must be properly namespaced.');
        }
        if (empty($this->moduleClass) || substr_compare($this->moduleClass, '\\', -1, 1) === 0) {
            $this->addError('moduleClass', 'Module class name must not be empty. Please enter a fully qualified class name. e.g. "app\\modules\\admin\\Module".');
        }
    }

    /**
     * @return bool the directory that contains the module class
     */
    public function getModulePath()
    {
        return Yii::getAlias('@' . str_replace('\\', '/', substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\'))));
    }

    /**
     * @return string the controller namespace of the module.
     */
    public function getControllerNamespace()
    {
        return substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\')) . '\controllers';
    }
}
