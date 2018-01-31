$(document).ready(function () {
    $('#schimbareculori').on('submit', function (event) {
        event.preventDefault();
        var formData = {
            "pagebackground": $("#pagebackground").val(),
            "headerbar": $('#headerbar').val(),
            "latestapptext": $('#latestapptext').val(),
            "lastappbtn": $('#lastappbtn').val(),
            "newappborder": $('#newappborder').val(),
            "newappbtn": $('#newappbtn').val(),
            "footercolor": $('#footercolor').val(),
            "containercolor": $("#containercolor").val(),
            "containerinside": $("#containerinside").val()
        };

// process the form
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'changecolors',
            data: formData,
            beforeSend: function () {
                console.log(formData);
            },

            success: function (data) {
                $("#mess").append("<div id='succesmsg' class='alert alert-success response-msg'>" + data['msg'] + "</div>");

                setTimeout(function () {
                    $('#succesmsg').fadeOut('slow', function () {
                        $('#succesmsg').remove();
                    });

                }, 2000);

            },

            error: function () {

            }
        });
        return false;
    });
});
