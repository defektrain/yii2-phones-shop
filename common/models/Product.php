<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $producer_id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attribute2product[] $attribute2products
 * @property Attribute[] $attributes0
 * @property Image[] $images
 * @property Category $category
 * @property Producer $producer
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'producer_id', 'name'], 'required'],
            [['category_id', 'producer_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['producer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producer::className(), 'targetAttribute' => ['producer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'producer_id' => 'Producer ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute2products()
    {
        return $this->hasMany(Attribute2product::className(), ['product_id' => 'id'])->inverseOf('product');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%attribute2product}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id'])->inverseOf('product');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->inverseOf('products');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducer()
    {
        return $this->hasOne(Producer::className(), ['id' => 'producer_id'])->inverseOf('products');
    }
}
