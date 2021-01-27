<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Buat Akun Baru';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup mt-5 position-relative">
    

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

    <p>Mohon Isi Data Berikut Agar Dapat Mengakses Halaman</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => "Nama"])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Kata Sandi'])->label(false) ?>

                <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Ulangi Kata Sandi'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;Daftar', ['class' => 'btn btn-dark', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
