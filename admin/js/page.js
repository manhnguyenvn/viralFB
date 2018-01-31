//save new page
$(document).ready(function () {
    $('#create-new-page').on('submit', function (event) {
        event.preventDefault();

        var wcontent = tinyMCE.get('textarea').getContent();
          //  wcontent = JSON.stringify(wcontent);
          //  wcontent = wcontent.replace('"', '');
        var formData = {
            "title": $("#title").val(),
            "url": $("input[name='url']:checked").val(),
            "custom-input": $("#custom-input").val(),
            "content": wcontent
        };

// process the form
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'add/save',
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


//delete a page

   function deletepage(id, event){

       $( "#dialog-confirm" ).dialog({
           resizable: false,
           height: "auto",
           width: 400,
           modal: true,
           buttons: {
               "Delete page": function() {
                   $( this ).dialog( "close" );

                   event.preventDefault();

                   var formData = {
                       "id": id
                   };

// process the form
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });

                   $.ajax({
                       type: "POST",
                       url: 'delete',
                       data: formData,
                       beforeSend: function () {
                           console.log(formData);
                       },

                       success: function () {
                           $('#myModal').modal('show');
                           setTimeout(function () {
                               $('#myModal').modal('hide');
                           }, 3000);

                           $('#page' + id).remove();

                       },

                       error: function () {

                       }
                   });
                   return false;

               },
               Cancel: function() {
                   $( this ).dialog( "close" );
               }
           }
       });

    }


