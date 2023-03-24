<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 29.04.2019
 * Time: 20:04
 */
namespace backend\components\classes;
use Yii;
use Yandex\Metrica\Stat\Models\TableParams;
use Yandex\Metrica\Stat\Models\Table;
use Yandex\Metrica\Stat\StatClient;

class YandexMetricaClass
{

    private $statClient;
    public function __construct()
    {
        $this->statClient = new StatClient(Yii::$app->params['tokenMetrica']);
    }

    public function traficSourse()
    {
        if(Yii::$app->cache->exists('yandexTraficSource')) {
            return Yii::$app->cache->get('yandexTraficSource');
        }
        $tableParams = new TableParams();
        $metricParams = $tableParams->setMetrics('ym:s:visits')
            ->setDimensions('ym:s:<attribution>TrafficSource')
            ->setDate1('30daysAgo')
            ->setDate2('today')
            ->setFilters('ym:s:visits>10')
            ->setId(Yii::$app->params['idmetric']);
        $result = $this->statClient->data()->getTable($metricParams);
        $datas = [];
        if($result instanceof Table) {
            foreach ($result->getData() as $item) {
                $dimensions = [];
                foreach ($item->getDimensions() as $dimension) {
                    $dimensions[] = $dimension->getName();
                }
                $datas['data'][] =[
                    'name' => $dimensions[0],
                    'value' => $item->getMetrics()[0]
                ];
                $datas['legend'][] = $dimensions[0];
            }
        }
        $result = $this->_itemsTraficSource($datas);
        Yii::$app->cache->set('yandexTraficSource', $result, (60 * 5));
        return $result;
    }
    private function _itemsTraficSource(array $data = []) : array
    {
        $arr = [];
        $arr['data'] = $data['data'];
        $arr['legend'] = $data['legend'];
        return $arr;
    }

    /**
     * Получение последних визитов
     * @return array|String
     */
    public function visitData()
    {
        if(Yii::$app->cache->exists('yandexVisitData')) {
            return Yii::$app->cache->get('yandexVisitData');
        }
        $tableParams = new TableParams();
        $metricParams = $tableParams->setMetrics('ym:s:visits,ym:s:pageviews,ym:s:users')
            ->setDimensions('ym:s:date')
            ->setDate1('30daysAgo')
            ->setDate2('today')
            ->setSort('ym:s:date')
            ->setId(Yii::$app->params['idmetric']);
        $result = $this->statClient->data()->getTable($metricParams);
        $datas = [];
        if($result instanceof Table ) {
            foreach ($result->getData() as $key => $item) {
                $datas['visits'][] = $item->getMetrics()[0];
                $datas['pageviews'][] = $item->getMetrics()[1];
                $datas['users'][] = $item->getMetrics()[2];
                $dimentions = [];
                foreach ($item->getDimensions() as $dimention) {
                    $dimentions[] = $dimention->getName();
                }
                $datas['legend'][] = $dimentions[0];
            }
        }
        $result = $this->_itemsVisitData($datas);
        Yii::$app->cache->set('yandexVisitData', $result, (60 * 5));
        return $result;
    }
    /**
     * Формирование JSON массива для Графика
     * @param array $data
     * @return String
     */
    private function _itemsVisitData(array $data = []) : array
    {
        $arr = [];
        $arr['data'] = [
            [
                'name' => 'Визиты',
                'type' =>'line',
                'data' => $data['visits'],
                'smooth' =>true,
                'symbolSize' => 7,
                'label' => [
                    'normal' => [
                        'show' => true
                    ]
                ],
                'itemStyle' => [
                    'normal' => [
                        'borderWidth' => 2
                    ]
                ]
            ],
            [
                'name' => 'Просмотры',
                'type' =>'line',
                'data' => $data['pageviews'],
                'smooth' =>true,
                'symbolSize' => 7,
                'label' => [
                    'normal' => [
                        'show' => true
                    ]
                ],
                'itemStyle' => [
                    'normal' => [
                        'borderWidth' => 2
                    ]
                ]
            ],
            [
                'name' => 'Пользователи',
                'type' =>'line',
                'data' => $data['users'],
                'smooth' =>true,
                'symbolSize' => 7,
                'label' => [
                    'normal' => [
                        'show' => true
                    ]
                ],
                'itemStyle' => [
                    'normal' => [
                        'borderWidth' => 2
                    ]
                ]
            ],
        ];
        $arr['legend'] = $data['legend'];
        return $arr;
    }

}