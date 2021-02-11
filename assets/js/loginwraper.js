$(function(){
    "use strict";
    var info = $('table tbody tr');
    info.click(function() {
        var email    = $(this).children().first().text(); 
        var password = $(this).children().first().next().text();
        var user_role = $(this).attr('data-role');  

        $("input[name=email]").val(email);
        $("input[name=password]").val(password);
        $('select option[value='+user_role+']').attr("selected", "selected"); 
    });

    $('.footerHide').on('click', function(){
       $('#footer').hide();
    });

    $('.footerShow').on('click', function(){
       $('#footer').show();
    });
});
