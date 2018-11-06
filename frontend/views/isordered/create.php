<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\IsOrdered */

$this->title = 'Create Is Ordered';
$this->params['breadcrumbs'][] = ['label' => 'Is Ordereds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="is-ordered-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
