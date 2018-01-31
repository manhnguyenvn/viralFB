$(function () {
    if ($('#boostrap-toogle').is(':empty')) {
        var bt = document.createElement("script");
        bt.type = "text/javascript";
        bt.src = "../admin/bootstrap-toggle/bootstrap-toggle.min.js";
        $("#boostrap-toogle").html(bt);
    }

    var datatogg = $("[data-toggle='toggle']");
    datatogg.bootstrapToggle('destroy');
    datatogg.bootstrapToggle();

    //var tm = document.createElement("script");
    //tm.type = "text/javascript";
    //tm.src = "../admin/tinymce/tinymce.min.js";
    //$("#tinymce").html(tm);


    var sortableid = $("#sortable-header, #sortable-sidebar, #sortable-under-header, #sortable-before-apps-list, #sortable-above-footer," +
        " #sortable-footer, #sortable-above-login-share, #sortable-below-login-share");
    sortableid.sortable();

    $('.widget').each(function () {
        var id = $(this).attr('id');

        $('#' + id + ' .wedit').click(function () {
            $('#' + id + ' .wcontent').show();
            sortableid.sortable("disable");
        });

        $('.wsave').on('click', function () {
            var wtitle = $('#' + id + ' #widgettitle').val();
            $('#' + id + ' .widgettitle').html(wtitle);
        });

        $('#' + id + ' .wdelete').click(function () {
            var taid = $('#' + id + ' textarea').attr('id');
            $('#' + id).remove();
            sortableid.sortable("enable");
        });

        $('#' + id + ' .wexit').click(function () {
            $('#' + id + ' .wcontent').hide();
            sortableid.sortable("enable");
        });

    });


    sortableid.sortable({
        cursor: "move",
        start: function (e, ui) {
            $(ui.item).find('textarea').each(function () {
                tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
            });
        },
        stop: function (e, ui) {
            $(ui.item).find('textarea').each(function () {
                tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
            });
        }
    });




});
