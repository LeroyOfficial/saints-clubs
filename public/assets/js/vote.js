$('.student').click(function() {
    let other_candidates = $(this).parent().find('.student');

    other_candidates.removeClass('bg-primary');
    other_candidates.removeClass('text-white');

    $(this).addClass('bg-primary');
    $(this).addClass('text-white');

    let id = $(this).find('.student_id').text();

    $('#selected_candidate').val(id);
})
