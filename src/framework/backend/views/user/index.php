<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\users\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a('<span class="icon-plus2"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>

    <div class="card-body">
        Basic example of a datatable with <code>HTML (DOM)</code> sourced data. The foundation for DataTables is
        progressive enhancement, so it is very adept at reading table information directly from the <code>DOM</code>.
        This example shows how easy it is to add searching, ordering and paging to your HTML table by simply running
        DataTables with basic configuration on it.
    </div>

    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
        <div class="datatable-scroll">
            <div class="books-index table-responsive">
                <div class="user-index table-responsive">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'summary' =>false,
                        'tableOptions' => [
                            'class' => 'table datatable-html dataTable no-footer'
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'fullname',
                                'content' => function ($data) {
                                    return $data->userinfo->last_sur_name;
                                }
                            ],
                            'email',
                            [
                                'attribute' => 'phone',
                                'content' => function ($data) {
                                    return $data->userinfo->phone;
                                }
                            ],
                            'id_user',
                            //'username',
                            //'auth_key',
                            //'password_hash',
                            //'password_reset_token',
                            //'email:email',
                            //'status',
                            //'created_at',
                            //'updated_at',
                            \backend\components\widgets\GridViewButtons::viewButtons()
                            //['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


