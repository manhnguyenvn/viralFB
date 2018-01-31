$(document).ready(function () {
    $('#createappset').on('submit', function (e) {
        e.preventDefault();

        var checkboxVal = '';
        if ($('#disp-media').is(":checked"))
        {
            checkboxVal = 'on';
        } else {
            checkboxVal = 'off';
        }

        var formData = {
            "editid": $('body').data('editid'),
            "fbtitle": $('#fbtitle').val(),
            "fbdescription": $('#fbdescription').val(),
            "fbimage": $('#fbimage').val(),
            "disp-media": checkboxVal,
            "mediatext": $('#mediatext').val()
        };


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'appset',
            data: formData,
            beforeSend: function () {
                console.log(formData);
            },

            success: function (response) {
                $("#mesaj").html("<div id='succesmsg' class='alert alert-success response-msg'>" + response.msg + "</div>");

                if( response.action == 'edit'){
                    console.log('Edited succesfull');
                } else {
                    $('html, body').animate({
                        scrollTop: $("#succesmsg").offset().top
                    }, 1000);

                    $('.publish').show();
                }

                setTimeout(function () {
                    $('#succesmsg').fadeOut('slow', function () {
                        $('#succesmsg').remove();
                    });

                }, 2000);

            },

            error: function () {
                alert('Error');
            }
        });
        return false;
    });
});

//Publish App
$(document).ready(function () {
    $('#publish').click(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'publish',
            beforeSend: function () {
            },

            success: function () {
                $('#myModal').modal('show');
                setTimeout(function () {
                  //  $('#myModal').modal('hide');
                    window.location.href='../list';
                }, 3000);
            },

            error: function () {
                alert('Error');
            }
        });
        return false;
    });
});
