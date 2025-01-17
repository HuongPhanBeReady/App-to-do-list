<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\User; 

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */


    /**
     * Logout action.
     *
     * @return Response
     */

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['site/signup-success']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSignupSuccess()
    {
        return $this->render('signup-success');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
    
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['profile']);
        }
    
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionProfile()
    {
        $user = Yii::$app->user->identity;
        if ($user === null) {
            return $this->redirect(['login']);
        }

        return $this->render('profile', [
            'user' => $user,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        
        if ($exception instanceof \yii\web\ForbiddenHttpException) {
            // If the error is 403, display the custom 403 error page
            return $this->render('error403', [
                'name' => 'Error 403',
                'message' => 'You need to log in to access this page.',
            ]);
        }
        
        // Handle other errors
        return $this->render('error', [
            'name' => $exception instanceof \yii\base\UserException ? $exception->getName() : 'Error',
            'message' => $exception instanceof \yii\base\UserException ? $exception->getMessage() : 'An error occurred.',
        ]);
    }
}













