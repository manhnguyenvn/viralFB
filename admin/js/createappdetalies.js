$(document).ready(function () {
    $('#createappdetalies').on('submit', function (event) {
        event.preventDefault();
        var imgval = $('#img').val();
        if(imgval == ''){
            var msg = 'Please choose an image';
            $("#noimagealert").append("<div id='succesmsg' class='alert alert-danger response-msg'>" + msg + "</div>");

            setTimeout(function () {
                $('#succesmsg').fadeOut('slow', function () {
                    $('#succesmsg').remove();
                });

            }, 2000);
        } else {


            var formData = {
                "editid": $('body').data('editid'),
                "title": $('#title').val(),
                "description": $('#description').val(),
                "img": $('#img').val()
            };

// process the form
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $.ajax({
                type: "POST",
                url: 'savedetalies',
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

                    // other changes
                    var btnresults = $('#btnresults');
                    btnresults.removeClass('disabled');
                    btnresults.css('pointer-events', 'auto');
                    var sdetalies = $('#sdetalies');
                    sdetalies.removeClass('label-danger');
                    sdetalies.addClass('label-success');
                    sdetalies.html('Completed');
                    $('#sresults').addClass('label-danger');
                    $('#nextstepbtn').show();




                },

                error: function () {

                }
            });

            return false;
        } // if function finish
    });
});

// Other changes in page

$(function(){
        var title = $('#title').val();
        var desc =  $('#description').val();
        var img = $('#img').val();

        if(title !== '' && desc !== '' && img !== ''){

            $('#btnresults').removeClass('disabled');
            $('#btnresults').css('pointer-events', 'auto');
            var sdetalies = $('#sdetalies');
            sdetalies.removeClass('label-danger');
            sdetalies.addClass('label-success');
            sdetalies.html('Completed');
            $('#sresults').addClass('label-danger');

    }

});
