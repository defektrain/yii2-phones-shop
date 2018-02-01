<?php

use common\models\Attribute2product;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories \common\models\Category[] */
/* @var $producers \common\models\Producer[] */


?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <?= $form->field($model->product, 'category_id')->widget(Select2::classname(), [
            'language' => 'en',
            'data' => ArrayHelper::map($categories, 'id', 'name'),
            'options' => ['placeholder' => 'Select a category ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model->product, 'producer_id')->widget(Select2::classname(), [
            'language' => 'en',
            'data' => ArrayHelper::map($producers, 'id', 'name'),
            'options' => ['placeholder' => 'Select a producer ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model->product, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model->product, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model->product, 'price')->textInput() ?>
    </fieldset>

    <fieldset>
        <legend>Attributes</legend>

        <?php foreach ($model->properties as $key => $item) : ?>
            <?= $form->field($item, 'value')->textInput([
                'id' => "property_" . $key,
                'name' => "Attribute2product[".$key."][value]",
            ])->label($item->attribute0->name) ?>
        <?php endforeach; ?>
    </fieldset>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
