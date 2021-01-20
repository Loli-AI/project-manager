$(document).ready(() => {

    getProjects();

    setTimeout(() => {
        $('#searchProjects').popover('show');
    }, 800);

    $('#search').on('focus', function () {
        $('#searchProjects').popover('hide');
        $('#searchProjects').popover('disable');
    });

    $('#editCardTitle').on('hidden.bs.modal', function () {
        $('#card').modal('toggle');
    });

    $("#card_desc").summernote({
        codeviewFilter: false,
        codeviewIframeFilter: true,
        placeholder: 'Deskripsi',
          height: 300,
          toolbar: [
            ['font', ['bold', 'underline']],
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
          url: '/action/upload-image',
          cache: false,
          contentType: false,
          processData: false,
          success: function(url) {
              $(el).summernote('pasteHTML', '<img onclick="displayImgModal(event)" class="img-fluid hover-pointer" src="'+url+'" />');
          }
      });
    }

    $('.note-insert button').click(() => {
      // $('#newCard').modal('hide');
    });

});