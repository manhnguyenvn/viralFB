$(document).ready(function () {
    $('#share-link, #share-link-modal').on('click', function (event) {
        event.preventDefault();
        var $body = $("body");
        var formData = {
            "appname": $body.data("appname"),
            "fbid": $body.data("fbid"),
            "name": $body.data("name")
        };

// process the form
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: 'sharecount',
            data: formData,
            beforeSend: function () {
                console.log(formData);
            },

            success: function (data) {
                console.log(data.msg);
            },

            error: function () {

            }
        });
        return false;
    });
});
