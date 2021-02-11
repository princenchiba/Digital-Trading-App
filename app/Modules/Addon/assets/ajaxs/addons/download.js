
 jQuery(document).ready(function () {
    "use strict";
   
    $("#loading, .waitmsg").hide();
    
    // Download New Module
    $('#download_now').on('click', function (e) {
        e.preventDefault();

        var inputdata = {};
            inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
            inputdata['purchase_key']      = $('#purchase_key').val();
            inputdata['itemtype']          = $('#itemtype').val();

       
        if(purchase_key == ''){
            $("#purchase_key_box").removeClass('has-success').addClass('has-danger');
            $(".form-feedback").html("<b>Please enter purchase key!</b>");
            return false;
        }
        if(itemtype == ''){
            $("#purchase_key_box").removeClass('has-success').addClass('has-danger');
            $(".form-feedback").html("<b>Please enter item type!</b>");
            return false;
        }

        $("#loading, .waitmsg").show();
        $(this).attr('disabled','disabled');

        $.ajax({
            type:'POST',
            url:BDTASK.getSiteAction('admin/addon/verify_download_request'),
            data: inputdata,
            success:function(res){

              if (res) {

                $("#purchase_key_box").removeClass('has-danger').addClass('has-success');
                $(".form-feedback").html("<b>Success! Almost done it.Wait...</b>");
                
                    // Timer set
                    var time = 20;
                    var wait = time * 1000;
                    setInterval(function(){
                     $("#wait").html(time);
                     time--;
                    }, 1000);
                    // End of Timer Set
                
                    setTimeout(function(){
                        window.location.href = BDTASK.getSiteAction('admin/addon');
                    }, wait);
                } else {
                    $("#purchase_key_box").removeClass('has-success').addClass('has-danger');
                    $(".form-feedback").html("<b>Failed! Invalid Purchase Key.</b>");
                    $("#loading, .waitmsg").hide();
                }
            },
            error:function(){
                $("#purchase_key_box").removeClass('has-success').addClass('has-danger');
                $(".form-feedback").html("<b>ERROR!Please Try Again</b>");
                $("#loading, .waitmsg").hide();
            }
        });

    });

});
