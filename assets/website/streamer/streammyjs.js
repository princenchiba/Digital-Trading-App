(function ($) {
    "use strict";

    var currentPrice = {};
    var socket = io.connect('https://streamer.cryptocompare.com');
    //Format: {SubscriptionId}~{ExchangeName}~{FromSymbol}~{ToSymbol}
    //Use SubscriptionId 0 for TRADE, 2 for CURRENT and 5 for CURRENTAGG
	$.getJSON(BDTASK.getSiteAction('get-stream'), function(datapack){

        var subscription = [];
		$.each(datapack, function( key, value ) {
			 subscription.push(value);
		});

	    socket.emit('SubAdd', { subs: subscription });
	    socket.on("m", function(message) {
	        var messageType = message.substring(0, message.indexOf("~"));
	        var res = {};
	        if (messageType == CCC.STATIC.TYPE.CURRENTAGG) {
	            res = CCC.CURRENT.unpack(message);
	            dataUnpack(res);
	        }
	    });
	    var dataUnpack  = function(data) {

	        var from    = data['FROMSYMBOL'];
	        var to      = data['TOSYMBOL'];
	        var fsym    = CCC.STATIC.CURRENCY.getSymbol(from);
	        var tsym    = CCC.STATIC.CURRENCY.getSymbol(to);
	        var pair    = from + to;

	        if (!currentPrice.hasOwnProperty(pair)) {
	            currentPrice[pair] = {};
	        }
	        for (var key in data) {
	            currentPrice[pair][key] = data[key];
	        }
	        if (currentPrice[pair]['LASTTRADEID']) {
	            currentPrice[pair]['LASTTRADEID'] = parseInt(currentPrice[pair]['LASTTRADEID']).toFixed(0);
	        }
	        currentPrice[pair]['CHANGE24HOUR'] = CCC.convertValueToDisplay(tsym, (currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']));
	        currentPrice[pair]['CHANGE24HOURPCT'] = ((currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']) / currentPrice[pair]['OPEN24HOUR'] * 100).toFixed(2) + "%";;
	        displayData(currentPrice[pair], from, tsym, fsym);
	    };

	    var displayData = function(current, from, tsym, fsym) {
	        var priceDirection = current.FLAGS;
	        for (var key in current) {
	            if (key == 'CHANGE24HOURPCT') {
	                $('#' + key + '_' + from).text(' (' + current[key] + ')');
	            }
	            else if (key == 'LASTVOLUMETO' || key == 'VOLUME24HOURTO') {
	                $('#' + key + '_' + from).text(CCC.convertValueToDisplay(tsym, current[key]));
	            }
	            else if (key == 'LASTVOLUME' || key == 'VOLUME24HOUR' || key == 'OPEN24HOUR' || key == 'OPENHOUR' || key == 'HIGH24HOUR' || key == 'HIGHHOUR' || key == 'LOWHOUR' || key == 'LOW24HOUR') {
	                $('#' + key + '_' + from).text(CCC.convertValueToDisplay(fsym, current[key]));
	            }
	            else {
	                $('#' + key + '_' + from).text(current[key]);
	            }
	        }
	        $('#PRICE_' + from).removeClass();
	        $('#BGCOLOR_' + from).removeClass();
	        if (priceDirection & 1) {
	            $('#PRICE_' + from).addClass("up");
	            $('#BGCOLOR_' + from).addClass("upbg");
	        }
	        else if (priceDirection & 2) {
	            $('#PRICE_' + from).addClass("down");
	            $('#BGCOLOR_' + from).addClass("downbg");
	        }
	        if (current['PRICE'] > current['OPEN24HOUR']) {
	            $('#CHANGE24HOURPCT_' + from).removeClass();
	            $('#CHANGE24HOURPCT_' + from).addClass("up");
	        }
	        else if (current['PRICE'] < current['OPEN24HOUR']) {
	            $('#CHANGE24HOURPCT_' + from).removeClass();
	            $('#CHANGE24HOURPCT_' + from).addClass("down");
	        }
	    };
	});

}(jQuery));

