<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Magazin;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{

    // public static $nameMagazin = 'Магазин';
    // public static $idMagazin = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    //TODO не получилось отображение ошибок/исключений перехватить - показать как мне надо((
    //в config/web.php errorHandler
    // public function actionFault()
    // {
    //     $exception = Yii::$app->errorHandler->exception;
     
    //     if ($exception !== null) {
    //         $statusCode = $exception->statusCode;
    //         $name = $exception->getName();
    //         $message = $exception->getMessage();
            
    //         $this->layout = 'custom-error-layout';
            
    //         return $this->render('custom-error-view', [
    //             'exception' => $exception,
    //             'statusCode' => $statusCode,
    //             'name' => $name,
    //             'message' => $message
    //         ]);
    //     }
    // }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       $magazin = new Magazin();
       $magazins = ArrayHelper::map(Magazin::find()->asArray()->all(), 'id', 'c_name');

        if ($magazin->load(Yii::$app->request->post()) && $magazin->id) {
            $find = Magazin::findOne($magazin->id);
            $this->setMagazin($find);
            // return $this->redirect(['products/index']);
            return $this->redirect(['log/index']);
        }

        return $this->render('index', compact('magazins', 'magazin'));
    }

    public static function getNameMagazin() {
        // return self::$nameMagazin;
        $nameMag = 'Магазин';
        if (Yii::$app->session['magazin']) {
            $nameMag = Yii::$app->session['magazin']->c_name;
        }

        return $nameMag;
    }

    public static function setMagazin($magazin) {
        // self::$nameMagazin = $magazin->c_name;
        // self::$idMagazin = $magazin->id;
        // Yii::$app->params['magazin'] = $magazin;
        if (Yii::$app->session['magazin']) {
            Yii::$app->session['magazin'] = $magazin;
        } else {
            $session = new \yii\web\Session;
            $session->open();
            $session['magazin'] = $magazin;
        }

        
        // print_r($session['magazin']);die();
// print_r(Yii::$app->params['magazin']);die();
     }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHello() {
        return 'Hello, world';
    }
}
