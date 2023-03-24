<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if ($model) : ?>
    <ul class="media-list media-chat media-chat-scrollable mb-3">
        <li class="media content-divider justify-content-center text-muted mx-0">Monday, Feb 10</li>

        <?php foreach ($model as $key => $item) : ?>
            <?php if ($item->isInterlocutor) : ?>
                <li class="media">
                    <div class="media-body">
                        <div class="media-chat-item"> <?= $item->text ?> </div>
                        <div class="font-size-sm text-muted mt-2"> Mon, 9:54 am </div>
                    </div>
                </li>
            <?php else: ?>
                <li class="media media-chat-item-reverse">
                    <div class="media-body">
                        <div class="media-chat-item"> <?= $item->text ?> </div>
                        <div class="font-size-sm text-muted mt-2">Mon, 10:24 am</div>
                    </div>
                </li>
            <?php endif ?>
        <?php endforeach ?>
        <li class="media content-divider justify-content-center text-muted mx-0">Yesterday</li>

    </ul>
<?php endif ?>

<?= Html::beginForm(['direct/sendmessage'], 'post',  ['id' => 'send-message']) ?>
    <textarea name="text" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
    <div class="d-flex align-items-center">
        <div class="list-icons list-icons-extended">
            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title=""
               data-original-title="Send photo"><i class="icon-file-picture"></i></a>
            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title=""
               data-original-title="Send video"><i class="icon-file-video"></i></a>
            <a href="#" class="list-icons-item" data-popup="tooltip" data-container="body" title=""
               data-original-title="Send file"><i class="icon-file-plus"></i></a>
        </div>

        <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto">
            <b><i class="icon-paperplane"></i></b> Send
        </button>
    </div>
<?= Html::endForm() ?>


<?php
$url = Url::to(['direct/sendmessage']);
$js = <<<JS

    $(document).on('submit', '#send-message', function(e) {
        e.preventDefault(); 
        var data = $(this).serializeArray(); 
        data.push({name: 'thread_id', value: $thread_id})
        sendMessage(data)
    })
   
    function sendMessage(data) {
      $.post({
            url: '$url',
            data: data,
            success: function (data) {
                console.log(data);
            },
            error: function (msg) {
                console.log(msg);
            }
        });
    }
JS;
$this->registerJs($js);
?>