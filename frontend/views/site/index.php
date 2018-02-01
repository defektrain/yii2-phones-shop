<?php

/* @var $this yii\web\View */
/* @var $products \common\models\Product[] */
/* @var $categories \common\models\Category[] */

use yii\helpers\Url;

$this->title = 'Phones Shop';

?>

<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Categories</h2>

                <?php foreach ($categories as $item) : ?>
                    <a href="<?=Url::to(['index', 'category_id' => $item->id])?>"><?=$item->name?></a><br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-8">
                <h2>Products</h2>

                <?php foreach ($products as $item) : ?>
                    <a href="<?=Url::to(['product', 'id' => $item->id])?>"><?=$item->name?></a><br>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
