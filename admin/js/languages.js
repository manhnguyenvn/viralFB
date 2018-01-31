$(function () {
    var i = 0;
    $('.language').each(function () {
        var id = $(this).attr('id');
        i++;
        $('#delete' + i).click(function () {
            $('#' + id).remove();
            $('#accordion-lang').accordion({active: i - 1});
        });
    });


    var active_lang = $('#active-lang');
    var english = $('<option value="en">English</option>');

    $('.save-new-lang').click(function () {
        $('#savelang').click();

        active_lang.empty();
        $('.new-lang').each(function () {
            var id = $(this).attr('id'),
                name = $('#' + id + ' [name="name"]').val(),
                code = $('#' + id + ' [name="code"]').val(),
                option = $('<option value="' + code + '">' + name + '</option>');
            active_lang.append(english);
            active_lang.append(option);
            $('#' + id + ' span').html(name);
        });
        return false;
    });

    $('.delete-lang').click(function () {
        active_lang.empty();
        active_lang.append(english);
        $('.new-lang').each(function () {
            var id = $(this).attr('id'),
                name = $('#' + id + ' [name="name"]').val(),
                code = $('#' + id + ' [name="code"]').val(),
                option = $('<option value="' + code + '">' + name + '</option>');

            active_lang.append(option);
        });
    });
});