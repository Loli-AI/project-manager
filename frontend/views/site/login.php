<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-relative mt-5 p-4 rounded">
    

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

    <p>Mohon Isi Data Berikut Untuk Dapat Masuk</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => "Nama"])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Kata Sandi"])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Ingat Saya") ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fas fa-door-open"></i>&nbsp;&nbsp;Masuk', ['class' => 'btn btn-dark', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
