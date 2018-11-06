<?php
use yii\helpers\Html;

use common\models\Article;
/* @var $this yii\web\View */
$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-test">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    	$article = Article::find(1)->one();

    	$article->getPhotos();

    ?>



</div>
