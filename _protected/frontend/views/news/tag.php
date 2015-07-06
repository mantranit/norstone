<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 7/1/2015
 * Time: 3:16 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\UtilHelper;
use frontend\assets\ProductAsset;
use yii\widgets\LinkPager;
use common\models\Config;
use common\models\File;
use common\models\Tag;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $news common\models\Content */

$this->title = 'Tin tức | ' . Config::findOne(['key' => 'SEO_TITLE'])->value;
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Config::findOne(['key' => 'SEO_KEYWORD'])->value]);
$this->registerMetaTag(['name' => 'description', 'content' => Config::findOne(['key' => 'SEO_DESCRIPTION'])->value]);

ProductAsset::register($this);

?>

<div id="main_content" class="col-sm-9">
    <ul class="breadcrumb">
        <li class="firstItem"><a href="<?= Yii::$app->homeUrl ?>" class="homepage-link" title="<?= Yii::t('app', 'Back to the homepage') ?>"><?= Yii::t('app', 'Home') ?></a></li>
        <li><a href="<?= Url::toRoute(['news/index']) ?>">Tin tức</a></li>
        <li class="lastItem"><span class="page-title"><?= ucfirst($model->name) ?></span></li>
    </ul>
    <div id="blog" class="blog-scope">
        <div class="page_header">
            <h1 class="page_heading"><?= ucfirst($model->name) ?></h1>
        </div>
        <div class="page_content">
            <?php foreach ($dataProvider->getModels() as $index => $news) { ?>
                <div class="blog-article">
                    <div class="article_header">
                        <div class="blog-article_meta-comments">
                            <?= Html::a('0 comments', ['news/view', 'slug' => $news->slug, '#' => 'disqus_thread']) ?>
                        </div>
                        <div class="product_name">
                            <?= Html::a($news->name, ['news/view', 'slug' => $news->slug]) ?>
                        </div>
                        <div class="blog-article_date">
                            <span>Đăng ngày: </span>
                            <time pubdate datetime="<?= date('Y-m-d', $news->published_date) ?>">
                                <span class="day"><?= date('d/m/Y', $news->published_date) ?></span>
                            </time>
                        </div>
                        <?php
                        $tags = Tag::find()
                            ->innerJoin('tbl_content_tag', 'tbl_content_tag.tag_id = tbl_tag.id')
                            ->where(['tbl_tag.deleted' => 0, 'tbl_content_tag.deleted' => 0, 'tbl_content_tag.content_id' => $news->id])
                            ->all();
                        if(count($tags) > 0) {
                        ?>
                            <div class="blog-article_meta-tags">
                                <span>Tags: </span>
                        <?php
                        }
                        foreach ($tags as $index => $tag) {
                            if($index > 0)
                                echo ', ';
                            echo Html::a($tag->name, ['news/tag', 'slug' => $tag->slug]);
                        }
                        if(count($tags) > 0) { ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="rte">
                        <p class="news-image-list">
                            <a href="<?= Url::toRoute(['news/view', 'slug' => $news->slug]) ?>">
                            <?php
                            $images = File::find()
                                ->innerJoin('tbl_content_file', 'tbl_content_file.file_id = tbl_file.id')
                                ->where(['tbl_file.deleted' => 0, 'tbl_content_file.deleted' => 0, 'tbl_content_file.content_id' => $news->id])
                                ->all();
                            foreach ($images as $img) {
                                echo UtilHelper::getPicture($img, 'thumbnail-slide');
                            }
                            ?>
                            </a>
                        </p>
                        <?= $news->summary ?>
                    </div>
                    <?= Html::a('Xem thêm', ['news/view', 'slug' => $news->slug], ['class' => 'blog-article_read-more btn btn-info']) ?>
                </div>
            <?php } ?>

            <nav class="pagination">
                <?= LinkPager::widget([
                    'pagination'=>$dataProvider->pagination,
                    'nextPageLabel' => 'Trang kế tiếp &raquo;',
                    'prevPageLabel' => '&laquo; Quay lại',
                ]) ?>
            </nav>
        </div>
    </div>
</div>

<?php

$this->registerJs("

/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
var disqus_shortname = '" . Config::findOne(['key' => 'DISQUS'])->value . "'; // required: replace example with your forum shortname

/* * * DON'T EDIT BELOW THIS LINE * * */
(function () {
var s = document.createElement('script'); s.async = true;
s.type = 'text/javascript';
s.src = '//' + disqus_shortname + '.disqus.com/count.js';
(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());

");