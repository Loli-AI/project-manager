function popoverFunctions() {
    let deleteLists = document.querySelectorAll(".deleteList");
    let deleteCards = document.querySelectorAll(".deleteCard");
    let editLists = document.querySelectorAll(".editList");

    editLists.forEach((editList) => {
        editList.addEventListener('click', (e) => { editTitleList(editList.id.split("@|#"))});
    });

    deleteCards.forEach((deleteCard) => {
        deleteCard.addEventListener('click', (e) => {
            let formData = new FormData;
            formData.append("id", deleteCard.id);
            $.ajax({
                url: domain+'/action/delete-card',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    mess("alert-success", `Topik <strong>${data}</strong> Telah Dihapus`);
                    async function erase() {
                        $("#lists").html("");
                    }
                    erase().then(getLists());
                }
            });
        });
    });

    deleteLists.forEach((deleteList) => {
        deleteList.addEventListener('click', () => {
            let formData = new FormData;
            formData.append("id", deleteList.id);
            $.ajax({
                url: domain+'/action/delete-list',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    mess("alert-success", `Grup Topik <strong>${data}</strong> Telah Dihapus`);
                    load(0);
                    async function erase() {
                        $("#lists").html("");
                    }
                    erase().then(getLists());
                }
            });
        });
    });
}

function getComments(id, cont) {
    let formData = new FormData;
    formData.append('id', id);
    $.ajax({
        url: domain+'/action/get-comment',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            let name = document.createElement("div");
            name.setAttribute("class", "font-weight-bold");
            name.innerHTML = data.response.comment_data.user;

            let message = document.createElement("div");
            message.innerHTML = data.response.comment_data.message;

            let date = document.createElement("small");
            date.setAttribute("class", "text-muted mr-1 position-absolute");
            date.setAttribute("style", "right:0;bottom:0;");
            date.innerHTML = data.response.comment_data.date;

            cont.appendChild(name);
            cont.appendChild(message);
            cont.appendChild(date);
        }
    });
}

function addComment(e) {
    $('.note-editable img').addClass('img-fluid img-description hover-pointer rounded');
    $('.note-editable img').attr('onclick', 'displayImgModal(event)');
    $("#card").modal("hide");
    load(1);
    e.preventDefault();
    let formData = new FormData;
    formData.append("data", $("#comment_input").summernote('code'));
    formData.append("id", $("#submit_card_desc").attr("data-id"));

    $.ajax({
        url: domain+'/action/add-comment',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#comment_input").summernote('code', '')
            load(0);
            refreshCard(e.submitter.id);
        }
    });
}

function editDataCard(e) {
    $('.note-editable img').addClass('img-fluid img-description hover-pointer rounded');
    $('.note-editable img').attr('onclick', 'displayImgModal(event)');
    $("#card").modal("hide");
    load(1);
    e.preventDefault();
    let formData = new FormData;
    formData.append("data", $("#card_desc_input").summernote('code'));
    formData.append("id", $("#submit_card_desc").attr("data-id"));
    $.ajax({
        url: domain+'/action/edit-card-description',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            editCard();
            $("#card_desc_input").summernote('destroy');
            $("#card_desc_input").hide();
            editCardToggle = 1;
            refreshCard($("#submit_card_desc").attr("data-id"));
        }
    });
}

function getCards(id, dom, setting, list_id, checkbox) {
    let formData = new FormData;
    formData.append("id", id);
    load(1);
    $.ajax({
        url: domain+'/action/get-cards',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.response.allCard[0].is_done == 1) {
                checkbox.setAttribute("checked", "true");
                dom.setAttribute("style", "text-decoration:line-through;background-color:#E5E7EB;");
            }
            checkbox.setAttribute("onchange", "checkCard("+data.response.allCard[0].id+")");
            checkbox.setAttribute("class", "position-absolute btn checked");
            checkbox.setAttribute("style", "right:5px;bottom:5px;");
            checkbox.setAttribute("value", "1");

            let hr = document.createElement("hr");
            hr.setAttribute("id", data.response.allCard[0].id);
            let date = document.createElement("small");
            date.setAttribute('class', 'text-muted');
            date.setAttribute('id', data.response.allCard[0].id);
            date.innerHTML = data.response.allCard[0].date;

            setting.dataset.content = "<div id='" + data.response.allCard[0].id + "|"+ list_id +"' class='deleteCard btn-sm btn btn-dark w-100' id='list'><i class='fas fa-eraser'></i>&nbsp;&nbsp;Hapus</div>";

            dom.setAttribute("id", data.response.allCard[0].id);
            dom.innerHTML += data.response.allCard[0].title;
            dom.appendChild(hr);
            hr.appendChild(date);
            load(0);
        }
    });
}

function checkCard(id) {
    let formData = new FormData;
    formData.append("id", id);
    $.ajax({
        url: domain+'/action/check-card',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            mess("alert-success", data.output);
            load(0);
            async function erase() {
                $("#lists").html("");
            }
            erase().then(getLists());
        }
    });
}

function addList(e) {
    e.preventDefault();
    let titleInput = $("#title");
    $("#newList").modal('hide');
    load(1);
    $.ajax({
        url: domain+'/action/add-list',
        type: 'post',
        data: { title: titleInput.val() },
        success: function (data) {
            titleInput.val("");
            mess("alert-success", `Grup Topik <strong>${data}</strong> Telah Dibuat`);
            load(0);
            async function erase() {
                $("#lists").html("");
            }
            erase().then(getLists());
        }
    });
}

function addCard(e) {
    e.preventDefault();
    $('.note-editable img').addClass('img-fluid img-description hover-pointer rounded');
    $('.note-editable img').attr('onclick', 'displayImgModal(event)');
    $("#newCard").modal('hide');
    var formData = new FormData;
    formData.append("card_id", $("#card_id").val());
    formData.append("title", $("#card_title").val());
    formData.append("description", $("#card_desc").summernote('code'));
    load(1);
    $.ajax({
        url: domain+'/action/add-card',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#card_title").val("");
            $("#card_desc").summernote('code', '');
            mess("alert-success", `Topik <strong>${data}</strong> Telah Dibuat`);
            load(0);
            async function erase() {
                $("#lists").html("");
            }
            erase().then(getLists());
        }
    });
}

function refreshCard(id) {
    load(1);
    $("#comment_input").summernote({
        codeviewFilter: false,
        codeviewIframeFilter: true,
        dialogsInBody: true,
        disableDragAndDrop: true,
        dialogsFade: true,
        height : 200,
        placeholder: 'Tambahkan Komentar',
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

    let formData = new FormData;
    formData.append("id", id);
    $.ajax({
        url: domain+'/action/get-card-data',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            async function appendData() {
                let id_comments = data.response.cardData[0].id_comment.split("|");
                id_comments.pop();
                $("#card_desc_input").hide();
                $("#submit_card_desc").hide();
                $("#title_card").val(data.response.cardData[0].title);
                document.querySelector("#comments").innerHTML = "";
                $('[data-id="comment_button"]').attr('id', data.response.cardData[0].id);
                document.querySelector("#submit_card_desc").dataset.id = data.response.cardData[0].id;
                $("#cardTitle").html(data.response.cardData[0].title);
                if (data.response.cardData[0].description == "" || data.response.cardData[0].description == "<p><br></p>") {
                    $("#cardDesc").html("<i>~ Tidak Ada Deskripsi ~</i>");
                } else {
                    $("#cardDesc").html(data.response.cardData[0].description);
                }

                if (data.response.cardData[0].id_comment == "") {
                    document.querySelector("#comments").innerHTML = "<i>~ Belum Ada Komentar ~</i>";
                } else {
                    id_comments.forEach((id_comment) => {
                        let cont = document.createElement("div");
                        cont.setAttribute("class", "card bg-light p-2 block pb-4 position-relative");

                        getComments(id_comment, cont);

                        document.querySelector("#comments").appendChild(cont);
                    });
                }
                $("#cardDesc").show();
            }
            appendData().then(() => {
                load(0);
                $("#card").modal("show");
            });
        }
    });
}

function editCardTitle(e) {
    e.preventDefault();
    let formData = new FormData;
    formData.append("data", $("#title_card").val());
    formData.append("id", $("#submit_card_desc").attr("data-id"));
    $.ajax({
        url: domain+'/action/edit-card-title',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success : (data) => {
            $('#editCardTitle').modal('toggle');
            getLists();
            setTimeout(() => {
                $("#card").modal("hide");
                refreshCard($("#submit_card_desc").attr("data-id"));
            }, 1000);
        }
    });
}

function editListTitle(e) {
    e.preventDefault();
    let formData = new FormData;
    formData.append("id", $("#title_list").data("id"));
    formData.append("data", $("#title_list").val());
    $.ajax({
        url: domain+'/action/edit-list-title',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            $('#editListTitle').modal('hide');
            mess("alert-success", `Judul Grup Topik <strong>${data[0]}</strong> Telah Diubah Menjadi <strong>${data[1]}</strong>`);
            async function erase() {
                $("#lists").html("");
            }
            erase().then(getLists());
        }
    });
}

function getProjects(id) {
    let formData = new FormData;
    formData.append("id", id);
    $.ajax({
        url: domain+'/action/get-projects',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            $("#projects").html("");
            data.projects.forEach((project) => {
                let option = document.createElement("option");
                option.setAttribute("value", project);
                document.querySelector("#projects").appendChild(option);
            });
            $('#searchProjects').data('content', `<strong>Ditemukan Total ${data.projects.length} Projek</strong>`);
            $('#searchProjects').popover('show');
        }
    });
}

function getLists() {
    let cont = document.querySelector("#lists");
    let formData = new FormData;
    load(1);
    $.ajax({
        url: domain+'/action/get-lists',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            let allList = data.response.allList;
            $("#lists").html("");
            $("#titlePage").html(data.title);

            let col_newlist = document.createElement("div");
            col_newlist.setAttribute('class', 'col col-3');

            let abbr_newlist = document.createElement("abbr");
            abbr_newlist.setAttribute('title', 'Tambah Grup Topik');

            let btn_newlist = document.createElement("div");
            btn_newlist.setAttribute('class', 'btn btn-dark w-100 shadow');
            btn_newlist.dataset.toggle = 'modal';
            btn_newlist.dataset.target = '#newList';

            let i_newlist = document.createElement("i");
            i_newlist.setAttribute('class', 'fas fa-plus');
            let i_newlist_desc = '&nbsp;&nbsp;Tambah Grup Topik';

            cont.appendChild(col_newlist);
            col_newlist.appendChild(abbr_newlist);
            abbr_newlist.appendChild(btn_newlist);
            btn_newlist.appendChild(i_newlist);
            btn_newlist.innerHTML += i_newlist_desc;

            allList.forEach((list) => {
                let cards = list.id_card.split("|");
                cards.pop();

                let col3 = document.createElement("div");
                col3.setAttribute('class', 'data col col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3');

                let card = document.createElement("div");
                card.setAttribute('class', 'card shadow position-relative');
                // card.setAttribute('class', 'card shadow');

                let card_header = document.createElement("div");
                card_header.setAttribute('class', 'card-header card-title pt-5');

                let i_header = document.createElement("i");
                // i_header.setAttribute('class', 'far fa-clipboard');
                let i_after = list["title"];

                let span = document.createElement("span");
                span.setAttribute('class', 'float-right block bg-dark w-100 position-absolute text-muted');
                span.setAttribute('style', 'right:0px;top:0px');

                let popover = document.createElement("i");
                // Role = button
                popover.setAttribute('class', 'fas fa-sliders-h no-click btn-sm ml-1 btn btn-dark p-2');
                popover.dataset.toggle = 'popover';
                popover.dataset.placement = 'left';
                popover.setAttribute('title', "<i class='fas fa-cog'>&nbsp;&nbsp;Pengaturan");
                popover.setAttribute('tabindex', 0);
                popover.dataset.html = 'true';
                popover.dataset.trigger = 'focus';
                popover.dataset.content = "<div id='" + list["id"] + "@|#" + list["title"] + "' class='editList mb-2 btn-sm w-100 btn btn-dark'><i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit</div><br><div id='" + list["id"] + "' class='deleteList btn-sm w-100 btn btn-dark' id='list'><i class='fas fa-eraser'></i>&nbsp;&nbsp;Hapus</div>";

                let card_body = document.createElement("div");
                card_body.setAttribute('class', 'card-body');
                card_body.setAttribute('id', list["id"]);

                // Cards

                cards.forEach((card) => {
                    let drag_item = document.createElement("div");
                    drag_item.setAttribute('class', 'dragItem');
                    drag_item.setAttribute('draggable', 'true');

                    let card_container = document.createElement("div");
                    card_container.setAttribute('id', list["id"]);
                    card_container.setAttribute('style', 'position:relative');

                    let check = document.createElement("input");
                    check.setAttribute("type", "checkbox");

                    let setting = document.createElement("i");
                    setting.setAttribute('class', 'fas fa-edit no-click btn-sm btn-dark p-2 edit-card');
                    setting.setAttribute('id', list["id"]);
                    setting.setAttribute('style', 'right: 0; position: absolute;');
                    setting.dataset.toggle = 'popover';
                    setting.setAttribute('tabindex', 0);
                    setting.dataset.html = 'true';
                    setting.dataset.trigger = 'focus';

                    getCards(card, drag_item, setting, list["id"], check);
                    card_body.appendChild(card_container);
                    card_container.appendChild(setting);
                    card_container.appendChild(drag_item);
                    card_container.appendChild(check);
                });

                // Cards

                let abbr = document.createElement("abbr");
                abbr.setAttribute('title', 'Tambah Topik Baru');
                abbr.setAttribute('id', list["id"]);
                abbr.dataset.toggle = 'modal';
                abbr.dataset.target = '#newCard';

                let card_footer = document.createElement("div");
                card_footer.setAttribute('class', 'card-footer');

                let icon_card = document.createElement("i");
                icon_card.setAttribute('class', 'fas fa-plus');
                let icon_desc = '&nbsp;&nbsp;Tambah Topik Baru';

                cont.appendChild(col3);
                col3.appendChild(card);
                card.appendChild(card_header);
                card_header.appendChild(i_header);
                card_header.innerHTML += i_after;
                card_header.appendChild(span);
                span.appendChild(popover);
                card.appendChild(card_body);
                card.appendChild(abbr);
                abbr.appendChild(card_footer);
                card_footer.appendChild(icon_card);
                card_footer.innerHTML += icon_desc;
            });

            $(function () {
                $('[data-toggle="popover"]').popover()
            });

            $('.popover-dismiss').popover({
                trigger: 'focus'
            });

            $('[data-toggle="popover"]').on('shown.bs.popover', onPopoverHtmlLoad);

            function onPopoverHtmlLoad() { popoverFunctions() }

            const fills = document.querySelectorAll(".dragItem");
            const empties = document.querySelectorAll(".card-body");
            const modals = document.querySelectorAll("[data-toggle='modal']");
            let element, lastElement;

            fills.forEach((fill) => {
                fill.addEventListener("dragstart", dragStart);
                fill.addEventListener("dragend", dragEnd);
                fill.addEventListener("click", getCardData);
            });

            empties.forEach((empty) => {
                empty.addEventListener("dragover", dragOver);
                empty.addEventListener("dragenter", dragEnter);
                empty.addEventListener("dragleave", dragLeave);
                empty.addEventListener("drop", drop);
            });

            modals.forEach((modal) => {
                modal.addEventListener('click', () => {
                    $("#card_id").val(modal.id);
                });
            });

            function getCardData(e) {
                load(1);
                let formData = new FormData;
                formData.append("id", e.srcElement.id);
                $.ajax({
                    url: domain+'/action/get-card-data',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        refreshCard(e.srcElement.id);
                    }
                });
            }

            function dragStart(e) {
                this.className += " hold";
                setTimeout(() => {
                    this.className = "inv"
                }, 0);
                element = e.srcElement;
                lastElement = e.srcElement.parentElement;
                $('.edit-card').hide();
                $('.checked').hide();
            }

            function dragEnd() {
                this.className = "dragItem";
                $('.edit-card').show();
                $('.checked').show();
            }

            function dragOver(e) {
                e.preventDefault();
            }

            function dragEnter(e) {
                e.preventDefault();
                if (this.classList.contains("card-body")) {
                    this.className += " hovered";
                }
            }

            function dragLeave() {
                this.className = "card-body";
            }

            function drop(e) {
                $('.edit-card').show();
                $('.checked').show();
                this.className = "card-body";
                let list = this;
                let formData = new FormData;
                let lastid = list.id;
                formData.append("idList", list.id);
                formData.append("idCard", element.id);
                formData.append("idLastList", lastElement.id);
                $.ajax({
                    url: domain+'/action/move-card',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        async function erase() {
                            $("#lists").html("");
                        }
                        erase().then(getLists());
                    }
                });
            }
            load(0);
        }
    });
}

function searchProjects(e) {
    e.preventDefault();
    $("#alert-message").hide();
    let cont = document.querySelector("#lists");
    let formData = new FormData;
    formData.append("data", $("#search").val());
    load(1);
    $.ajax({
        url: domain+'/action/get-lists',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            if (!data.response) {
                mess("alert-danger", `Projek <strong>${data.title}</strong> Tidak Ditemukan`);
                load(0);
                return false;
            }
            let allList = data.response.allList;
            $("#lists").html("");
            $("#titlePage").html(data.title);

            let col_newlist = document.createElement("div");
            col_newlist.setAttribute('class', 'col col-3');

            let abbr_newlist = document.createElement("abbr");
            abbr_newlist.setAttribute('title', 'Tambah Grup Topik');

            let btn_newlist = document.createElement("div");
            btn_newlist.setAttribute('class', 'btn btn-dark w-100 shadow');
            btn_newlist.dataset.toggle = 'modal';
            btn_newlist.dataset.target = '#newList';

            let i_newlist = document.createElement("i");
            i_newlist.setAttribute('class', 'fas fa-plus');
            let i_newlist_desc = '&nbsp;&nbsp;Tambah Grup Topik';

            cont.appendChild(col_newlist);
            col_newlist.appendChild(abbr_newlist);
            abbr_newlist.appendChild(btn_newlist);
            btn_newlist.appendChild(i_newlist);
            btn_newlist.innerHTML += i_newlist_desc;
            
            allList.forEach((list) => {
                let cards = list.id_card.split("|");
                cards.pop();

                let col3 = document.createElement("div");
                col3.setAttribute('class', 'data col col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3');

                let card = document.createElement("div");
                card.setAttribute('class', 'card shadow position-relative');
                // card.setAttribute('class', 'card shadow');

                let card_header = document.createElement("div");
                card_header.setAttribute('class', 'card-header card-title pt-5');

                let i_header = document.createElement("i");
                // i_header.setAttribute('class', 'far fa-clipboard');
                let i_after = list["title"];

                let span = document.createElement("span");
                span.setAttribute('class', 'float-right block bg-dark w-100 position-absolute text-muted');
                span.setAttribute('style', 'right:0px;top:0px');

                let popover = document.createElement("i");
                // Role = button
                popover.setAttribute('class', 'fas fa-sliders-h no-click btn-sm ml-1 btn btn-dark p-2');
                popover.dataset.toggle = 'popover';
                popover.dataset.placement = 'left';
                popover.setAttribute('title', "<i class='fas fa-cog'>&nbsp;&nbsp;Pengaturan");
                popover.setAttribute('tabindex', 0);
                popover.dataset.html = 'true';
                popover.dataset.trigger = 'focus';
                popover.dataset.content = "<div id='" + list["id"] + "@|#" + list["title"] + "' class='editList mb-2 btn-sm w-100 btn btn-dark'><i class='fas fa-pencil-alt'></i>&nbsp;&nbsp;Edit</div><br><div id='" + list["id"] + "' class='deleteList btn-sm w-100 btn btn-dark' id='list'><i class='fas fa-eraser'></i>&nbsp;&nbsp;Hapus</div>";

                let card_body = document.createElement("div");
                card_body.setAttribute('class', 'card-body');
                card_body.setAttribute('id', list["id"]);

                // Cards

                cards.forEach((card) => {
                    let drag_item = document.createElement("div");
                    drag_item.setAttribute('class', 'dragItem');
                    drag_item.setAttribute('draggable', 'true');

                    let card_container = document.createElement("div");
                    card_container.setAttribute('id', list["id"]);
                    card_container.setAttribute('style', 'position:relative');

                    let check = document.createElement("input");
                    check.setAttribute("type", "checkbox");

                    let setting = document.createElement("i");
                    setting.setAttribute('class', 'fas fa-edit no-click btn-sm btn-dark p-2 edit-card');
                    setting.setAttribute('id', list["id"]);
                    setting.setAttribute('style', 'right: 0; position: absolute;');
                    setting.dataset.toggle = 'popover';
                    setting.setAttribute('tabindex', 0);
                    setting.dataset.html = 'true';
                    setting.dataset.trigger = 'focus';

                    getCards(card, drag_item, setting, list["id"], check);
                    card_body.appendChild(card_container);
                    card_container.appendChild(setting);
                    card_container.appendChild(drag_item);
                    card_container.appendChild(check);
                });

                // Cards

                let abbr = document.createElement("abbr");
                abbr.setAttribute('title', 'Tambah Topik Baru');
                abbr.setAttribute('id', list["id"]);
                abbr.dataset.toggle = 'modal';
                abbr.dataset.target = '#newCard';

                let card_footer = document.createElement("div");
                card_footer.setAttribute('class', 'card-footer');

                let icon_card = document.createElement("i");
                icon_card.setAttribute('class', 'fas fa-plus');
                let icon_desc = '&nbsp;&nbsp;Tambah Topik Baru';

                cont.appendChild(col3);
                col3.appendChild(card);
                card.appendChild(card_header);
                card_header.appendChild(i_header);
                card_header.innerHTML += i_after;
                card_header.appendChild(span);
                span.appendChild(popover);
                card.appendChild(card_body);
                card.appendChild(abbr);
                abbr.appendChild(card_footer);
                card_footer.appendChild(icon_card);
                card_footer.innerHTML += icon_desc;
            });

            $(function () {
                $('[data-toggle="popover"]').popover()
            });

            $('.popover-dismiss').popover({
                trigger: 'focus'
            });

            $('[data-toggle="popover"]').on('shown.bs.popover', onPopoverHtmlLoad);

            function onPopoverHtmlLoad() { popoverFunctions() }

            const fills = document.querySelectorAll(".dragItem");
            const empties = document.querySelectorAll(".card-body");
            const modals = document.querySelectorAll("[data-toggle='modal']");
            let element, lastElement;

            fills.forEach((fill) => {
                fill.addEventListener("dragstart", dragStart);
                fill.addEventListener("dragend", dragEnd);
                fill.addEventListener("click", getCardData);
            });

            empties.forEach((empty) => {
                empty.addEventListener("dragover", dragOver);
                empty.addEventListener("dragenter", dragEnter);
                empty.addEventListener("dragleave", dragLeave);
                empty.addEventListener("drop", drop);
            });

            modals.forEach((modal) => {
                modal.addEventListener('click', () => {
                    $("#card_id").val(modal.id);
                });
            });

            function getCardData(e) {
                load(1);
                let formData = new FormData;
                formData.append("id", e.srcElement.id);
                $.ajax({
                    url: domain+'/action/get-card-data',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        refreshCard(e.srcElement.id);
                    }
                });
            }

            function dragStart(e) {
                this.className += " hold";
                setTimeout(() => {
                    this.className = "inv"
                }, 0);
                element = e.srcElement;
                lastElement = e.srcElement.parentElement;
                $('.edit-card').hide();
                $('.checked').hide();
            }

            function dragEnd() {
                this.className = "dragItem";
                $('.edit-card').show();
                $('.checked').show();
            }

            function dragOver(e) {
                e.preventDefault();
            }

            function dragEnter(e) {
                e.preventDefault();
                if (this.classList.contains("card-body")) {
                    this.className += " hovered";
                }
            }

            function dragLeave() {
                this.className = "card-body";
            }

            function drop(e) {
                $('.edit-card').show();
                $('.checked').show();
                this.className = "card-body";
                let list = this;
                let formData = new FormData;
                let lastid = list.id;
                formData.append("idList", list.id);
                formData.append("idCard", element.id);
                formData.append("idLastList", lastElement.id);
                $.ajax({
                    url: domain+'/action/move-card',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        async function erase() {
                            $("#lists").html("");
                        }
                        erase().then(getLists());
                    }
                });
            }
            load(0);
        },
        error : (data) => {
            mess("alert-danger", `Projek <strong>${$("#search").val()}</strong> Tidak Ditemukan`);
            load(0);
            return false;
        }
    });
}