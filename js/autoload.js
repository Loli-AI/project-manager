$(document).ready(() => {

    if (path == '/project-manager' || path == '/project-manager/' || path == '/project-manager/site' || path == '/project-manager/site/' || path == '/project-manager/site/index' || path == '/project-manager/site/index/') {
      getProjects();
    }

    $('#search').on('focus', function () {
        $('#searchProjects').popover('hide');
        $('#searchProjects').popover('disable');
    });

    $('#editCardTitle').on('hidden.bs.modal', function () {
        $('#card').modal('toggle');
    });

    $('#imgModalDisplay').on('hidden.bs.modal', function () {
        $('#card').modal('toggle');
    });

    $("#card_desc").summernote({
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
        $('#newCard').modal('hide');
        $('#newCard').modal('show');
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

    $('#card').on('hidden.bs.modal', function () {
      if ($("#cardDesc").css('display') == 'none') {
        $("#cardDesc").toggle();
        $("#submit_card_desc").toggle();
        $("#card_desc_input").summernote('destroy');
        $("#card_desc_input").hide();
        editCardToggle = 1;
      }
    });

});