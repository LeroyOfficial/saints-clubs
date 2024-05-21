$('#chat-btn').click(function() {
    $(this).parent().find('.btn').removeClass('btn-main');
    $(this).addClass('btn-main');

    $('#tab-list .div').addClass('d-none');
    $('#chat-div').removeClass('d-none');
})

$('#members-btn').click(function() {
    $(this).parent().find('.btn').removeClass('btn-main');
    $(this).addClass('btn-main');

    $('#tab-list .div').addClass('d-none');
    $('#members-div').removeClass('d-none');
})

$('#notifications-btn').click(function() {
    $(this).parent().find('.btn').removeClass('btn-main');
    $(this).addClass('btn-main');

    $('#tab-list .div').addClass('d-none');
    $('#notifications-div').removeClass('d-none');
})

$('#events-btn').click(function() {
    $(this).parent().find('.btn').removeClass('btn-main');
    $(this).addClass('btn-main');

    $('#tab-list .div').addClass('d-none');
    $('#events-div').removeClass('d-none');
})

$('#elections-btn').click(function() {
    $(this).parent().find('.btn').removeClass('btn-main');
    $(this).addClass('btn-main');

    $('#tab-list .div').addClass('d-none');
    $('#elections-div').removeClass('d-none');
})

let messageListDiv = $('#message-list');

messageListDiv.scrollTop(messageListDiv[0].scrollHeight);

var imageinput = document.getElementById("image-input");
var preview = document.getElementById("preview");

imageinput.addEventListener("change", function(event){
    if(event.target.files.lenght == 0) {
        $('#img-preview-div').addClass('d-none');
        return;
    }
    $('#img-preview-div').removeClass('d-none');
    var tempUrl = URL.createObjectURL(event.target.files[0]);
    preview.setAttribute("src",tempUrl);
    var style = "max-width:100%; height:30vh; border-radius:10px;";
    preview.setAttribute("style", style);
})

$('#add-image-btn').click(function () {
    $('#image-input').click();
})
