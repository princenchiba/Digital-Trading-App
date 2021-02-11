display    = JSON.parse(BDTASK.phrase());
language   = BDTASK.language();

$(document).ready(function(){

	//advertisement manage js start
	$("#add_type").on("change", function(event) {
        event.preventDefault();

        var url      = $(location).attr('href');
        var segments = url.split( '/' );
        var obj_id   = segments[7];

        $.getJSON(BDTASK.getSiteAction('admin/cms/getAdvertisementinfo/'+obj_id), function(data){

            var add_type = $("#add_type").val()|| 0;

            if(add_type==='image' && obj_id == undefined){
                $("#add_content_load").html("<div class='form-group row'><label for='image' class='col-sm-4 col-form-label'>"+display['image'][language]+"</label><div class='col-sm-8'><input title='728x90 or 320x350 px(jpg, jpeg, png, gif, ico)' name='image' class='form-control image' type='file' id='image'><span class='text-danger'>728x90 or 320x350 px(jpg, jpeg, png, gif, ico)</span><input type='hidden' name='image_old' value=''></div></div><div class='form-group row'><label for='url' class='col-sm-4 col-form-label'>"+display['url'][language]+"</label><div class='col-sm-8'><input name='url' value='' class='form-control' placeholder='"+display['url'][language]+"' type='text' id='url'></div></div>");
            }

            if(add_type==='code' && obj_id == undefined){
                $( "#add_content_load").html("<div class='form-group row'><label for='script' class='col-sm-4 col-form-label'>"+display['embed_code'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-8'><textarea  name='script' class='form-control' placeholder='"+display['embed_code'][language]+"' type='text' id='script'></textarea></div></div>");
            }

            if (add_type === 'image') {
                
                contentdata = "";
                if(data.image != ""){
                    var contentdata = "<img src='"+BDTASK.getSiteAction("/")+data.image+"' width='450'>";
                }
                $( "#add_content_load").html("<div class='form-group row'><label for='image' class='col-sm-4 col-form-label'>"+display['image'][language]+"</label><div class='col-sm-8'><span class='mention-text'>728x90 or 320x350 px(jpg, jpeg, png, gif, ico)</span><input title='728x90 or 320x350 px(jpg, jpeg, png, gif, ico)' name='image' class='form-control image' type='file' id='image'><input type='hidden' name='image_old' value='"+data.image+"'>"+contentdata+"</div></div><div class='form-group row'><label for='url' class='col-sm-4 col-form-label'>"+display['url'][language]+"</label><div class='col-sm-8'><input name='url' value='"+data.url+"' class='form-control' placeholder='"+display['url'][language]+"' type='text' id='url'></div></div>");
            } else if (add_type==='code') {

                $( "#add_content_load").html("<div class='form-group row'><label for='script' class='col-sm-4 col-form-label'>"+display['embed_code'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-8'><textarea  name='script' class='form-control' placeholder='"+display['embed_code'][language]+"' type='text' id='script'>"+data.script+"</textarea></div></div>");
            } else {
                $( "#add_content_load").html("");
            }
        });
    });

    $("#market_id, #coin_id").on("change", function(event) {
        event.preventDefault();
        var market = $("#market_id").val();
        var coin = $("#coin_id").val();
        if (market == coin) {
            alert("Please Select Diffrent Coin");
            $('option:selected', this).remove();
        };
        $("#symbol").val(coin+'_'+market);
    });

    $.getJSON(BDTASK.getSiteAction('admin/exchanger/market_streamer'), function(data) {
        $.each(data.marketstreamer, function(index, element){
            
            $('#price_'+element.market_symbol).text(element.last_price);
            var change = element.price_change_1h/element.last_price;
            if (change>0) {
                $('#price_'+element.market_symbol).addClass("text-success");
            }
            else {
                
                $('#price_'+element.market_symbol).addClass("text-danger");
            };

        });
    });
	//advertisement manage js end
	//coin pair market
	
 	//crypto currency table list load by ajax start
    if($('#ajaxcointable').length){

    	var table; 
        var inputdata = {};
            inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
          

        //datatables
        table = $('#ajaxcointable').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],        //Initial no order.
            "pageLength": 10,   // Set Page Length
            "lengthMenu":[[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": BDTASK.getSiteAction('admin/exchanger/cryptocoin-ajax-list'),
                "type": "POST",
                "data": inputdata
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],
           "fnInitComplete": function (oSettings, response) {
          }

        });
        $.fn.dataTable.ext.errMode = 'none';
    }

    //sms and mail setup start
    $("#gatewayname").on("change", function(event) {
        event.preventDefault();
        var gatewayname = $("#gatewayname").val();
        $.getJSON(BDTASK.getSiteAction('admin/setting/getemailsmsgateway'), function(sms){

            var host     = "";
            var user     = "";
            var userid   = "";
            var api      = "";
            var password = "";

            if(sms.gatewayname=="budgetsms"){
                host    = sms.host;
                user    = sms.user;
                userid  = sms.userid;
                api     = sms.api;
            }
            if(sms.gatewayname=="infobip"){
                host    = sms.host;
                user    = sms.user;
                password= sms.password;
            }
            if(sms.gatewayname=="smsrank"){
                host    = sms.host;
                user    = sms.user;
                password= sms.password;
            }
            if(sms.gatewayname=="nexmo"){
                api     = sms.api;
                password= sms.password;
            }

            if (gatewayname==='budgetsms') {
                $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='http://api.budgetsms.com/sms/1/text/singles' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='userid' class='col-sm-3 col-form-label'>"+display['user_id'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='userid' type='text' class='form-control' id='userid' placeholder='"+display['user_id'][language]+"' value='"+userid+"' required></div></div><div class='form-group row'><label for='api' class='col-sm-3 col-form-label'>"+display['apikey'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div>");

            }else if(gatewayname==='infobip'){
               $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='http://api.infobi.com/sms/1/text/singles' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            }else if(gatewayname==='smsrank'){
               $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            }else if(gatewayname==='nexmo'){
               $( "#sms_field").html("<div class='form-group row'><label for='api' class='col-sm-3 col-form-label'>"+display['apikey'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['app_secret'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            } else if(gatewayname==='twilio'){
                $( "#sms_field").html("<h3><a href='https://www.twilio.com'>Twilio</a> Is On Development</h3>"); 

            } else {
                $( "#sms_field").html("<h3>Nothing Found</h3>");

            }

        });
    });

	if($("#gatewayname").length){
        var gatewayname = $("#gatewayname").val();
        if(gatewayname){
            $.getJSON(BDTASK.getSiteAction('admin/setting/getemailsmsgateway'), function(sms){
                var host     = "";
                var user     = "";
                var userid   = "";
                var api      = "";
                var password = "";

                if(sms.gatewayname=="budgetsms"){
                    host    = sms.host;
                    user    = sms.user;
                    userid  = sms.userid;
                    api     = sms.api;
                }
                if(sms.gatewayname=="infobip"){
                    host    = sms.host;
                    user    = sms.user;
                    password= sms.password;
                }
                if(sms.gatewayname=="smsrank"){
                    host    = sms.host;
                    user    = sms.user;
                    password= sms.password;
                }
                if(sms.gatewayname=="nexmo"){
                    api     = sms.api;
                    password= sms.password;
                }

                if (gatewayname==='budgetsms') {
                    $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='userid' class='col-sm-3 col-form-label'>"+display['user_id'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='userid' type='text' class='form-control' id='userid' placeholder='"+display['user_id'][language]+"' value='"+userid+"' required></div></div><div class='form-group row'><label for='api' class='col-sm-3 col-form-label'>"+display['apikey'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div>");

                }else if(gatewayname==='infobip'){
                   $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='smsrank'){
                   $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-sm-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-sm-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='nexmo'){
                   $( "#sms_field").html("<div class='form-group row'><label for='api' class='col-sm-3 col-form-label'>"+display['apikey'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div><div class='form-group row'><label for='password' class='col-sm-3 col-form-label'>"+display['app_secret'][language]+" <i class='text-danger'>*</i></label><div class='col-sm-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='twilio'){
                    $( "#sms_field").html("<h3><a href='https://www.twilio.com'>Twilio</a> Is On Development</h3>"); 

                }
                else{
                    $( "#sms_field").html("<h3>Nothing Found</h3>");

                }

            });
        }
    }
    //sms and mail setup end
    //dashboard home inline js start
    $.getJSON(BDTASK.getSiteAction("dashboard/total-referral-value"), function(data) {
        var sum_balance = 0;
        $.each(data.referral_value, function(index, element){
            var cryptolistfrom  = element.currency_symbol; 
            var cryptolistto    = 'BTC';
            $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistfrom+"&tsyms="+cryptolistto+"&api_key="+BDTASK.crypto_api(), function(result) {

                var btccoin = parseFloat(parseFloat(result[Object.keys(result)[0]]* +element.transaction_amount).toFixed(8)).toString()
                var btccoin1=isNaN(btccoin) ? 0 : btccoin;
                sum_balance = +sum_balance + +btccoin1;
                $('#coin_value_BTC').text(parseFloat(sum_balance).toFixed(4)+' BTC');
                usdSum1(sum_balance);
            });
        });
    });

    $.getJSON(BDTASK.getSiteAction("dashboard/all-fees-value"), function(data) {
        var sum_balance = 0;

        $.each(data.fees_value, function(index, element){

            var cryptolistfrom  = element.currency_symbol; 
            var cryptolistto    = 'BTC';
            $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistfrom+"&tsyms="+cryptolistto+"&api_key="+BDTASK.crypto_api(), function(result) {
                var btccoin = parseFloat(parseFloat(result[Object.keys(result)[0]]* +element.total_qty).toFixed(8)).toString()
                var btccoin1=isNaN(btccoin) ? 0 : btccoin;
                sum_balance = +sum_balance + +btccoin1;
                $('#fees_value_BTC').text(parseFloat(sum_balance).toFixed(6));
                usdSum2(sum_balance);
            });
        });
    });

//dashboard security inline js end
$('input[type="checkbox"]').each(function(){
        $(this).on('change',function(){
            $(this).val()==1?$(this).val(0):$(this).val(1);
        });
    });
});

function usdSum1(sum_balance){
  
    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD&api_key="+BDTASK.crypto_api(), function(result) {

        if(result.Message != "You are over your rate limit please upgrade your account!"){
            $('#coin_value_USD').text(parseFloat(result[Object.keys(result)[0]]*sum_balance).toFixed(2));
        } else {
            $('#coin_value_USD').text('Update Your External Api').css("font-size", "18.7px").removeClass("fs-21");
        }
    });
}
function usdSum2(sum_balance){

    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD&api_key="+BDTASK.crypto_api(), function(result) {
        if(result.Message != "You are over your rate limit please upgrade your account!"){
            $('#fees_value_USD').text(parseFloat(result[Object.keys(result)[0]]*sum_balance).toFixed(2));
        } else {
            $('#fees_value_USD').text('Update Your External Api').css("font-size", "18.7px").removeClass("fs-21");
        }
    });
}

//input field copy inline js start
function myFunction1() {
  var copyText = document.getElementById("copyed1");
  copyText.select();
  document.execCommand("Copy");
}

function myFunction2() {
  var copyText = document.getElementById("copyed2");
  copyText.select();
  document.execCommand("Copy");
}


//mail folder email file inline js end
function load_country_data(page, user) {
    if(user != ""){
        $.ajax({
            url: BDTASK.getSiteAction("admin/user/ajax-tradelist/"+user+"/"+page),
            method:"GET",
            dataType:"json",
            success:function(data)
            {
                $('#user_tradelist').html(data.country_table);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }
}
if($('#user_id').length){
    var user = $('#user_id').val();
    load_country_data(1, user);

    $(document).on("click", ".pagination li a", function(event){
        event.preventDefault();
        var page = $(this).data("ci-pagination-page");
        var user = $('#user_id').val();
        load_country_data(page, user);
    });
}

//withdraw pending inline js start
$(".AjaxModal").click(function(){
  var url = $(this).attr("href");
  var href = url.split("#");  
  jquery_ajax(href[1]);
});

function jquery_ajax(id) {

    var inputdata = {};
        inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash;
        inputdata['id'] = id;

   $.ajax({
        url : BDTASK.getSiteAction('admin/finance/user-info-load'),
        type: "POST",
        data: inputdata,
        dataType: "JSON",
        success: function(data)
        {
            $('#name').text(data.first_name+' '+data.last_name);
            $('#email').text(data.email);
            $('#phone').text(data.phone);
            $('#userid').text(data.user_id);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function printContent(el){
    var restorepage  = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
    location.reload();
}

function cancel_upnotification(t) {

    var inputdata = {};
        inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
        inputdata['id']                = t;
    $.ajax({
        type: "POST",
        url: BDTASK.getSiteAction('admin/autoupdate/cancel-update-notificaton'),
        data: inputdata,
        success: function (t) {
            if(t == 1){

                alert("Successfully Canceled"); 
                location.reload();

            } else {

                alert("Please Try Again!");
                location.reload();
            }
        },
    });
}
//withdraw pending inline js end
