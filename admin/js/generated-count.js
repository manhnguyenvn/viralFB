 function generatedCount() {

        var formData = {
            "action": "count-generated"
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: 'generated-count',
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
    }
