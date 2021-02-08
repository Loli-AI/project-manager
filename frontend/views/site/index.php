<?php
  use yii\helpers\Html;
  use yii\bootstrap4\ActiveForm;
  use yii\helpers\Url;
  $this->title = Yii::$app->name;
?>

<div class="container my-5 position-relative">
      <h1 class="mb-5 text-center">~ <span id="titlePage">Halaman Utama</span> ~</h1>
      <hr>
      <div class="row" id="lists">
        <!-- <center class="text-muted w-100">
          Jika Tidak Ada Daftar Project, Maka Kemungkinan Admin Belum Memberikan Akses Kepada Anda
        </center> -->
      </div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" id="loadButton" data-target="#load">&nbsp;</button>

<!-- Modal Loader -->
<div class="modal position-absolute" id="load" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:19999;">
  <div class="modal-dialog modal-dialog-centered" role="document" style="z-index:12999;">
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
          <textarea id="card_desc"></textarea>
      </div>
      <div class="modal-footer">
        <div class="position-relative mr-auto" data-placement="left" id="preview" data-toggle="popover" data-html="true" data-content="<strong>Klik Disini Untuk Melihat Hasil</strong>">
        </div>
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fas fa-check"></i>&nbsp;&nbsp;Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Card Data Modal -->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div id="cardContent" class="modal-content">
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
                <textarea id="card_desc_input"></textarea>
                <button type="submit" id="submit_card_desc" class="btn btn-sm mt-2 btn-dark"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Deskripsi</button>
              </form>
              <div id="cardDesc" class="bg-light card p-3"></div>
            </div>
          </div>

          <div class="mt-4">
            <span class="font-weight-bold">
              <i id="comment" class="fas fa-chart-line"></i>&nbsp;&nbsp;Komentar
            </span>
            <form onsubmit="addComment(event)">
              <textarea id="comment_input"></textarea>
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

<div class="modal fade pt-3" id="imgModalDisplay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <img class="mx-auto d-block" style="max-width: 100%;max-height: 100%;" id="imgModal">
  </div>
</div>

<!-- List Title Modal -->
<div class="modal fade" id="reply_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>
          Balas Komentar <span id="name_comment"></span>
        </strong>
        <abbr title="Tutup">
          <div class="float-right mr-2 btn-sm btn-light btn text-muted" data-dismiss="modal"><i class="fas fa-times"></i></div>
        </abbr>
      </div>
      <div class="modal-body">
        <form onsubmit="addReply(event)">
          <input type="hidden" id="reply_id">
        <textarea id="reply_input"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fas fa-share"></i>&nbsp;&nbsp;Balas</button>
        </form>
      </div>
    </div>
  </div>
</div>