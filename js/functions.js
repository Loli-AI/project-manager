let editCardToggle = 1;
let editCardData = "";

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
        focus : true,
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

function reply(id) {
  $('#name_comment').html($('#'+id+"name").html());
  $('#name_comment').data('id', id);
  $("#reply_input").summernote({
        codeviewFilter: false,
        codeviewIframeFilter: true,
        dialogsInBody: true,
        focus : true,
        disableDragAndDrop: true,
        dialogsFade: true,
        placeholder: 'Ketikkan Balasan...',
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
    $('#card').modal('hide');
    $('#reply_id').val(id);
    $('#reply_modal').modal('show');
}

function push(id) {
  setTimeout(() => {
    $("#"+id).animate({left : '10px'}, 'fast', function () {
     $(this).animate({left : '-10px'}, 'fast', function () {
       $(this).animate({left : '10px'}, 'fast', function () {
         $(this).animate({left : '-10px'}, 'fast', function () {
           $(this).animate({left : '0'}, 'fast', )
          })
        })
      })
    });
  }, 100);
}