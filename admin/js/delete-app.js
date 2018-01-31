function deleteapp(id, event){

    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Delete App": function() {
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

