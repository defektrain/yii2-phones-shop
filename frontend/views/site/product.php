<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Product */
/* @var $categories \common\models\Category[] */

use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->name . ' | Phones Shop';

?>

<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Categories</h2>

                <?php foreach ($categories as $item) : ?>
                    <a href="<?= Url::to(['index', 'category_id' => $item->id]) ?>"><?= $item->name ?></a><br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-8">
                <h2>Product: <?=$model->name?></h2>

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
        </div>

    </div>
</div>
