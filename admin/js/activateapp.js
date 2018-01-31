$(document).ready(function () {
    $('#activateapp').on('submit', function (event) {
        event.preventDefault();

        var formData = $('#activateapp').serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'dashboard/save',
            data: formData,
            beforeSend: function () {
                console.log(formData);
                $('<img class="loaderActivate" src="files/loader.gif" style="margin-left: 30px;max-width: 40px;"/>').insertAfter(".send-form-btn");
            },

            success: function (result) {
                console.log(result);
                  $(".loaderActivate").remove();
                  if(result.success == false){
                      $('.alert-danger').show();
                      $('.alert-danger').text(result.msg);
                          setTimeout(function () {
                            $('.alert-danger').hide();
                        }, 8000);
                  }else{
                        $('.alert-success').show();
                        $('.alert-success').text(result.msg);
                          setTimeout(function () {
                            $('.alert-success').hide();
                            location.reload();
                            //$('#useractivation').fadeOut('slow');
                        }, 7000);
                  }


            },

            error: function () {
                     $('.alert-danger').show();
                      $('.alert-danger').text("Oops some error happened and the request was not made,if this happen again please contact ravgrg@gmail.com");
                          setTimeout(function () {
                            $('.alert-danger').hide();
                        }, 7000);
            }
        });
        return false;
    });
});
