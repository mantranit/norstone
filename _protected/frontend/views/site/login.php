<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Config;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Đăng nhập | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);
?>

<div class="row" role="article">
    <div class="col-md-12 main-container">
        <ul class="breadcrumb">
            <li><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="Quay lại trang chủ"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
            <li><span class="page-title">Đăng nhập</span></li>
        </ul>
        <div class="module-content page-detail">
            <h1>Đăng nhập</h1>
            <div class="page-content">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?php //-- use email or username field depending on model scenario --// ?>
                <?php if ($model->scenario === 'lwe'): ?>
                    <?= $form->field($model, 'email') ?>
                <?php else: ?>
                    <?= $form->field($model, 'username') ?>
                <?php endif ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div>
                    <?= Html::a('Quên mật khẩu?', ['site/request-password-reset']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

