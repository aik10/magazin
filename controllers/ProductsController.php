<?php

namespace app\controllers;

use app\models\Categorys;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

use Yii;
use app\models\Products;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \DateTime;
use app\models\Log;


class ProductsController extends controller {

/**
 * @inheritdoc
 */
public function behaviors()
{
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ],
        ],
    ];
}

/**
 * Lists all Products models.
 * @return mixed
 */
public function actionIndex($idCategory = null, $category = null)
{
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $categorys = ArrayHelper::map(Categorys::find()->orderBy(['c_name' => 'SORT_ASC'])->all(), 'id', 'c_name');

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'categorys' => $categorys,
    ]);
}

/**
 * Displays a single Products model.
 * @param integer $id
 * @return mixed
 */
public function actionView($id = null)
{
    $categorys = ArrayHelper::map(Categorys::find()->orderBy(['c_name' => 'SORT_ASC'])->all(), 'id', 'c_name');

    return $this->render('view', [
        'model' => $this->findModel($id),
        'categorys' => $categorys
    ]);
//         $model = new Log();
//         $type = 'add';
//         $model->id_product = $id;
//         $model->c_type = $type;
//         $model->c_date = (new DateTime())->format('Y-m-d H:i:s');
//         // $control = new LogController();
// // print_r(LogController);die();
//         return Yii::$app->runAction('log/create', [
//             'model' => $model,
//             'type' => $type
//         ]);
//         // return LogController::render('create', [
//         //     'model' => $model,
//         //     'type' => $type
//         // ]);
}


/**
 * Updates an existing Products model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id
 * @return mixed
 */
public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $categorys = ArrayHelper::map(Categorys::find()->orderBy(['c_name' => 'SORT_ASC'])->all(), 'id', 'c_name');

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        // Yii::$app->session->setFlash('success', 'Данные сохранены');
        // $this->refresh();
        // return $this->redirect(['view', 'id' => $model->id]);
        return $this->redirect(['index']);
        // return $this->actionShowByCategory($model->id_category);
    } else {
        // Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->render('update', compact('model', 'categorys'));
    }
//         $model = new Log();
//         $type = 'sale';
//         $model->id_product = $id;
//         $model->c_type = $type;
//         $model->c_date = (new DateTime())->format('Y-m-d H:i:s');
//         // $control = new LogController();
// // print_r(LogController);die();
//         return Yii::$app->runAction('log/create', [
//             'model' => $model,
//             'type' => $type
//         ]);
}

public function actionShowByCategory($idCategory = null)
{
    // $categorys = ArrayHelper::map(Categorys::find()->orderBy(['c_name' => 'SORT_ASC'])->all(), 'id', 'c_name');
    $searchModel = new ProductSearch();
    $searchModel->id_category = $idCategory;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $category = null;
    if ($idCategory) {
        $category = Categorys::find()->select(['c_name'])->where(['id' => $idCategory])->one()->c_name;
    }

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'category' => $category
    ]);
}

/**
 * Creates a new Products model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 * @return mixed
 */
public function actionCreate($idCategory = null)
{
    $model = new Products();
    $categorys = ArrayHelper::map(Categorys::find()->asArray()->all(), 'id', 'c_name');
    $model->id_category = $idCategory;
    $model->c_date_create = (new DateTime())->format('Y-m-d H:i:s');
    $model->c_deleted = 0;
    // $model->id_magazin = Yii::$app->session['magazin']->id;
    if ($model->load(Yii::$app->request->post())&& $model->save()) {
        return $this->actionShowByCategory($idCategory);
    } else {
        return $this->render('create', compact('model', 'categorys'));
    }
}


/**
 * Deletes an existing Products model.
 * If deletion is successful, the browser will be redirected to the 'index' page.
 * @param integer $id
 * @return mixed
 */
public function actionDelete($id)
{
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
}

/**
 * Finds the Products model based on its primary key value.
 * If the model is not found, a 404 HTTP exception will be thrown.
 * @param integer $id
 * @return Products the loaded model
 * @throws NotFoundHttpException if the model cannot be found
 */
protected function findModel($id)
{
    if (($model = Products::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

function actionGetProducts($idCategory = null) {

    $query = Products::find()->asArray();//->where(['c_deleted' => 0]);

    $pagination = new Pagination([
        'defaultPageSize' => 10,
        'totalCount' => $query->count()
    ]);

    $products = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('products', compact('products', 'pagination'));
    // return $this->render('products', [ 'model' => $products]);

}

function actionGrid() {
    $dataProvider = new ActiveDataProvider([
        'query' => Products::find(),
        'pagination' => [
            'pageSize' => 2,
        ],
    ]);

//        if (yii::$app->request->post('hasEditable')) {
//            echo 'aaa';
//        }

    return $this->render('grid', compact('dataProvider'));
}

//    function actionUpdate() {
//        print_r(yii::$app->request->get());
//    }

function actionSetProducts() {
    $products = new Products();
    if ($products->load(Yii::$app->request->post('saveProduct'))) {
        // $data = Yii::$app->request->post('Products');
        // $products->c_name = $data['c_name'];
        // $products->id_category = $data['id_category'];
        // $products->c_price = $data['c_price'];
        // $products->c_count = $data['c_count'];
        // $products->c_description = $data['c_description'];
        // $products->save();
        if ($products->validate()) {
            $products->save();
            Yii::$app->session->setFlash('success', 'Данные сохранены');
            $this->refresh();
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка');
        }
    }

    $categorys = ArrayHelper::map(Categorys::find()->asArray()->all(), 'id', 'c_name');
    return $this->render('productsSet', compact('products', 'categorys'));
}

}

?>