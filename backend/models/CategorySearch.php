<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\db\QueryBuilder;

/**
 * CategorySearch represents the model behind the search form of `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = Category::find();

        $this->load($params);

        if ($this->parent_id) {
            $query = Category::find();
            $query->select('id, parent_id, name, created_at, updated_at');
            $query->from('(SELECT * FROM category ORDER BY parent_id) all_categories, (SELECT @pv := "' . $this->parent_id . '") filter');
            $query->where('find_in_set(parent_id, @pv) > 0');
            $query->andWhere('@pv := concat(@pv, ",", id)');
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
//            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
