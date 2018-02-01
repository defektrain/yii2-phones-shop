<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attribute2product}}".
 *
 * @property int $attribute_id
 * @property int $product_id
 * @property string $value
 *
 * @property Attribute $attribute0
 * @property Product $product
 */
class Attribute2product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attribute2product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'product_id'], 'required'],
            [['attribute_id', 'product_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attribute_id', 'product_id'], 'unique', 'targetAttribute' => ['attribute_id', 'product_id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_id' => 'Attribute ID',
            'product_id' => 'Product ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id'])->inverseOf('attribute2products');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id'])->inverseOf('attribute2products');
    }
}
