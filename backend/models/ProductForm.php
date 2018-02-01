<?php

namespace app\models;

use common\models\Attribute;
use common\models\Attribute2product;
use Yii;
use yii\base\Model;

/**
 * Class ProductForm
 * @package app\models
 */
class ProductForm extends Model
{
    public $product;
    public $properties;

    /**
     * @return array
     */
    public function getPropertiesForm()
    {
        $this->properties = [];

        if ($this->product->id) {
            foreach ($this->product->attribute2products as $item) {
                $this->properties[$item->attribute_id] = $item;
            }
        }

        $attributes = Attribute::find()->all();
        foreach ($attributes as $item) {
            if (!$this->properties[$item->id]) {
                $model = new Attribute2product();
                $model->attribute_id = $item->id;
                $this->properties[$model->attribute_id] = $model;
            }
        }

        return $this->properties;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setData($data)
    {
        $productLoad = $this->product->load($data);

        foreach ($this->properties as $key => $item) {
            $item->load($data['Attribute2product'][$key], '');
        }

        return $productLoad;
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->product->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveProperties()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();

        return true;
    }

    /**
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function saveProperties()
    {
        foreach ($this->properties as $key => $item) {
            if ($item->value) {
                $item->product_id = $this->product->id;
                if (!$item->save()) {
                    return false;
                }
            } else {
                $model = Attribute2product::findOne([
                    'attribute_id' => $item->attribute_id,
                    'product_id' => $item->product_id
                ]);
                if ($model) {
                    $model->delete();
                }
            }
        }

        return true;
    }
}