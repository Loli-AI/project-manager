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
    $("#card_desc_input").toggle();
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

function addLink() {
    $("#newCard").modal('toggle');
    $("#linkModal").modal('toggle');
}

function addLinkDescription(e) {
    e.preventDefault();
    let value = $("#link_modal").val();
    document.querySelector("#card_desc").value += `<a target='_blank' href='${value}'>${value}</a>`;
    $("#linkModal").modal('toggle');
}

function togglePreviewPopover() {
    $('#preview').popover('show');
}

function preview() {
    $("#contentPreview").html($("#card_desc").val()); 
    $("#titlePreview").html($("#card_title").val()); titlePreview
}

function displayImgModal(e) {
  $('#imgModal').attr('src', e.target.src);
  $('#imgModalDisplay').modal('toggle');
};