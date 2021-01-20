<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nama'])->label(false) ?>

    <?= $form->field($model, 'relation')->textInput(['placeholder' => 'Relasi Projek'])->label(false) ?>

    <?= $form->field($model, 'id_user')->textInput(['placeholder' => 'Kode User'])->label(false) ?>

    <?= $form->field($model, 'is_master')->textInput(['placeholder' => 'Kode Master', 'type' => 'number'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i>&nbsp;&nbsp;Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
