<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $categories \common\models\Category[] */
/* @var $producers \common\models\Producer[] */

$this->title = 'Update Product: '.$model->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'producers' => $producers,
    ]) ?>

</div>
