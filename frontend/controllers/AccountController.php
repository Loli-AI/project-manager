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
class AccountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['edit-password'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['edit-password'],
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
    public function actionEditPassword()
    {
        Yii::$app->name = "Akun";
        $dataUser = User::findIdentity(Yii::$app->user->identity->id);


        if (Yii::$app->request->post('new_password_repeat') == Yii::$app->request->post('new_password')) {

            if ($dataUser->validatePassword(Yii::$app->request->post('old_password'))) {

                if (strlen(Yii::$app->request->post('new_password_repeat')) < 6) {
                    Yii::$app->session->addFlash("danger", "Password Terlalu Pendek (Minimal 6 Karakter)");
                    $user = User::findIdentity(Yii::$app->user->identity->id);
                    return $this->redirect(['site/account', ['user' => $user]]);
                }
                $dataUser->setPassword(Yii::$app->request->post('new_password_repeat'));
                $dataUser->save();
                Yii::$app->session->addFlash("success", "Password Telah Diubah");

            } else {

                Yii::$app->session->addFlash("danger", "Password Lama Salah");

            }

        } else {

            Yii::$app->session->addFlash("danger", "Password Tidak Cocok");

        }
        
        $user = User::findIdentity(Yii::$app->user->identity->id);
        return $this->redirect(['site/account', ['user' => $user]]);
    }

    public function actionEditUsername() 
    {
        Yii::$app->name = "Akun";
        $dataUser = User::findIdentity(Yii::$app->user->identity->id);

        if ($dataUser->validatePassword(Yii::$app->request->post('old_password'))) {
            if (User::find(['name'])->where(['username' => Yii::$app->request->post('username')])->one()) {
                Yii::$app->session->addFlash("danger", "Nama Telah Dipakai");
            } else {
                $dataUser->username = Yii::$app->request->post('username');
                $dataUser->save();
                Yii::$app->session->addFlash("success", "Username Telah Diubah");
            }
        } else {
            Yii::$app->session->addFlash("danger", "Password Salah");
        }
        
        $user = User::findIdentity(Yii::$app->user->identity->id);
        return $this->redirect(['site/account', ['user' => $user]]);
    }

}
