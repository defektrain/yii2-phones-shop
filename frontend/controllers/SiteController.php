<?php

namespace frontend\controllers;

use app\models\ProductSearch;
use common\helpers\TreeHelper;
use common\models\Category;
use common\models\Product;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $categoriesModel = Category::find()->all();
        $categories = TreeHelper::makeTree($categoriesModel);

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $products = $dataProvider->getModels();

        return $this->render('index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionProduct($id)
    {
        $categoriesModel = Category::find()->all();
        $categories = TreeHelper::makeTree($categoriesModel);

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $products = $dataProvider->getModels();

        $model = Product::findOne($id);

        return $this->render('product', [
            'model' => $model,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
