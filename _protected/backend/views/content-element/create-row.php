<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model common\models\ContentElement */

?>
<div class="pb-row">
    <div class="pb-column pb-col-12">
        <div class="pb-column-content">

            <div class="controls">
                <?= Html::a('', '#', [
                    'class' => 'open-modal fa fa-th-list',
                    'title' => 'Edit columns',
                    'data' => [
                        'reveal-id' => 'modalColumn',
                        'id' => $model->id,
                        'url-get' => Url::toRoute(['content-element/view', 'id' => $model->id]),
                        'url-post' => Url::toRoute(['content-element/update', 'id' => $model->id])
                    ]
                ]) ?>
                <?= Html::a('', '#', [
                    'class' => 'open-modal fa fa-plus',
                    'title' => 'Add new element',
                    'data' => [
                        'reveal-id' => 'modalAddElement',
                        'id' => $model->id,
                        'url-get' => Url::toRoute(['content-element/create', 'contentId' => $model->content_id])
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="controls">
        <?= Html::a('', ['content-element/edit', 'type' => 'row'], [
            'class' => 'open-modal fa fa-pencil-square-o',
            'title' => 'Edit row',
            'data' => [
                'reveal-id' => 'modalEdit',
                'id' => $model->id
            ]
        ]) ?>
        <?= Html::a('', ['content-element/active', 'id' => $model->id], ['class' => $model->hide === 1 ? 'active-e-row fa fa-toggle-off' : 'active-e-row fa fa-toggle-on', 'title' => 'Show/Hide row']) ?>
        <?= Html::a('', ['content-element/delete', 'id' => $model->id], ['class' => 'delete-e-row fa fa-times', 'title' => 'Delete row', 'data' => ['method' => 'post']]) ?>
    </div>
</div>
