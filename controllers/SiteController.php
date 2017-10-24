<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignForm;
use app\models\TransferForm;
use app\models\User;
use app\models\UserSearch;
use app\models\TransferHistory;

class SiteController extends Controller {

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['login', 'profile', 'signup', 'transfer', 'logout'],
        'rules' => [
          [
            'actions' => ['logout', 'profile', 'transfer'],
            'allow' => true,
            'roles' => ['@'],
          ],
          [
            'actions' => ['login', 'signup'],
            'allow' => true,
            'roles' => ['?'],
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
  public function actions() {
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

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionIndex() {
    $searchModel = new UserSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Signup action
   */
  public function actionSignup() {
    $model = new LoginForm();
    $rmodel = new SignForm();

    if ($rmodel->load(Yii::$app->request->post())) {
      if ($user = $rmodel->signup()) {
        if (Yii::$app->getUser()->login($user)) {
          return $this->goHome();
        }
      }
    }

    return $this->render('login', [
        'model' => $model,
        'rmodel' => $rmodel
    ]);
  }

  /**
   * Signup action
   */
  public function actionTransfer($id) {
    $model = new TransferForm();
    $user = User::findIdentity($id);
    $model->username = $user->username;

    if ($model->load(Yii::$app->request->post())) {
      if ($model->transfer()) {
        return $this->goHome();
      } else {
        return $this->render('error', [
            'message' => $model->error_message,
        ]);
      }
    }

    return $this->render('transfer', [
        'model' => $model,
    ]);
  }

  /**
   * Login action.
   *
   * @return Response|string
   */
  public function actionLogin() {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    $rmodel = new SignForm();

    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    return $this->render('login', [
        'model' => $model,
        'rmodel' => $rmodel
    ]);
  }

  /**
   * Logout action.
   *
   * @return Response
   */
  public function actionLogout() {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
   * Displays contact page.
   *
   * @return Response|string
   */
  public function actionContact() {
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
  public function actionProfile() {
    if (!Yii::$app->user->isGuest) {
      $user = User::findIdentity(Yii::$app->user->id);
      $op_to = TransferHistory::findAll(['user_id_from' => $user->id]);
      $op_from = TransferHistory::findAll(['user_id_to' => $user->id]);

      return $this->render('profile', ['user' => $user, 'op_to' => $op_to, 'op_from' => $op_from]);
    } else {
      return $this->render('error', ['message' => 'You are not logged']);
    }
  }
}