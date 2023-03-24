<?php

namespace console\migrations;

use yii\db\Migration;

class m160409_124615_add_test_modules extends Migration
{
    public function safeUp()
    {
        $shopText = 'Умное решение для интернет-торговли — продажа обычных и электронных товаров, модификации и сопутствующие товары, учет товаров в различных валютах.';
        $instaText = 'Обмен фотографиями и видеозаписями. Возможность делать квадратные снимки и применять к ним фильтры, а также распространять их других социальных сетях.';
        $luisText = 'Служба "Распознавание речи" (LUIS) обеспечивает естественное взаимодействие приложений с пользователями. ';
        $this->batchInsert('module', ['m_name', 'name','source', 'img', 'text'], [
            ['luis', 'MS Luis', '\common\modules\luis\LuisModule', 'luis.png', $luisText],
            ['insta', 'Инстаграм', '\common\modules\insta\InstaModule', 'insta.png', $instaText],
            ['shops', 'Магазин', '\common\modules\shops\ShopsModule', 'shops.png', $shopText],
        ]);
        $this->batchInsert('module_version', ['version', 'module_id', 'name', 'source'], [
            ['V1', '1', 'Версия 1', '\common\modules\luis\modules\v1\V1'],
            ['V1', '2', 'Версия 1', '\common\modules\insta\modules\v1\V1'],
            ['V1', '3', 'Версия 1', '\common\modules\shops\modules\v1\V1'],
        ]);
        $moduleIds = [1,2,3];

        foreach ($moduleIds as $item)
        {
            $this->update('module', ['version_id' => $item], ['id' => $item]);
        }
    }

    public function safeDown()
    {
    }
}
