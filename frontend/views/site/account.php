<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  use yii\helpers\Url;
  $this->title = Yii::$app->name;

  $url = explode("/", Yii::$app->request->url);
  $mainUrl = "/" . $url[1];
?>

<div class="container my-5 position-relative p-3">
	
  <div class="row">
    
    <div class="col col-3"></div>
    <div class="col col-6">
      <h1>
    <?= $user->username ?>
  </h1>
  <hr>
  <button data-toggle="modal" data-target="#username" class="btn btn-dark btn-sm my-3 d-block"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Ubah Nama</button>
  <button data-toggle="modal" data-target="#password" class="btn btn-dark btn-sm my-3 d-block"><i class="fas fa-key"></i>&nbsp;&nbsp;Ubah Sandi</button>
    </div>
  </div>
</div>

<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Ganti Sandi
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <?php ActiveForm::begin(['action' => $mainUrl . '/account/edit-password', 'method' => 'post']); ?>
        <?= Html::input('password','new_password','', $options=['class'=>'form-control my-3', 'placeholder' => 'Sandi Baru']) ?>
        <?= Html::input('password','new_password_repeat','', $options=['class'=>'form-control my-3', 'placeholder' => 'Ulangi Sandi Baru']) ?>
        <?= Html::input('password','old_password','', $options=['class'=>'form-control my-3', 'placeholder' => 'Masukkan Sandi Lama']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <?= Html::submitButton('<i class="fas fa-check"></i>&nbsp;&nbsp;Simpan', ['class' => 'btn btn-dark']) ?>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Ganti Nama
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <?php ActiveForm::begin(['action' => $mainUrl . '/account/edit-username', 'method' => 'post']); ?>
	        <?= Html::input('text','username','', $options=['class'=>'form-control my-3', 'placeholder' => 'Nama Baru']) ?>
	        <?= Html::input('password','old_password','', $options=['class'=>'form-control my-3', 'placeholder' => 'Masukkan Sandi']) ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <?= Html::submitButton('<i class="fas fa-check"></i>&nbsp;&nbsp;Simpan', ['class' => 'btn btn-dark']) ?>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>