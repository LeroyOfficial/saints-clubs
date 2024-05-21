$("#password").on("input", function() {
    $('#password_confirmation').val($(this).val());
});