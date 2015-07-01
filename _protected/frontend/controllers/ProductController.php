<?php
/**
 * Created by PhpStorm.
 * User: ManTran
 * Date: 6/29/2015
 * Time: 10:48 AM
 */

namespace frontend\controllers;

use common\models\File;
use common\models\FileSearch;
use common\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends FrontendController {

    /**
     * Displays a single Product model.
     *
     * @param  integer $id
     * @param  string $slug
     * @return mixed
     */
    public function actionView($id, $slug)
    {
        $dataProvider = new FileSearch();
        $pictures = $dataProvider->search(['product_id' => $id])->getModels();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'pictures' => $pictures
        ]);
    }

    /**
     * Displays Products by category.
     *
     * @param  integer $id
     * @param  string $slug
     * @return mixed
     */
    public function actionCategory($id, $slug)
    {
        $products = Product::find()
            ->innerJoin('tbl_product_category', ['tbl_product_category.product_id' => 'tbl_product.id'])
            ->where([
                'tbl_product_category.deleted' => 0,
                'tbl_product.deleted' => 0,
                'tbl_product_category.category' => $id,
            ])->all();
        return $this->render('category', [
            'products' => $products
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer  $id
     * @return Product The loaded model.
     *
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}