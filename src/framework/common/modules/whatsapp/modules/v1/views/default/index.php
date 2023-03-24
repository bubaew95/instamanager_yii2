<?php
$this->title = 'Whats App';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?=  $this->title?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">
            This is the view content for action "<?= $this->context->action->id ?>".
            The action belongs to the controller "<?= get_class($this->context) ?>"
            in the "<?= $this->context->module->id ?>" module.
        </p>
    </div>
    <div class="card-body">
        <h1><?= $this->context->action->uniqueId ?></h1>
        <p>
            You may customize this page by editing the following file:<br>
            <code><?= __FILE__ ?></code>
        </p>
    </div>
</div>