$(document).ready(function () {
    $('#doUpdate').on('submit', function (event) {
        event.preventDefault();

        var formData = $('#doUpdate').serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'update/makeupdate',
            data: formData,
            beforeSend: function () {
                console.log(formData);
            },

            success: function (response) {
                console.log(response);
                $('#myModal').modal('show');
                setTimeout(function () {
                    $('#myModal').modal('hide');
                }, 3000);

            },

            error: function () {

            }
        });
        return false;
    });
});
