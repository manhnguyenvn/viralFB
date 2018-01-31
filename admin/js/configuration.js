$(document).ready(function () {
    $('#site-main-configuration').on('submit', function (event) {
        event.preventDefault();

        var formData = $('#site-main-configuration').serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'configuration/save',
            data: formData,
            beforeSend: function () {
                console.log(formData);
            },

            success: function () {
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
