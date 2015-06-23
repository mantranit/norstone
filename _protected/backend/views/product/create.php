<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $pictures Array */
/* @var $categories string */
/* @var $tags Array */
/* @var $tagSuggestions string */
/* @var $products Array */
/* @var $productSuggestion Array */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<article class="product-create">

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><?= Html::encode($this->title) ?></div>
            <div class="action">
                <ul class="button-group">
                    <li><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'tiny button round secondary']) ?></li>
                </ul>
            </div>
        </div>
        <div class="portlet-body">

            <?= $this->render('_form', [
                'model' => $model,
                'pictures' => $pictures,
                'categories' => $categories,
                'tags' => $tags,
                'tagSuggestions' => $tagSuggestions,
                'products' => $products,
                'productSuggestion' => $productSuggestion
            ]) ?>

        </div>
    </div>
</article>
