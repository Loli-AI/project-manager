<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    // public $email;
    public $password;
    public $password_repeat;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Nama Tidak Boleh Kosong'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Nama Ini Telah Diambil, Coba Yang Lain'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Nama Terlalu Pendek, Minimal 2 Karakter'],
            // ['email', 'trim'],
            // ['email', 'required'],
            // ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required', 'message' => 'Kata Sandi Tidak Boleh Kosong'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => "Kata Sandi Terlalu Pendek"],
            ['password_repeat', 'required', 'message' => "Kata Sandi Tidak Boleh Kosong"],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Kata Sandi Tidak Sama"]        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        // return $user->save() && $this->sendEmail($user);
        $user->status = User::STATUS_ACTIVE;
        return $user->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
