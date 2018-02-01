<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name,
            ],
            [
                'attribute' => 'producer_id',
                'value' => $model->producer->name,
            ],
            'name',
            'description:ntext',
            'price',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <fieldset>
        <legend>Attributes</legend>

        <table id="attributes" class="table table-striped table-bordered detail-view">
            <tbody>
                <?php foreach ($model->attribute2products as $item) : ?>
                    <tr>
                        <th><?=$item->attribute0->name?></th>
                        <td><?=$item->value?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>

</div>
