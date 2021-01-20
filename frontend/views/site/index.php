<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  use yii\helpers\Url;

  $this->title = Yii::$app->params['title'];

?>

<div class="container my-5">
      <h1 class="mb-5 text-center">~ <span id="titlePage"><?= $this->title; ?></span> ~</h1>
      <div class="row" id="lists"></div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" id="loadButton" data-target="#load">&nbsp;</button>

<!-- Modal Loader -->
<div class="modal" id="load" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="spinner-grow text-primary" style="width:8rem;height:8rem;" role="status"></div>
    <div class="spinner-grow text-primary" style="width:8rem;height:8rem;" role="status"></div>
    <div class="spinner-grow text-primary" style="width:8rem;height:8rem;" role="status"></div>
    <div class="spinner-grow text-primary" style="width:8rem;height:8rem;" role="status"></div>
    <button id="closeLoad" type="button" class="btn btn-secondary" data-dismiss="load">Close</button>
  </div>
</div>

<!-- Modal New List -->
<div class="modal fade" id="newList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Grup Topik Baru
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <form onsubmit="addList(event)">
        <input type="text" placeholder="Judul Grup Topik" class="form-control" required id="title" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal New Card -->
<div class="modal fade" id="newCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Tambah Topik
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <form onsubmit="addCard(event)">
          <input type="hidden" id="card_id" />
          <input type="text" placeholder="Judul Topik" class="form-control mb-4" required id="card_title" />
          <!-- <div class="position-relative"> -->
            <!-- <div class="position-absolute"> -->
              <!-- <abbr title="Masukkan Gambar"> -->
                <!-- <div onclick="$('#imgDesc').trigger('click')" class="btn btn-sm btn-dark" style="top:0;left:0;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Gambar</div> -->
              <!-- </abbr> -->
              <!-- <abbr title="Masukkan Link"> -->
                <!-- <div class="btn btn-sm btn-dark" onclick="addLink()" style="top:0;left:0;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Link</div> -->
              <!-- </abbr> -->
            <!-- </div> -->
            <!-- <textarea onchange="togglePreviewPopover()" onkeydown="togglePreviewPopover()" placeholder="Deskripsi" class="form-control pt-5" id="card_desc" cols="10" rows="10"></textarea> -->
            <textarea id="card_desc"></textarea>
            <!-- <input type="file" accept="image/*" style="display:none" id="imgDesc"> -->
          <!-- </div> -->
      </div>
      <div class="modal-footer">
        <div class="position-relative mr-auto" data-placement="left" id="preview" data-toggle="popover" data-html="true" data-content="<strong>Klik Disini Untuk Melihat Hasil</strong>">
          <!-- <button id="previewButton" type="button" class="btn btn-secondary" onclick="preview();$('#newCard').modal('hide');$('#previewModal').modal('show');"><i class="fas fa-eye"></i>&nbsp;&nbsp;Lihat Hasil</button> -->
        </div>
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Card Data Modal -->
<div class="modal" id="card" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
    <h4>
      <span id="cardTitle"></span>
      <div class="btn btn-sm btn-light ml-2" onclick="modalCardTitle()">Ubah</div>
    </h4>
      <abbr title="Tutup">
        <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
      </abbr>
    </div>
    <div class="modal-body">
      <div class="row container">

        <div class="col col-12">
          <div>
            <div class="font-weight-bold mb-2">
              <i class="fas fa-signature"></i>&nbsp;&nbsp;Deskripsi
              <div class="btn btn-sm btn-light ml-2" onclick="editCard()" id="edit_card_desc">Ubah</div>
            </div>
            <div id="cardDescription">
              <form onsubmit="editDataCard(event)">
                <textarea placeholder="Your Card Description" class="form-control mt-2" id="card_desc_input" cols="10" rows="3"></textarea>
                <button type="submit" id="submit_card_desc" class="btn btn-sm mt-2 btn-dark"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Deskripsi</button>
              </form>
              <div id="cardDesc"></div>
            </div>
          </div>

          <div class="font-weight-bold mt-4">
            <i class="fas fa-chart-line"></i>&nbsp;&nbsp;Komentar
            <form onsubmit="addComment(event)">
              <input type="text" class="form-control mt-2" id="comment_input" autocomplete="off" placeholder="Ketikkan Komentar" />
              <button data-id="comment_button" type="submit" class="btn btn-dark btn-sm mt-2"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Komentar</button>
            </form>
          </div>
          <hr>
          <div id="comments"></div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Card Title Modal -->
<div class="modal fade" id="editCardTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Ganti Judul Topik
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <form onsubmit="editCardTitle(event)">
        <input type="text" class="form-control" required id="title_card" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- List Title Modal -->
<div class="modal fade" id="editListTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Ganti Judul Grup Topik
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <form onsubmit="editListTitle(event)">
        <input type="text" class="form-control" required id="title_list" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="imgModalDisplay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <img id="imgModal">
  </div>
</div>