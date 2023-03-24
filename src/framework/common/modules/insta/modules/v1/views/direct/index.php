<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 04/10/2019
 * Time: 00:20
 *
 */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Директ';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Инстаграм', 'url' => ['/insta']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card">
    <?= $this->render('../_header') ?>
    <div class="card-header bg-white header-elements-inline">
        <h5 class="card-title">Hover rows</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="#" class="btn btn-success legitRipple">
                    <i class="icon-plus-circle2"></i>
                </a>
                <a href="#" class="btn btn-danger legitRipple">
                    <i class="icon-trash-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body pt-0">

        <div class="row">
            <div class="col-md-3 border-right border-right-grey media-chat-scrollable">

                <ul class="media-list media-list-linked">
                    <li class="media font-weight-semibold border-0 py-1">Team leaders</li>

                    <?php foreach($model as $key => $item) : ?>
                        <li>
                            <a href="#" data-id="<?= $item->id?>" data-threadid="<?= $item->thread_id?>" class="media select-chat" data-toggle="collapse" data-target="#item_<?= $key ?>">
                                <div class="mr-3">
                                    <img src="<?= $item->img?>" class="rounded-circle" width="40" height="40" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title font-weight-semibold"> <?= $item->user_name?> </div>
<!--                                    <span class="text-muted">Last.fm</span>-->
                                </div>
                                <div class="align-self-center ml-3">
                                    <span class="badge badge-mark border-success"></span>
                                </div>
                            </a>

                            <div class="collapse" id="item_<?= $key ?>2">
                                <div class="card-body bg-light border-top border-bottom">
                                    <ul class="list list-unstyled mb-0">
                                        <li><i class="icon-pin mr-2"></i> Amsterdam</li>
                                        <li><i class="icon-user-tie mr-2"></i> Senior Designer</li>
                                        <li><i class="icon-phone mr-2"></i> +1(800)431 8996</li>
                                        <li><i class="icon-mail5 mr-2"></i> <a href="#">james@alexander.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>

                </ul>

            </div>
            <!-- End leftbar -->
            <div class="col-md-9">
                <div class="chat-container"></div>
            </div>
        </div>

    </div>

</div>

<?php
$url = Url::to(['direct/items']);
$idLastSms = $model[0]->id;
$threadidLastSms = $model[0]->thread_id;
$js = <<<JS
    loadMessages($idLastSms, $threadidLastSms);
 

    $('.select-chat').on('click', function() {
        var id = $(this).data('id');
        var threadId = $(this).data('threadid').toString();
        loadMessages(id, threadId);
    })
   
    function loadMessages(id, threadId) {
      $.post({
            url: '{$url}',
            data: {id_direct:id, thread_id:threadId},
            success: function (data) {
                $('.chat-container').empty().append(data);
            },
            error: function (msg) {
                console.log(msg);
            }
        });
    }
JS;
$this->registerJs($js);
?>
