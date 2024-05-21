var candidateList = [];

// $('#candidate_list_input').val(candidateList);

$('.student').click(function() {
    let div = $(this);

    let id = $(this).find('.student_id').text();

    if (candidateList.indexOf(id) === -1) {
        candidateList.push(id);
        div.addClass('bg-primary');
        div.addClass('text-white');
      } else {
        var index = candidateList.indexOf(id);
        if (index !== -1) {
        candidateList.splice(index, 1);

            div.removeClass('bg-primary');
            div.removeClass('text-white');
        }
      }

    $('#candidate_list_input').val('['+candidateList+']');
})
