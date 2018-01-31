var $accordionn = $("#accordionn"),
    $addResultSpan = $('#add-result span'),
    $storeSpan = $('#store span');


function deleteResult(id, directory, event){

    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Delete result": function() {
                $( this ).dialog( "close" );

                event.preventDefault();

                var formData = {
                    "editid": $('body').data('editid'),
                    "id": id,
                    "directory": directory
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: 'results/delete',
                    data: formData,
                    beforeSend: function () {
                        console.log(formData);
                    },

                    success: function (data) {
                        $('#myModal').modal('show');
                        setTimeout(function () {
                            $('#myModal').modal('hide');
                        }, 3000);

                        $accordionn.empty();

                      if(data.nrramas !== 0){


                          var target = data.genders;
                          for (var k in target){
                              if (target.hasOwnProperty(k)) {
                                  k = parseInt(k);

                                  var numar = k,
                                      numarr = numar + 1,
                                      edited = $('#result' + numar).attr('edited'),
                                      d = new Date();
                                  $accordionn.append('<div id="result' + numarr + '" edited="yes"><div class=acc>Result ' + numarr + '</div><div><div class=resultcontent><div class=col-md-8><img class="fbeditorbtn img-responsive imgedited resultlistimg" src="../../../appsresults/'+ directory +'/result' + numarr + '.jpg?' + d.getTime() +'"></div><div class=col-md-4><div class=buttonsresult><div class=butoaneresult><button onclick=\'deleteResult("'+ numarr +'", "'+ directory +'", event)\' class="btn-danger btn-lg"><i class="glyphicon glyphicon-trash"></i> Delete Result</button></div></div><img class="img-gender" src="../../../images/genders/'+ target[k] +'.png"></div></div></div></div>');

                                  $addResultSpan.html(numar + 2);
                                  $storeSpan.html(numar + 2);
                                  $('#store').attr('result', numar + 2);
                                  $accordionn.accordion("refresh");
                                  $accordionn.accordion({
                                      active: numar
                                  });
                              }
                          }

                      } else {
                          $addResultSpan.html('1');
                          $storeSpan.html('1');
                          $('#store').attr('result', 1);
                      }

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
