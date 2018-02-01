<?php

namespace app\models;

use common\models\Category;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'producer_id'], 'integer'],
            [['name', 'description'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $this->load($params);

        if ($this->category_id) {
            $subQuery = Category::find();
            $subQuery->select('id');
            $subQuery->from('(SELECT * FROM category ORDER BY parent_id) all_categories, (SELECT @pv := "' . $this->category_id . '") filter');
            $subQuery->where('find_in_set(parent_id, @pv) > 0 AND @pv := concat(@pv, ",", id)');
            $subQuery->orWhere(['id' => $this->category_id]);

            $query = Product::find()->where(['in', 'category_id', $subQuery]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'category_id' => $this->category_id,
            'producer_id' => $this->producer_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
