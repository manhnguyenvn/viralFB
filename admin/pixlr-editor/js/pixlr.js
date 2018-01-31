var myVar = true;
var pixlr = (function () {
    /*
     * IE only, size the size is only used when needed
     */
    function windowSize() {
        var w = 0,
            h = 0;
        if (document.documentElement.clientWidth !== 0) {
            w = document.documentElement.clientWidth;
            h = document.documentElement.clientHeight;
        } else {
            w = document.body.clientWidth;
            h = document.body.clientHeight;
        }
        return {
            width: w,
            height: h
        };
    }

    function extend(object, extender) {
        for (var attr in extender) {
            if (extender.hasOwnProperty(attr)) {
                object[attr] = extender[attr] || object[attr];
            }
        }
        return object;
    }

    function buildUrl(opt) {
        var url = 'http://pixlr.com/' + opt.service + '/?s=c', attr;
        for (attr in opt) {
            if (opt.hasOwnProperty(attr) && attr !== 'service') {
                url += "&" + attr + "=" + escape(opt[attr]);
            }
        }
        return url;
    }
    var bo = {
        ie: window.ActiveXObject,
        ie6: window.ActiveXObject && (document.implementation !== null) && (document.implementation.hasFeature !== null) && (window.XMLHttpRequest === null),
        quirks: document.compatMode === 'BackCompat' },
        return_obj = {
            settings: {
                'service': 'editor'
            },
            overlay: {
                show: function (options) { 
                    var opt = extend(return_obj.settings, options || {}),
                        iframe = document.createElement('iframe'),
                        div = pixlr.overlay.div = document.createElement('div'),
                        but = pixlr.overlay.but = document.createElement('button'),
                        minbut = pixlr.overlay.but = document.createElement('button'),
                        idiv = pixlr.overlay.idiv = document.createElement('div');
                   

                    div.style.background = '#696969';
                    div.style.opacity = 0.8;
                    div.style.filter = 'alpha(opacity=80)';
                    div.id = 'overlay_div';
                    idiv.id = 'iframe_div';
                    idiv.style.position = 'relative';
                    
                   
                    var t = document.createTextNode("X ");
                    but.appendChild(t);


                    but.id = 'close-pixlr';
                    but.style.width = '25px';
                    but.style.top = '-14px';
                    but.style.right = '-10px';
                    but.style.position = 'absolute';
                    but.style.border = '1px solid red';
                    but.style.borderRadius = '30%';
                    but.style.backgroundColor = 'red';
                    but.style.color = 'white';
                   //minimize button
                    var min = document.createTextNode("_");
                    minbut.appendChild(min);



                    minbut.style.width = '25px';
                    minbut.style.top = '-14px';
                    minbut.style.right = '18px';
                    minbut.style.position = 'absolute';
                    minbut.style.border = '1px solid blue';
                    minbut.style.borderRadius = '30%';
                    minbut.style.backgroundColor = 'blue';
                    minbut.style.color = 'white';
                  
                    
                    but.onclick = function() {
                        setTimeout(function(){
                            myVar = false;
                        },7000);
                    	$(document).find("#overlay_div").remove();
                    	$(document).find("#iframe_div").remove();
                        $('#display-pixlr').hide();
                        $('.pix-bt').show();
                    };

                    minbut.onclick = function() {
                        setTimeout(function(){
                            myVar = false;
                        },7000);
                        $("#overlay_div").hide();
                        $('#display-pixlr').show().attr('displayed', 'on');
                        $('#iframe_div').css('visibility', 'hidden');
                        $('.pix-bt').hide();

                    };

                    $('#display-pixlr').click(function(){
                        $("#overlay_div").show();
                        $('#iframe_div').css('visibility', 'visible')
                    });
                    
                    

                    if ((bo.ie && bo.quirks) || bo.ie6) {
                        var size = windowSize();
                        div.style.position = 'absolute';
                        div.style.width = size.width + 'px';
                        div.style.height = size.height + 'px';
                        div.style.setExpression('top', "(t=document.documentElement.scrollTop||document.body.scrollTop)+'px'");
                        div.style.setExpression('left', "(l=document.documentElement.scrollLeft||document.body.scrollLeft)+'px'");
                    } else {
                        div.style.width = '100%';
                        div.style.height = '100%';
                        div.style.top = '0';
                        div.style.left = '0';
                        div.style.position = 'fixed';
                    }
                    div.style.zIndex = 99998;

                    idiv.style.border = '1px solid #2c2c2c';
                    if ((bo.ie && bo.quirks) || bo.ie6) {
                        idiv.style.position = 'absolute';
                        idiv.style.setExpression('top', "25+((t=document.documentElement.scrollTop||document.body.scrollTop))+'px'");
                        idiv.style.setExpression('left', "35+((l=document.documentElement.scrollLeft||document.body.scrollLeft))+'px'");
                    } else {
                        idiv.style.position = 'fixed';
                        idiv.style.top = '25px';
                        idiv.style.left = '35px';
                    }
                    idiv.style.zIndex = 99999;

                    document.body.appendChild(div);
                    document.body.appendChild(idiv);
                    
                    
                    
                    
                    
                    //document.body.appendChild("<button>Remove</button>");

                    iframe.style.width = (div.offsetWidth - 70) + 'px';
                    iframe.style.height = (div.offsetHeight - 50) + 'px';
                    iframe.style.border = '1px solid #b1b1b1';
                    iframe.style.backgroundColor = '#606060';
                    iframe.style.display = 'block';
                    iframe.frameBorder = 0;
                    iframe.src = buildUrl(opt);
                    idiv.appendChild(but);
                    idiv.appendChild(minbut);
                    idiv.appendChild(iframe);
                },
                hide: function (callback) {
                	
                    if (pixlr.overlay.idiv && pixlr.overlay.div) {
                        document.body.removeChild(pixlr.overlay.idiv);
                        document.body.removeChild(pixlr.overlay.div);
                    }
                    if (callback) {
                        eval(callback);
                    }
                }
            },
            url: function(options) {
           
                return buildUrl(extend(return_obj.settings, options || {}));
            },
            edit: function (options) {
            	
                var opt = extend(return_obj.settings, options || {});
                location.href = buildUrl(opt);
            }
        };  
    return return_obj;
    //finish pixlr


}());



$(function () {
    $('.open-pixlr, #display-pixlr').click(function(){
        myVar = true;
        function loadpixlr() {
            $.ajaxSetup ({
                cache: false
            });

            $.ajax({
                url: 'results/pixlr-load',

                success: function (data) {
                    var lungime = $('.main .appendedpixlr').length;
                    var i = lungime + 1;

                    if(typeof data.pixlrimage !== 'undefined') {
                        if (data.pixlrimage !== 'none') {
                            appendimage(data.pixlrimage, lungime, i);
                        }

                    }
                },
                complete: function(){
                   if(myVar == true){
                       setTimeout(function(){
                           loadpixlr();
                       },2000);
                   }
                }
            });
        }

        //setInterval(function () {
        //    loadpixlr();
        //}, 2000);
        loadpixlr();
        //function foo() {
        //    myVar = setTimeout(foo, 2000);
        //    loadpixlr();
        //}
        //foo();



        function appendimage(image, lungime, i) {
            var body = $('body'),
                numarDeLayereTotal = body.data('numarDeLayere'),
                numarDeLayere = numarDeLayereTotal + 1;
            body.data('numarDeLayere', numarDeLayere);

            $(".main").append("<div id='pixlr" + i + "' class='layer" + numarDeLayere +" resizable draggable' style='position: absolute; top:0%; left:0%; width:100%; height:100%;'><img class='appended appendedpixlr' style='width:100%; height:100%;' src='"+ image +"'></div> ");


            $("#nothing").remove();
            $("#layers").prepend("<div id='layer-pixlr-image" + i + "' idtotal='layer"+ numarDeLayere +"' class='sort alert alert-info' style='margin-top:-8px;'><b>Pixlr Image  " + i + "<b><button id='delete-image" + i + "' class='pull-right btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i> Delete</button><br></div>");

            var b = i;
            $("#delete-image" + i).click(function () {
                $("#layer-pixlr-image" + b).remove();
                $("#pixlr" + b).remove();
                //change layers display order after delete
                $($("#layers .sort").get().reverse()).each(function (index) {
                    var id = $(this).attr("idtotal");
                    $(".main").find('.' + id).css('z-index', index);
                });
            });

            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "../../../admin/js/resulteditor.js";
            $("body").append(s);
        }

    });

    $('#close-pixlr').click(function(){
        console.log('apasat');
    });

});
