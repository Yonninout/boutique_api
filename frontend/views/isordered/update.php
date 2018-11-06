<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IsOrdered */

$this->title = 'Update Is Ordered: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Is Ordereds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="is-ordered-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
