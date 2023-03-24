<?php

namespace common\components;

use yii\base\Exception;

class PhpMessageSource extends \yii\i18n\PhpMessageSource
{
    /**
     * Returns message file path for the specified language and category.
     *
     * @param string $category the message category. Must have one of the following structure:
     * - moduleId.moduleVersion.categoryName
     * - moduleId.categoryName
     * - categoryName
     * @param string $language the target language
     * @return string path to message file
     * @throws Exception
     * @see \yii\i18n\PhpMessageSource::getMessageFilePath()
     */
    protected function getMessageFilePath($category, $language)
    {
        $categoryList = explode('.', $category);
        $bathPath = trim($this->basePath, '\\/');
        switch (count($categoryList)) {
            case 1:
                return $this->getFullFileName("@common/{$bathPath}/{$language}", $categoryList[0]);
                break;
            case 2:
                return $this->getFullFileName("@common/modules/{$categoryList[0]}/{$bathPath}/{$language}", $categoryList[1]);
                break;
            case 3:
                return $this->getFullFileName("@common/modules/{$categoryList[0]}/modules/{$categoryList[1]}/{$bathPath}/{$language}", $categoryList[2]);
                break;
            default :
                throw new Exception("Invalid category name: '{$category}.");
                break;
        }
    }

    private function getFullFileName($path, $category)
    {
        $path = \Yii::getAlias($path);
        return isset($this->fileMap[$category])
            ? $path . $this->fileMap[$category]
            : $path . '/'.str_replace('\\', '/', $category) . '.php';
    }
}