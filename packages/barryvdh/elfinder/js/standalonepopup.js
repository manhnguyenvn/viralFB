$(document).on('click', '.popup_selector', function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked


    var fullUrl = window.location.href;
    var configuration = 'configuration';
    var detalies = 'detalies';
    var inainte = '';
   if( fullUrl.indexOf(configuration) !== -1){
      inainte = '../';
   } else if( fullUrl.indexOf(detalies) !== -1){
       inainte = '../../../';
   }


    var elfinderUrl = inainte + 'elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '60%',
        height: '83%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    $('#' + requestingField).val(filePath).trigger('change');
}
