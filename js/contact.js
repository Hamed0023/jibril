$(function() {
    var form = $('#ajax_form');
    var formMessages = $('#form-messages');

    $(form).submit(function(event) {
        event.preventDefault();

        var formData = $(form).serialize();

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        .done(function(response) {
            $(formMessages).removeClass('alert-danger').addClass('alert-success');
            $(formMessages).text(response);

            // Clear the form
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#website').val('');
        })
        .fail(function(data) {
            $(formMessages).removeClass('alert-success').addClass('alert-danger');

            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occurred and your message could not be sent.');
            }
        });
    });
});
