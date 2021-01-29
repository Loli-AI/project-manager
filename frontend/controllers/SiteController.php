<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\Lists;
use common\models\User;
use frontend\models\Cards;
use frontend\models\Comments;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'signup', 'forum', 'logout', 'account'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['forum', 'logout', 'account', 'login', 'signup'],
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
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->name = "PT RANGKAI UTAMA BERJAYA";
        $this->layout = 'blank';
        return $this->render('web');
    }

    public function actionForum()
    {
        Yii::$app->name = "Projek";
        $this->layout = 'main';
        return $this->render('index');
    }

    public function actionAccount()
    {
        Yii::$app->name = "Akun";
        $user = User::findIdentity(Yii::$app->user->identity->id);
        return $this->render('account', ['user' => $user]);
    }

    public function actionLogin()
    {
        $this->layout = "auth";
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('forum');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('forum');
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = "auth";
        $model = new SignupForm();
        $loginModel = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->addFlash("info", "Akun Telah Dibuat, Silahkan Masuk");
            return $this->redirect("login");
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
