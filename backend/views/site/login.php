<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Masuk';
?>

<div class="container pt-5">

            <div class="w-50 m-auto">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Isi Data Berikut Agar Dapat Masuk</p>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Nama'])->label(false) ?>

                            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Kata Sandi'])->label(false) ?>

                            <?= $form->field($model, 'rememberMe')->checkbox()->label('Ingat Saya') ?>

                            <div class="form-group">
                                <?= Html::submitButton('<i class="fas fa-door-open"></i>&nbsp;&nbsp;Masuk', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
            </div>
</div>