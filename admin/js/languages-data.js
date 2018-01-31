$(function () {
    var newlang = $("#new-lang").html(),
        accordionlang = $('#accordion-lang');


    $('#addlang').click(function (e) {
        e.preventDefault();
        var length = $('.language').length;
        var i = length + 1;
        accordionlang.append('<div id="language' + i + '" class="language new-lang">' + newlang + '</div>');
        $('#language'+ i +' .new-lang-buttons').append('<button class="save-new-lang btn btn-success pull-left"><b>Save language</b></button><button id="delete'+ i +'" class="delete-lang btn btn-danger pull-right"><b><i class="fa fa-trash-o" aria-hidden="true"></i> Delete language</b></button>');
        accordionlang.accordion("refresh");
        accordionlang.accordion({active: i});

        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "../admin/js/languages.js";
        $("#script-adaugat").html(s);
    });
});


$(function () {
    $("#accordion-lang").accordion({
        heightStyle: "content",
        header: ".acc"
    });
});


function dat() {
    var active = $('#active-lang').val();

    var language = $('.language'),
        limba = '',
        virgula = ',',
        forms = 0,
        lforms = language.length;

    language.each(function () {
        forms++;
        if (forms == lforms) {
            virgula = '';
        }
        var id = $(this).attr('id');
        var name = $('#' + id + ' [name="name"]').val(),
            code = $('#' + id + ' [name="code"]').val(),
            login = $('#' + id + ' [name="login"]').val(),
            share = $('#' + id + ' [name="share"]').val(),
            tryagain = $('#' + id + ' [name="tryagain"]').val(),
            latestapp = $('#' + id + ' [name="latestapp"]').val(),
            generating = $('#' + id + ' [name="generating"]').val(),
            moreapps = $('#' + id + ' [name="moreapps"]').val(),
            findmedia = $('#' + id + ' [name="findmedia"]').val(),
            backtop = $('#' + id + ' [name="backtop"]').val(),
            letsdoit = $('#' + id + ' [name="letsdoit"]').val();

        limba += '"' + code + '":{"name":"' + name
            + '","code":"' + code
            + '","login":"' + login
            + '","share":"' + share
            + '","tryagain":"' + tryagain
            + '","latestapp":"' + latestapp
            + '","generating":"' + generating
            + '","moreapps":"' + moreapps
            + '","findmedia":"' + findmedia
            + '","backtop":"' + backtop
            + '","letsdoit":"' + letsdoit + '"}' + virgula + '';
    });


    var formData = '{"active":"' + active + '", ' + limba + '}';
    //$("#arata").html(formData);
    $('[name="allvalues"]').val(formData);
}


$('#savelang').click(function () {
    dat();
    $('#active-language').submit();
});

$(document).ready(function () {
    $('#active-language').on('submit', function (event) {
        event.preventDefault();

        var formData = $('[name="allvalues"]').val();

// process the form
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $.ajax({
            type: "POST",
            url: 'languages/savelang',
            data: {allvalues: formData},
            beforeSend: function () {
                console.log(formData);
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
    });
});
