//save all widgets
$('#save-all').click(function (event) {
    event.preventDefault();

    var allWidgetsData = '',
        nrwpos = $('.wpos').length;
    $('.wpos').each(function (index) {
        var index = index + 1,
            wposId = $(this).attr('wpos');

        var widgetData = '',
            widgetsInPosition = $('.widget-' + wposId).length;
        $('.widget-' + wposId).each(function (nrwidgets) {
            var nrwidgets = nrwidgets + 1,
                id = $(this).attr('id'),
                taid = $('#' + id + ' textarea').attr('id');

            if (document.getElementById(id) !== null) {
                var wtitle = $('#' + id + ' #widgettitle').val(),
                    wcontent = tinyMCE.get(taid).getContent();
                wcontent = JSON.stringify(wcontent);
                var wtitledisplay;
                if ($('#' + id + ' .disp-title').prop("checked") == true) {
                    wtitledisplay = 'on';
                } else {
                    wtitledisplay = 'off';
                }
                var activeapps;
                if ($('#' + id + ' .active-apps-imp').prop("checked") == true) {
                    activeapps = 'on';
                } else {
                    activeapps = 'off';
                }
                var activehome;
                if ($('#' + id + ' .active-home-imp').prop("checked") == true) {
                    activehome = 'on';
                } else {
                    activehome = 'off';
                }

                var virg = ',';
                if(nrwidgets == widgetsInPosition){
                    virg = '';
                }

                widgetData += '"' + id + '":{"wtitle":"' + wtitle + '","wcontent":' + wcontent + ',"wtitledisplay":"' + wtitledisplay +
                    '","activeapps":"' + activeapps + '","activehome":"' + activehome + '"}'+ virg +'';
            }

        }); //each widget

        var virg = ',';
        if(index == nrwpos){
            virg = '';
        }

        allWidgetsData += '"'+ wposId +'":{'+ widgetData +'}'+ virg +'';

    }); //each position

    var alldata = '{'+ allWidgetsData +'}';



    //send data to server
   // $('#active-language').on('submit', function (event) {



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
            type: "POST",
            url: 'widgets/save',
            data: {allvalues: alldata},
            beforeSend: function () {
                console.log(alldata);
            },

            success: function (data) {
                $('#active-name').html(data['activename']);

                $('#myModal').modal('show');
                setTimeout(function () {
                    $('#myModal').modal('hide');
                }, 3000);

            },

            error: function () {

            }
        });
        return false;
  //  });
});
