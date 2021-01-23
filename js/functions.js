let editCardToggle = 1;
let editCardData = "";
const domain = "/project-manager" || "";

function load(data) {
    if (data == "1") {
        $('#load').modal('show');
    } else {
        $('#load').modal('hide');
    }
}

function mess(className, message) {
    $("#alert-message").attr("class", "alert " + className + " alert-dismissible");
    $("#message").html(message);
    $("#alert-message").show();
}

function editCard() {
    $("#cardDesc").toggle();
    $("#submit_card_desc").toggle();
    if (editCardToggle) {
        $("#card_desc_input").summernote({
        codeviewFilter: false,
        codeviewIframeFilter: true,
        dialogsInBody: true,
        disableDragAndDrop: true,
        dialogsFade: true,
        placeholder: 'Deskripsi',
          height: 300,
          toolbar: [
            ['font', ['bold', 'underline', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['insert', ['link', 'picture']],
          ],
           callbacks: {
          onImageUpload : function(files, editor, welEditable) {
               for(var i = files.length - 1; i >= 0; i--) {
                  sendFile(files[i], this);
              }
          }
        }
    });

    $('.note-modal').on('hidden.bs.modal', function () {
        $('#card').modal('hide');
        $('#card').modal('show');
    });

    function sendFile(file, el) {
      var form_data = new FormData();
      form_data.append('file', file);
      $.ajax({
          data: form_data,
          type: "POST",
          url: domain+'/action/upload-image',
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
              $(el).summernote('pasteHTML', '<img src="'+domain+url+'" />');
          }
      });
    }

    $("#card_desc_input").summernote('code', $("#cardDesc").html());
    editCardToggle = 0;
    } else {
        $("#card_desc_input").summernote('destroy');
        $("#card_desc_input").hide();
        editCardToggle = 1;
    }
    

}

function modalCardTitle() {
    $('#card').modal('toggle');
    $('#editCardTitle').modal('toggle');
}

function editTitleList(data) {
    $('#title_list').val(data[1]);
    $('#title_list').data('id', data[0]);
    $('#editListTitle').modal('show');
}

function displayImgModal(e) {
  $('#imgModal').attr('src', e.target.src);
  $('#card').modal('toggle');
  $('#imgModalDisplay').modal('toggle');
};