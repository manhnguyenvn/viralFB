//accordion
$(function () {
    $("#accordionn").accordion({
        heightStyle: "content",
        header: ".acc"
    });
});


$(function () {
    //  $(window).resize(function(){
    // setInterval(function(){
    // sizes();
    //   },100);

    function repeatOften() {
        sizes();
        requestAnimationFrame(repeatOften);
    }

    requestAnimationFrame(repeatOften);
    //  });

});

var originalmainwidth = Math.round($('#basic-image').width());

function sizes() {
    $('.appended').each(function () {
        var idlayer = $(this).parent().attr('id'),

            positionp = $("#" + idlayer).position(),
            topp = Math.round(positionp.top),
            left = Math.round(positionp.left),
            width = Math.round($("#" + idlayer).width()),
            height = Math.round($("#" + idlayer).height()),

            mainwidth = Math.round($('#basic-image').width()),
            mainheight = Math.round($('#basic-image').height()),
            widthpr = Math.round(width / mainwidth * 100),
            heightpr = Math.round(height / mainheight * 100),

            topppr = Math.round(topp / mainheight * 100),
            leftpr = Math.round(left / mainwidth * 100);

        $("#" + idlayer).css({
            'top': topppr + '%',
            'left': leftpr + '%',
            'width': widthpr + '%',
            'height': heightpr + '%'
        });
    });

    //text positioning / values
    $('.appended-text').each(function () {
        var idlayer = $(this).attr('id');
        var layer = $("#" + idlayer),
            positionp = layer.position(),
            topp = Math.round(positionp.top),
            left = Math.round(positionp.left),
            chlayer = layer.children(),
            ofsize = chlayer.css('font-size'),
            origfontsize = ofsize.replace('px', ''),

            mainwidth = Math.round($('#basic-image').width()),
            mainheight = Math.round($('#basic-image').height()),

            topppr = Math.round(topp / mainheight * 100),
            leftpr = Math.round(left / mainwidth * 100),

            fontsize = Math.round(origfontsize * mainwidth / originalmainwidth);
        //console.log(fontsize);


        layer.css({
            'top': topppr + '%',
            'left': leftpr + '%'
        });

    });


}


// editor drag resize functions
$(function () {
    $(".draggable").draggable({
        cursor: "move",
        delay: 100,
        scroll: false,
        containment: "parent"
    });


});


$(function () {
    $(".resizable").resizable({
        containment: "parent"
    });
});



// store data
$(function () {
    $("#store").click(function () {
        createJSON();
        // $('#create-image').submit();
    });
});

function createJSON() {
    var result = '';
    var nrl = 0;
    var elemente = $(".main .appended").length;
    var elementetext = $(".main .appended-text").length;
    $('.appended').each(function () {
        var idlayer = $(this).parent().attr('id');
        var imgsrc = $(this).attr('src');
        
        //original sizes
        var positionp = $("#" + idlayer).position(),
            topi = Math.round(positionp.top),
            lefti = Math.round(positionp.left),
            width = Math.round($("#" + idlayer).width()),
            height = Math.round($("#" + idlayer).height()),
            disporder = $("#" + idlayer).css('z-index'),


            mainwidth = Math.round($('#basic-image').width()),
            mainheight = Math.round($('#basic-image').height()),

        //sizes for 850 px ( 850 x 446 - FB share image aspect ratio)
            prestabilied_width = 850,
            prestabilied_height = 446,

            layer_top = prestabilied_height * topi / mainheight,
            layer_top = Math.round(layer_top),
            layer_left = prestabilied_width * lefti / mainwidth,
            layer_left = Math.round(layer_left),

            layer_width = prestabilied_width * width / mainwidth,
            layer_width = Math.round(layer_width),
            layer_height = prestabilied_height * height / mainheight,
            layer_height = Math.round(layer_height);
        nrl++;

        var virgula = '';
        if (nrl == elemente && elementetext == 0) {
            virgula = '';
        } else {
            virgula = ',';
        }

        result += '"layer' + nrl + '":[{'
            + '"idlayer":"' + idlayer + '",'
            + '"imgsrc":"' + imgsrc + '",'
            + '"top":"' + layer_top + '",'
            + '"left":"' + layer_left + '",'
            + '"width":"' + layer_width + '",'
            + '"height":"' + layer_height + '",'
            + '"disporder":"' + disporder + '"'
            + '}]' + virgula + '';

    }); // finish each function


    // text values function
    var textresult = '';
    var nrl = 0;
    $('.appended-text').each(function () {
        var idlayer = $(this).attr('id');

        //original sizes
        var layer = $("#" + idlayer);
        var positionp = layer.position(),
            topi = Math.round(positionp.top),
            lefti = Math.round(positionp.left),
            dispordertxt = layer.css('z-index'),

            mainwidth = Math.round($('#basic-image').width()),
            mainheight = Math.round($('#basic-image').height()),

        //sizes for 850 px ( 850 x 446 - FB share image aspect ratio)
            prestabilied_width = 850,
            prestabilied_height = 446,

            layer_top = prestabilied_height * topi / mainheight,
            layer_top = Math.round(layer_top),
            layer_left = prestabilied_width * lefti / mainwidth,
            layer_left = Math.round(layer_left),

        //another css text information
            chlayer = layer.children(),
            text_default = chlayer.prop('innerHTML'),
            text = text_default.replace("\u200C", "").replace(/&nbsp;/g, ' '),
            font = chlayer.css('font-family'),
            color = chlayer.css('color'),
            size = chlayer.css('font-size'),
            origfontsize = size.replace('px', ''),
            fontsize = Math.round(850 * origfontsize / mainwidth),
            angle = 0;


        nrl++;

        var virgula = '';
        if (nrl == elementetext) {
            virgula = '';
        } else {
            virgula = ',';
        }

        textresult += '"layertext' + nrl + '":[{'
            + '"idlayer":"' + idlayer + '",'
            + '"top":"' + layer_top + '",'
            + '"left":"' + layer_left + '",'
            + '"text":"' + text + '",'
            + '"font":"' + font + '",'
            + '"color":"' + color + '",'
            + '"size":"' + fontsize + '",'
            + '"angle":"' + angle + '",'
            + '"disporder":"' + dispordertxt + '"'
            + '}]' + virgula + '';

    });
    //finish text values function


    result = '{' + result + textresult + '}';

    $('.hiddenfield').val(result);


    /*------------------------------   View JSON with sizes    ---------------------------------
    $("#result").html(result); */


}


$(function () {
    function timer() {
        setTimeout(timer, 2000);
        var nrlayers = $('#layers .alert').length;
        if (nrlayers < 1) {
            $('#layers').append('<div id="nothing" class="alert alert-danger" style="padding: 5px;">No layers added.</div>');
        }
    }

    timer();
});



$(function () {
    requestAnimationFrame(repeatOften);
});

function repeatOften() {
    var nrlayers = $('.appended').length;
    var nrtextlayers = $('.appended-text').length;
    if (nrlayers || nrtextlayers > 0) {
        $('.nolayers').remove();
        cancelAnimationFrame(repeatOften);
    }
    requestAnimationFrame(repeatOften);
}


//chage position on sort
$(function (event) {
    displayOrder(event);
    $('.sort').css('cursor', 'move');
    $("#layers").sortable({
        stop: function (event, ui) {
            displayOrder(event);
        }
    });
});

function displayOrder(event) {
    event.preventDefault;
    $($("#layers .sort").get().reverse()).each(function (index) {
        var id = $(this).attr("idtotal");
        $(".main").find('.' + id).css('z-index', index);
    });
}



//text variables functions

$(function () {
    $('.appended-text').each(function () {
        var index = $(this).attr('index');
        var id = $(this).attr('id');

        var child = $('#' + id).children();
        child = child.attr('class');
        child = $('.' + child);
        $(child).on('mousedown', function () {
            newText(child, index);
        });
    });
});


function repeatsz() {
    $('.appended-text').each(function () {
        var index = $(this).attr('index');
        var size = $('body').data('size' + index),
            origfontsize = size.replace('px', ''),
            mainwidth = Math.round($('#basic-image').width()),
            fontsize = origfontsize * mainwidth / originalmainwidth;

        $('.added-text' + index).css('font-size', fontsize + 'px');
    });
    requestAnimationFrame(repeatsz);

}

function newText(child, index) {
    $('.text-input').attr('id', 'text-input' + index);
    $('.font-input').attr('id', 'font-input' + index);
    $('.color-input').attr('id', 'color-input' + index);
    $('.fontsize-input').attr('id', 'fontsize-input' + index);
    $('.border-color-input').attr('id', 'border-color-input' + index);
    $('.bordersize-input').attr('id', 'bordersize-input' + index);
    var template = $('#text-edit-template').html();
    $('#text-editor').empty().html(template);

    var textInput = $('#text-input' + index),
        fontInput = $('#font-input' + index);

    var textval = child.html().replace(/<br\s?\/?>/g,"\n").replace(/&nbsp;/g, ' '),
        fontval = child.css('font-family'),
        colorval = child.css('color'),
        fontsizevaldef = child.css('font-size'),
        fontsizeval = fontsizevaldef.replace('px', '');
    textInput.val(textval);
    fontInput.val(fontval);
    $('#color-input' + index).val(colorval);
    $('#fontsize-input' + index).val(fontsizeval);


    textInput.keyup(function (event) {
        var text = $('#text-input' + index).val().replace(/\r\n|\r|\n/g,"<br>").replace(/ /g, '\u00a0');
        child.html(text);
        if (event.which == 8) {
            event.preventDefault();
            var pt = textInput.val();
            if(pt.length  == 0){
                textInput.val($("<div>").html(pt + "&zwnj;").text());
                child.html(textInput.val());
            }
        }
    });

    var font;
    font = fontInput.val();
    $('#font-face' + index).html('@font-face {font-family: "' + font + '"; src: url("../../../admin/fontsttf/' + font + '.ttf");}');
    fontInput.change(function () {
        font = $(this).val();
        $('#font-face' + index).html('@font-face {font-family: "' + font + '"; src: url("../../../admin/fontsttf/' + font + '.ttf"); }');
    });

    var originalmainwidth = Math.round($('#basic-image').width());

    function repeatOften() {
        var color = $('#color-input' + index).val(),
            size = $('#fontsize-input' + index).val(),
            bordersize = $('#bordersize-input' + index).val(),
            bordercolor = $('#border-color-input' + index).val(),
            origfontsize = size.replace('px', ''),
            mainwidth = Math.round($('#basic-image').width()),
            fontsize = origfontsize * mainwidth / originalmainwidth,


            style = "font-family:" + font + "; color:" + color + "; font-size:" + fontsize + "px;  -webkit-text-stroke:" + bordersize + "px " + bordercolor;

        $('.added-text' + index).attr('style', style);

        $('body').data('size' + index, size);

        requestAnimationFrame(repeatOften);
    }

    requestAnimationFrame(repeatOften);
    requestAnimationFrame(repeatsz);

}


// show next step button
$(function () {
    function timer() {
        setTimeout(timer, 5000);
        var num = $('#accordionn .acc').length;
        if (num >= 2) {
            $('.nextstep').show();
            $('#btnappset').removeClass('disabled');
            $('#btnappset').css('pointer-events', 'auto');

            var sresults = $('#sresults');
            sresults.removeClass('label-danger');
            sresults.addClass('label-success');
            sresults.html('Completed');
            $('#sappset').addClass('label-danger');
        }
    }

    timer();
});
