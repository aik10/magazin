<?php

namespace app\controllers;

use Yii;
use app\models\Log;
use app\models\searchLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \DateTime;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
{
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
     * Lists all Log models.
     * @return mixed
     */
    public function actionIndex($type = null)
    {
// print_r(Yii::$app->request->post());//die();
        $searchModel = new searchLog();
        $searchModel->c_type = $type;
        $searchModel->titlelog = $this->setTitleLog($type);
        $searchModel->id_magazin = Yii::$app->session['magazin']->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sum = $this->getSum($dataProvider);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'typeIndex' => $type,
            'summ' => $sum
        ]);
    }

    public function getSum($data)
    {
        $sum = 0;
        if (!empty($data)) {
            foreach ($data->models as $tovar) {
                $sum += $tovar->c_summ;
            }
        }

        return $sum;
    }

    /**
     * Displays a single Log model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function setTitleLog ($type)
    {
        $titlelog = 'Журнал';
        if ($type == 'add') {
            $titlelog = 'Приход';
        } else if ($type == 'sale') {
            $titlelog = 'Расход';
        }

        return $titlelog;
    }

    /**
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type = null, $model = null)
    {
        // if (!$model->id_product) {
        if (!$model) {
            $model = new Log();
        }

        $model->titlelog = $this->setTitleLog($type);
        $model->c_type = $type;

        if ($model->load(Yii::$app->request->post())){// && $model->save()) {
            $command = Yii::$app->db->createCommand("select log_set(" .
            $model->id_product . ",'".
            $model->c_type . "', ".
            $model->c_count . ",'".
            $model->c_comment ."','".
            Yii::$app->session['magazin']->id ."','".
            $model->c_date ."')");
            $data = $command->query();

            return $this->redirect(['index', 'type' => $type]);
        } else {
            $model->c_date = (new DateTime())->format('Y-m-d H:i:s');
            return $this->render('create', [
                'model' => $model,
                'type' => $type
            ]);
        }
    }

    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Log model.
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
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Log::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
