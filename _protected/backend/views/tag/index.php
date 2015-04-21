<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tags');
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="tag-index">
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Create Tag'), ['create'], ['class' => 'tiny button round']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            // buttons
            ['class' => 'yii\grid\ActionColumn',
                'header' => "Menu",
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage tag',
                            'class'=>'fa fa-pencil-square-o']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url,
                            ['title'=>'Delete tag',
                                'class'=>'fa fa-trash-o',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this tag?'),
                                    'method' => 'post']
                            ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>

        </div>
    </div>
</article>
