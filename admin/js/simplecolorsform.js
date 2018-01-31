$(document).ready(function () {
    $('#schimbareculori').on('submit', function (event) {
        event.preventDefault();
        var mainColor = $('#maincolor').val(),
            containerColor = $("#containercolor").val();
        var formData = {
            "pagebackground": $("#pagebackground").val(),
            "headerbar": mainColor,
            "latestapptext": mainColor,
            "lastappbtn": mainColor,
            "newappborder": mainColor,
            "newappbtn": mainColor,
            "footercolor": mainColor,
            "containercolor": containerColor,
            "containerinside": containerColor
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
                $("#mesaj").append("<div id='succesmsg' class='alert alert-success response-msg'>" + data['msg'] + "</div>");

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
