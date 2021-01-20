<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Mohon Isi Data Berikut Untuk Dapat Masuk</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => "Nama"])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Kata Sandi"])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Ingat Saya") ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fas fa-door-open"></i>&nbsp;&nbsp;Masuk', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
