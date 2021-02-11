obj   = JSON.parse(BDTASK.phrase());
theme = JSON.parse(BDTASK.theme());
$(function($) {
    "use strict";

    done();
    done1();
    done2();
    done01();
    done02();

    //get url paramiter
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split("=");

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    var market = getUrlParameter('market');
    var symbolMarket = market.replace(/_/g, "");
    //chart-data-script
    var market_details = JSON.parse(BDTASK.market_details());

    ///amchart start here
    $.getJSON(BDTASK.getSiteAction('tradecharthistory/?market=' + market), function(result) {

        AmCharts.ready(function() {
            generateChartData();
            createStockChart();
        });

        setTimeout(function() {
            generateChartData();
            createStockChart();
        }, 8000);

        var chartData = [];

        function generateChartData() {
            var firstDate = new Date();
            firstDate.setHours(0, 0, 0, 0);
            firstDate.setDate(firstDate.getDate() - 100);

            var i = 0;
            for (var i = 0; i < result.length; i++) {

                var newDate = new Date(firstDate);
                newDate.setDate(newDate.getDate() + i);

                var open = Math.round(result[i].open);
                var close = Math.round(result[i].close);
                var low;
                if (open < close) {
                    low = Math.round(result[i].low);
                } else {
                    low = Math.round(result[i].low);
                }
                var high;
                if (open < close) {
                    high = Math.round(result[i].high);
                } else {
                    high = Math.round(result[i].high);
                }
                var volume = Math.round(result[i].open);
                var value = Math.round(result[i].open * (30));
                chartData[i] = ({
                    date: newDate,
                    open: open,
                    close: close,
                    high: high,
                    low: low,
                    volume: volume,
                    value: value
                });
            }
        }

        function createStockChart() {
            var chart = new AmCharts.AmStockChart();

            // DATASET 
            var dataSet = new AmCharts.DataSet();
            dataSet.fieldMappings = [{
                fromField: "open",
                toField: "open"
            }, {
                fromField: "close",
                toField: "close"
            }, {
                fromField: "high",
                toField: "high"
            }, {
                fromField: "low",
                toField: "low"
            }, {
                fromField: "volume",
                toField: "volume"
            }, {
                fromField: "value",
                toField: "value"
            }];
            dataSet.color = "#FF0000";
            dataSet.dataProvider = chartData;
            dataSet.categoryField = "date";

            var dataSet2 = new AmCharts.DataSet();
            dataSet2.fieldMappings = [{
                fromField: "value",
                toField: "value"
            }];

            dataSet2.color = "#FF0000";
            dataSet2.dataProvider = chartData;
            dataSet2.compared = true;
            dataSet2.categoryField = "date";

            chart.dataSets = [dataSet];

            // PANELS
            var stockPanel = new AmCharts.StockPanel();
            stockPanel.title              = "Value";
            stockPanel.backgroundColor    = "#FF0000";
            stockPanel.borderColor        = "#FF0000";
            stockPanel.color              = "#FF0000";
            stockPanel.plotAreaFillColors = "#FF0000";
            stockPanel.trendLineColor     = "#FF0000";
            stockPanel.zoomOutButtonColor = "#FF0000";
            stockPanel.showCategoryAxis   = false;
            stockPanel.percentHeight      = 70;

            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.dashLength    = 5;
            valueAxis.axisColor     = "#FF0000";
            valueAxis.fillColor     = "#FF0000";
            valueAxis.gridColor     = "#FF0000";
            valueAxis.titleColor    = "#FF0000";
            stockPanel.addValueAxis(valueAxis);
            stockPanel.categoryAxis.dashLength = 5;


            // graph of first stock panel
            var graph = new AmCharts.StockGraph();
            graph.type               = "candlestick";
            graph.openField          = "open";
            graph.closeField         = "close";
            graph.highField          = "high";
            graph.lowField           = "low";
            graph.valueField         = "close";
            graph.lineColor          = "#7f8da9";
            graph.fillColors         = "#7f8da9";
            graph.negativeLineColor  = "#db4c3c";
            graph.negativeFillColors = "#db4c3c";
            graph.proCandlesticks    = true;
            graph.fillAlphas         = 1;
            graph.useDataSetColors   = false;
            graph.comparable         = true;
            graph.compareField       = "value";
            graph.showBalloon        = false;
            stockPanel.addStockGraph(graph);

            var stockLegend = new AmCharts.StockLegend();
            stockLegend.valueTextRegular         = undefined;
            stockLegend.backgroundColor          = "#FFF";
            stockLegend.borderColor              = "#FF0000";
            stockLegend.color                    = "#FF0000";
            stockLegend.markerDisabledColor      = "#AAB3B3";
            stockLegend.rollOverColor            = "#FF0000";
            stockLegend.switchColor              = "#FFF000";
            stockLegend.periodValueTextComparing = "[[percents.value.close]]";
            stockPanel.stockLegend               = stockLegend;

            var chartCursor = new AmCharts.ChartCursor();
            chartCursor.valueLineEnabled = true;
            chartCursor.valueLineAxis    = valueAxis;
            stockPanel.chartCursor       = chartCursor;

            var stockPanel2 = new AmCharts.StockPanel();
            
            stockPanel2.title              = "Volume";
            stockPanel2.backgroundColor    = "#FF0000";
            stockPanel2.borderColor        = "#FF0000";
            stockPanel2.color              = "#FF0000";
            stockPanel2.plotAreaFillColors = "#FF0000";
            stockPanel2.trendLineColor     = "#FF0000";
            stockPanel2.zoomOutButtonColor = "#FF0000";
            stockPanel2.percentHeight      = 30;
            stockPanel2.marginTop          = 1;
            stockPanel2.showCategoryAxis   = true;

            var valueAxis2 = new AmCharts.ValueAxis();
            valueAxis2.dashLength = 5;
            stockPanel2.addValueAxis(valueAxis2);

            stockPanel2.categoryAxis.dashLength = 5;

            var graph2 = new AmCharts.StockGraph();
            graph2.valueField = "volume";
            graph2.type = "column";
            graph2.showBalloon = false;
            graph2.fillAlphas = 1;
            stockPanel2.addStockGraph(graph2);

            var legend2 = new AmCharts.StockLegend();
            legend2.markerType = "none";
            legend2.markerSize = 0;
            legend2.labelText = "";
            legend2.periodValueTextRegular = "[[value.close]]";
            stockPanel2.stockLegend = legend2;

            var chartCursor2 = new AmCharts.ChartCursor();
            chartCursor2.valueLineEnabled = true;
            chartCursor2.valueLineAxis = valueAxis2;
            stockPanel2.chartCursor = chartCursor2;

            chart.panels = [stockPanel, stockPanel2];


            // OTHER SETTINGS
            var sbsettings = new AmCharts.ChartScrollbarSettings();
            sbsettings.graph = graph;
            sbsettings.graphType = "line";
            sbsettings.usePeriod = "WW";
            sbsettings.updateOnReleaseOnly = false;
            chart.chartScrollbarSettings = sbsettings;


            // PERIOD SELECTOR
            var periodSelector = new AmCharts.PeriodSelector();
            periodSelector.position = "top";
            periodSelector.periods = [{
                period: "DD",
                count: 1,
                label: "1D"
            }, {
                period: "MM",
                count: 1,
                label: "1M"
            }, {
                period: "YYYY",
                selected: true,
                count: 1,
                label: "1Y"
            }, {
                period: "YTD",
                label: "YTD"
            }, {
                period: "MAX",
                label: "MAX"
            }];
            chart.periodSelector = periodSelector;

            chart.write('exchangesChart');
        }
    });
    ///amchart end here
    //message chat start
    $("#message_form").on("submit", function(event) {
        event.preventDefault();
        var inputdata = $("#message_form").serialize();

        $.ajax({
            url: BDTASK.getSiteAction('ajaxMessageChat'),
            type: "post",
            data: inputdata,
            dataType: "json",
            success: function(data) {
                if (data != 1) {
                    if (data.userInfo.image == null) {

                        var imagePath = 'assets/images/icons/user.png';

                    } else {

                        var imagePath = data.userInfo.image;
                    }

                    $("#live_chat_list").append("<div class='message'><img class='avatar' src=" + BDTASK.getSiteAction(imagePath) + " data-toggle='tooltip' data-placement='top' data-original-title='Keith'><div class='text-main'><div class='d-flex align-items-center justify-content-between'><span class='time-ago'>" + data.messageInfo.datetime + "</span></div><div class='text-group'><div class='text'><p>" + data.messageInfo.message + "</p></div></div></div></div>");
                    document.getElementById("message_form").reset();
                } else {
                    allert_warning('warning', "Please Login Again!");
                }
            },
            error: function(data) {
                $("#live_chat").append("<pre>" + data + "</pre>");
            }

        });
    });
    //message chat end

    function done() {
        setTimeout(function() {
            updates_buy();
            done();
        }, 1500);
    }

    function done01() {
        setTimeout(function() {
            updates_sell();
            done01();
        }, 2000);
    }

    function done1() {
        setTimeout(function() {
            marketupdates();
            done1();
        }, 5000);
    }

    function done2() {
        setTimeout(function() {
            messageChat();
            done2();
        }, 1800);
    }

    function done02() {
        setTimeout(function() {
            tradehistoryupdates();
            done02();
        }, 10000);
    }

    //Message Ajax load
    function messageChat() {
        $.getJSON(BDTASK.getSiteAction("jsonMessageStream"), function(data) {
            $("#live_chat_list").empty();
            $.each(data, function(index, element) {
                if (element.image == null) {
                    var imagePath = 'assets/images/icons/user.png';
                } else {
                    var imagePath = element.image;
                }
                $("#live_chat_list").prepend("<div class='message'><img class='avatar' src=" + BDTASK.getSiteAction(imagePath) + " data-toggle='tooltip' data-placement='top' data-original-title='Keith'><div class='text-main'><div class='d-flex align-items-center justify-content-between'><span class='time-ago'>" + element.datetime + "</span></div><div class='text-group'><div class='text'><p>" + element.message + "</p></div></div></div></div>");
            });
        });
    } //Market coinpair load 
    function marketupdates() {
        $.getJSON(BDTASK.getSiteAction('market-streamer/?market=' + market), function(data) {

            $.each(data.marketstreamer, function(index, element) {

                $('#price_' + element.market_symbol).text(parseFloat(element.last_price).toString());
                $('#volume_' + element.market_symbol).text(Math.round(element.total_coin_supply * 100) / 100);

                var change = element.price_change_24h / element.last_price;
                var price_change_percent = (Math.round(change * 100) / 100) * 100;

                $('#price_change_' + element.market_symbol).text(parseFloat(price_change_percent.toFixed(2)).toString() + '%');
                if (change > 0) {
                    $('#price_change_' + element.market_symbol).addClass("positive");
                    $('#price_change_' + element.market_symbol).removeClass('negative');

                } else if (change < 0) {
                    $('#price_change_' + element.market_symbol).addClass("negative");
                    $('#price_change_' + element.market_symbol).removeClass('positive');
                } else {
                    $('#price_change_' + element.market_symbol).removeClass('positive');
                    $('#price_change_' + element.market_symbol).removeClass('negative');
                };

            });
        });
    }

    //Buy Orders load
    function updates_buy() {
        $.getJSON(BDTASK.getSiteAction('streamer-buy?market=' + market), function(data) {
            $("#buytrades").empty();
            $.each(data.trades, function(index, element) {
                var tradeType = "BAD_REQUEST";
                var cls = "";
                if (element.bid_type == 'BUY') {
                    tradeType = "BUY";
                    cls = "positive";
                    $("#buytrades").prepend("<tr><td class='buy_price coin positive'>" + parseFloat(element.bid_price).toFixed(8) + "</td><td class='buy_qty price'>" + parseFloat(element.total_qty).toFixed(6) + "</td><td class='change'>" + parseFloat(parseFloat(element.total_price).toString()).toFixed(6) + "</td></tr>");
                } else {

                    tradeType = "BAD_REQUEST";
                    cls = "";
                }

                //Max Row Show From Stemar
                var maxTableRow = 22;
                var length = $('table tbody#buytrades tr').length;
                if (length >= (maxTableRow)) {
                    $('table tbody#buytrades tr:last').remove();
                }
            });
        });
    }

    //Sell Orders load
    function updates_sell() {
        $.getJSON(BDTASK.getSiteAction('streamer-sell?market=' + market), function(data) {
            $("#selltrades").empty();

            $.each(data.trades, function(index, element) {

                var tradeType = "BAD_REQUEST";
                var cls = "";
                if (element.bid_type == 'SELL') {
                    tradeType = "SELL";
                    cls = "negative";
                    $("#selltrades").prepend("<tr><td class='sell_price coin negative'>" + parseFloat(element.bid_price).toFixed(8) + "</td><td class='sell_qty price'>" + parseFloat(element.total_qty).toFixed(6) + "</td><td class='change'>" + parseFloat(parseFloat(element.total_price).toString()).toFixed(6) + "</td></tr>");
                } else {
                    tradeType = "BAD_REQUEST";
                    cls = "";
                }
                //Max Row Show From Stemar
                var maxTableRow = 22;
                var length1 = $('table tbody#selltrades tr').length;
                if (length1 >= (maxTableRow)) {
                    $('table tbody#selltrades tr:last').remove();
                }

            });
        });
    }

    //Historycal data load
    function tradehistoryupdates() {

        $.getJSON(BDTASK.getSiteAction('tradehistory/?market=' + market), function(data) {
            $("#tradeHistory").empty();
            var lastprice;
            if (data.available_buy_coin != null) {
                $(".available_buy_coin").html(parseFloat(data.available_buy_coin.bid_qty_available || 0).toString());
            } else {
                $(".available_buy_coin").html(0.00);
            }
            if (data.available_sell_coin != null) {
                $(".available_sell_coin").html(parseFloat(data.available_sell_coin.bid_qty_available || 0).toString());
            } else {
                $(".available_sell_coin").html(0.00);
            }

            if (data.coinhistory) {

                var change = data.coinhistory.price_change_24h / data.coinhistory.last_price;
                var price_change_percent = (Math.round(change * 100) / 100) * 100;

                if (change > 0) {
                    $(".price_updown").html(parseFloat(data.coinhistory.last_price).toString() + ' <i class="fa fa-arrow-up" aria-hidden="true"></i>');
                    $('.price_updown').addClass("positive");
                    $('.coin-change-price').addClass("positive");
                    $('.price_updown').removeClass("negative");
                    $('.coin-change-price').removeClass("negative");

                } else if (change < 0) {
                    $(".price_updown").html(parseFloat(data.coinhistory.last_price).toString() + ' <i class="fa fa-arrow-down" aria-hidden="true"></i>');
                    $('.price_updown').addClass("negative");
                    $('.coin-change-price').removeClass("positive");
                    $('.price_updown').addClass("negative");
                    $('.coin-change-price').addClass("negative");

                } else {

                    $(".price_updown").html(parseFloat(data.coinhistory.last_price).toString());
                    $('.price_updown').removeClass('positive');
                    $('.price_updown').removeClass("coin-change-price");
                    $('.price_updown').removeClass('positive');
                    $('.price_updown').removeClass("coin-change-price");
                }

                if (typeof(data.coinhistory.last_price) !== 'undefined' || typeof(data.coinhistory.last_price) != 'null') {
                    var last_price = data.coinhistory.last_price || 0;
                    $(".coin-last-price").html(parseFloat(last_price).toString());
                };
                if (typeof(data.coinhistory.volume_24h) !== 'undefined' || typeof(data.coinhistory.volume_24h) != 'null') {
                    var volume_24h = data.coinhistory.volume_24h;
                    $(".total_volume").html(parseFloat(volume_24h).toString());

                };
                if (typeof(data.coinhistory.price_change_24h) !== 'undefined' || typeof(data.coinhistory.price_change_24h) != 'null') {
                    var price_change_24h = data.coinhistory.price_change_24h || 0;
                    var price_change_percent = (Math.round((price_change_24h / last_price) * 100) / 100) * 100;
                    $(".coin-change-price").html(parseFloat(price_change_percent.toFixed(2)).toString() + '%');

                };
                if (typeof(data.coinhistory.price_high_24h) !== 'undefined' || typeof(data.coinhistory.price_high_24h) != 'null') {
                    var price_high_24h = data.coinhistory.price_high_24h || 0;
                    $(".coin-price-high").html(parseFloat(price_high_24h).toString());
                };
                if (typeof(data.coinhistory.price_low_24h) !== 'undefined' || typeof(data.coinhistory.price_low_24h) != 'null') {
                    var price_low_24h = data.coinhistory.price_low_24h || 0;
                    $(".coin-price-low").html(parseFloat(price_low_24h).toString());
                };
            };

            $.each(data.tradehistory, function(index, element) {

                var tradeType = "BAD_REQUEST";
                var cls = "";
                var cls1 = "";
                if (element.bid_type == 'BUY') {
                    tradeType = "BUY";
                    cls = "positive";
                    cls1 = "buy_price";
                } else if (element.bid_type == 'SELL') {
                    tradeType = "SELL";
                    cls = "negative";
                    cls1 = "sell_price";
                } else {
                    tradeType = "BAD_REQUEST";
                    cls = "";
                }
                var d = new Date(element.success_time);

                $("#tradeHistory").prepend("<tr><td class='treade-size " + cls + "'>" + parseFloat(element.complete_qty).toString() + "</td><td class='price " + cls + "'>" + parseFloat(element.bid_price).toFixed(6) + "</td><td class='time'>" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + "</td></tr>");

                //Max Row Show From Stemar
                var maxTableRow = 18;
                var length = $('table tbody#tradeHistory tr').length;
                if (length >= (maxTableRow)) {
                    $('table tbody#tradeHistory tr:last').remove();
                }

            });
        });
    }
    //Market Price From Market place

    $.getJSON(BDTASK.getSiteAction('coin-pairs'), function(data) {

        $.each(data.coin_pairs, function(index, element) {
            var cryptolistfrom = element.market_symbol;
            var cryptolistto = element.currency_symbol;

            $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=" + cryptolistto + "&tsyms=" + cryptolistfrom + "&api_key=" + BDTASK.crypto_api(), function(result) {
                if (result[Object.keys(result)[0]] == 'Error') {
                    $('#price_' + element.market_symbol).text(market_details.initial_price);
                } else if ($('#price_' + cryptolistto + '_' + cryptolistfrom).text() == '0.00' || $('#price_' + cryptolistto + '_' + cryptolistfrom).text() == '0') {
                    $('#price_' + cryptolistto + '_' + cryptolistfrom).text(result[Object.keys(result)[0]]);
                };
            });
        });
    });

    var cryptolistfrom = market_details.currency_symbol;
    var cryptolistto = market_details.market_symbol;

    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=" + cryptolistfrom + "&tsyms=" + cryptolistto + "&api_key=" + BDTASK.crypto_api(), function(result) {

        var rate = 1;
        if (result[Object.keys(result)[0]] == 'Error') {
            rate = market_details.initial_price;

        } else {
            rate = parseFloat(parseFloat(result[Object.keys(result)[0]]).toFixed(8)).toString();
        };

        $("#buypricing").val(rate);
        $("#sellpricing").val(rate);

        var buywithout_feesval = rate * 1;
        buywithout_feesval = buywithout_feesval.toFixed(8);

        $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
        $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
        var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
        feetxt = feetxt.toFixed(8);
        var fees = $("#buyfees").text(parseFloat(feetxt).toString()+' '+ market_details.market_symbol + '(' + BDTASK.buyfees() + '%)');
        $('#buyfeesval').val(feetxt);
        var total = +buywithout_feesval + +feetxt;
        $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
        $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());


        //anothoer segment
        var sellwithout_fees = rate * 1;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(1);
        var feetxt = (BDTASK.sellfees() / 100) * 1;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString() +' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = 1 + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    //Buy Sell market/Initial price
    $('body').on('click', '.buy_price, .sell_price', function() {
        var buy_price = $(this).text();
        $("#buypricing").val(buy_price);
        $("#sellpricing").val(buy_price);
    });

    $('body').on('click', '.buy_qty', function() {
        var buy_qty = $(this).text();
        $("#buyamount").val(buy_qty);
        $("#sellamount").val(buy_qty);

        var sellwithout_fees = buy_qty * 1;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(1);
        var feetxt = (BDTASK.sellfees() / 100) * 1;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString()+' '+market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = 1 + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $('body').on('click', '.sell_qty', function() {
        var buy_qty = $(this).text();
        $("#buyamount").val(buy_qty);
        $("#sellamount").val(buy_qty);

        var sellwithout_fees = buy_qty * 1;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(1);
        var feetxt = (BDTASK.sellfees() / 100) * 1;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString() + market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = 1 + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $("#buypricing").on("keyup", function(event) {
        event.preventDefault();

        var buypricing = parseFloat($("#buypricing").val()) || 1;
        var buyamount = parseFloat($("#buyamount").val()) || 1;

        var buywithout_feesval = buypricing * buyamount;
        buywithout_feesval = buywithout_feesval.toFixed(8);

        $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
        $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
        var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
        feetxt = feetxt.toFixed(8);
        var fees = $("#buyfees").text(parseFloat(feetxt).toString() + market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
        $('#buyfeesval').val(parseFloat(feetxt).toString());
        var total = +buywithout_feesval + +feetxt;
        $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
        $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());

    });

    $("#buypricing").on("change", function(event) {
        event.preventDefault();

        var buypricing = parseFloat($("#buypricing").val()) || 1;
        var buyamount = parseFloat($("#buyamount").val()) || 1;

        var buywithout_feesval = buypricing * buyamount;
        buywithout_feesval = buywithout_feesval.toFixed(8);

        $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
        $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
        var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
        feetxt = feetxt.toFixed(8);
        var fees = $("#buyfees").text(parseFloat(feetxt).toString() + market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
        $('#buyfeesval').val(parseFloat(feetxt).toString());
        var total = +buywithout_feesval + +feetxt;
        $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
        $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());
    });

    $("#buyamount").on("keyup", function(event) {
        event.preventDefault();

        var buypricing = parseFloat($("#buypricing").val()) || 1;
        var buyamount = parseFloat($("#buyamount").val()) || 1;

        var buywithout_feesval = buypricing * buyamount;
        buywithout_feesval = buywithout_feesval.toFixed(8);

        $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
        $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
        var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
        feetxt = feetxt.toFixed(8);
        var fees = $("#buyfees").text(parseFloat(feetxt).toString() + market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
        $('#buyfeesval').val(feetxt);
        var total = +buywithout_feesval + +feetxt;
        $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
        $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());
    });

    $("#buyamount").on("change", function(event) {
        event.preventDefault();

        var buypricing = parseFloat($("#buypricing").val()) || 1;
        var buyamount = parseFloat($("#buyamount").val()) || 1;

        var buywithout_feesval = buypricing * buyamount;
        buywithout_feesval = buywithout_feesval.toFixed(8);

        $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
        $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
        var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
        feetxt = feetxt.toFixed(8);
        var fees = $("#buyfees").text(parseFloat(feetxt).toString() + market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
        $('#buyfeesval').val(feetxt);
        var total = +buywithout_feesval + +feetxt;
        $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
        $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());
    });

    $("#buyform").on("submit", function(event) {
        event.preventDefault();
        var inputdata = $("#buyform").serialize();
        var amount = $('#buyamount').val();
        var price = $('#buypricing').val();

        if (amount <= 0 || price <= 0) {
            $(".buyloginMessage").empty();
            $(".buyloginMessage").prepend("<p class='alert-danger'>Please Enter Grater Than 0 Value</p>");
            return false;
        }
        $.ajax({
            url: BDTASK.getSiteAction('buy'),
            type: "post",
            data: inputdata,
            success: function(data) {

                console.log(data);

                if (data == 0) {
                    $(".buyloginMessage").html("<p class='alert-danger'>Trade dose not submited</p>");
                } else if (data == 1) {
                    $(".buyloginMessage").html("<p class='alert-warning'>Please Login/Register!</p>");
                } else if (data == 2) {
                    $(".buyloginMessage").html("<p class='alert-warning'>You Have not sufficient Balance!</p>");
                } else {
                    $(".buyloginMessage").html("<p class='alert-success'>Your request successfully done</p>");
                    var trade = JSON.parse(data);
                    $("#balance_buy").text(parseFloat(trade.balance).toString());
                    $("#balance_sell").text(parseFloat(trade.balance_up_to).toString());
                    $("#buytrades").prepend("<tr><td class='buy_price coin positive'>" + trade.trades.bid_price + "</td><td class='price'>" + trade.trades.bid_qty + "</td><td class='change'>" + trade.trades.bid_qty + "</td></tr>");
                }

                document.getElementById("buyform").reset();

                var cryptolistfrom = market_details.currency_symbol;
                var cryptolistto = market_details.market_symbol;

                $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=" + cryptolistfrom + "&tsyms=" + cryptolistto + "&api_key=" + BDTASK.crypto_api(), function(result) {

                    var rate = 1;
                    if (result[Object.keys(result)[0]] == 'Error') {
                        rate = market_details.initial_price;

                    } else {
                        rate = parseFloat(parseFloat(result[Object.keys(result)[0]]).toFixed(8)).toString();
                    };

                    $("#buypricing").val(rate);
                    $("#sellpricing").val(rate);

                    var buywithout_feesval = rate * 1;
                    buywithout_feesval = buywithout_feesval.toFixed(8);
                    $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
                    $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
                    var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
                    feetxt = feetxt.toFixed(8);
                    var fees = $("#buyfees").text(parseFloat(feetxt).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
                    $('#buyfeesval').val(feetxt);
                    var total = +buywithout_feesval + +feetxt;
                    $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
                    $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());

                    var sellwithout_fees = rate * 1;
                    var sellwithout_fees = sellwithout_fees.toFixed(8);

                    $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
                    $('#sellwithout_feesval').val(1);
                    var feetxt = (BDTASK.sellfees() / 100) * 1;
                    var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
                    feetxt = feetxt.toFixed(8);
                    feetxt2 = feetxt2.toFixed(8);
                    $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
                    $('#sellfeesval').val(parseFloat(feetxt).toString());

                    var total = 1 + +feetxt;
                    var total2 = +sellwithout_fees + +feetxt2;
                    $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
                    $('#selltotalval').val(parseFloat(total).toString());
                });
            },
            error: function(data) {
                $(".buyloginMessage").prepend("<pre>" + data + "</pre>");
            }
        });
    });

    //Ajax Sell
    $("#sellpricing").on("keyup", function(event) {
        event.preventDefault();

        var sellpricing = parseFloat($("#sellpricing").val()) || 0;
        var sellamount = parseFloat($("#sellamount").val()) || 0;

        var sellwithout_fees = sellpricing * sellamount;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(parseFloat(sellamount.toFixed(8)).toString());
        var feetxt = (BDTASK.sellfees() / 100) * sellamount;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = +sellamount + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $("#sellpricing").on("change", function(event) {
        event.preventDefault();

        var sellpricing = parseFloat($("#sellpricing").val()) || 0;
        var sellamount = parseFloat($("#sellamount").val()) || 0;

        var sellwithout_fees = sellpricing * sellamount;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(parseFloat(sellamount.toFixed(8)).toString());
        var feetxt = (BDTASK.sellfees() / 100) * sellamount;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = +sellamount + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $("#sellamount").on("keyup", function(event) {
        event.preventDefault();
        var sellpricing = parseFloat($("#sellpricing").val()) || 1;
        var sellamount = parseFloat($("#sellamount").val()) || 1;

        var sellwithout_fees = sellpricing * sellamount;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(parseFloat(sellamount.toFixed(8)).toString());
        var feetxt = (BDTASK.sellfees() / 100) * sellamount;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = +sellamount + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $("#sellamount").on("change", function(event) {
        event.preventDefault();
        var sellpricing = parseFloat($("#sellpricing").val()) || 1;
        var sellamount = parseFloat($("#sellamount").val()) || 1;

        var sellwithout_fees = sellpricing * sellamount;
        var sellwithout_fees = sellwithout_fees.toFixed(8);

        $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
        $('#sellwithout_feesval').val(parseFloat(sellamount.toFixed(8)).toString());
        var feetxt = (BDTASK.sellfees() / 100) * sellamount;
        var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
        feetxt = feetxt.toFixed(8);
        feetxt2 = feetxt2.toFixed(8);

        $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
        $('#sellfeesval').val(parseFloat(feetxt).toString());

        var total = +sellamount + +feetxt;
        var total2 = +sellwithout_fees + +feetxt2;
        $("#selltotal").text(parseFloat(total2).toString());
        $('#selltotalval').val(parseFloat(total).toString());
    });

    $("#sellform").on("submit", function(event) {
        event.preventDefault();
        var inputdata = $("#sellform").serialize();
        var amount = $('#sellamount').val();
        var price = $('#sellpricing').val();
        if (amount <= 0 || price <= 0) {
            $(".sellloginMessage").empty();
            $(".sellloginMessage").prepend("<p class='alert-danger'>Please Enter Grater Than 0 Value</p>");
            return false;
        }
        $.ajax({
            url: BDTASK.getSiteAction('sell'),
            type: "post",
            data: inputdata,
            success: function(data) {
                if (data == 0) {
                    $(".sellloginMessage").html("<p class='alert-danger'>Trade dose not submited</p>");
                } else if (data == 1) {
                    $(".sellloginMessage").html("<p class='alert-warning'>Please Login/Register!</p>");
                } else if (data == 2) {
                    $(".sellloginMessage").html("<p class='alert-warning'>You Have not sufficient Balance!</p>");
                } else {

                    $(".sellloginMessage").html("<p class='alert-success'>Your request successfully done</p>");
                    var trade = JSON.parse(data);
                    $("#balance_sell").text(parseFloat(trade.balance).toString());
                    $("#balance_buy").text(parseFloat(trade.balance_up_to).toString());
                    $("#selltrades").prepend("<tr><td class='coin negative'><div class='progres-s'></div>" + trade.trades.bid_price + "</td><td class='price'>" + trade.trades.bid_qty + "</td><td class='change'>" + trade.trades.total_amount + "</td></tr>");
                }

                document.getElementById("sellform").reset();

                var cryptolistfrom = market_details.currency_symbol;
                var cryptolistto = market_details.market_symbol;
                $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=" + cryptolistfrom + "&tsyms=" + cryptolistto + "&api_key=" + BDTASK.crypto_api(), function(result) {
                    var rate = 1;
                    if (result[Object.keys(result)[0]] == 'Error') {
                        rate = market_details.initial_price;
                    } else {
                        rate = parseFloat(parseFloat(result[Object.keys(result)[0]]).toFixed(8)).toString();
                    };

                    $("#buypricing").val(rate);
                    $("#sellpricing").val(rate);

                    var buywithout_feesval = rate * 1;
                    buywithout_feesval = buywithout_feesval.toFixed(8);
                    $("#buywithout_fees").text(parseFloat(buywithout_feesval).toString());
                    $('#buywithout_feesval').val(parseFloat(buywithout_feesval).toString());
                    var feetxt = (BDTASK.buyfees() / 100) * (buywithout_feesval);
                    feetxt = feetxt.toFixed(8);
                    var fees = $("#buyfees").text(parseFloat(feetxt).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.buyfees() + '%)');
                    $('#buyfeesval').val(feetxt);
                    var total = +buywithout_feesval + +feetxt;
                    $("#buytotal").text(parseFloat(total.toFixed(8)).toString());
                    $('#buytotalval').val(parseFloat(total.toFixed(8)).toString());


                    var sellwithout_fees = rate * 1;
                    var sellwithout_fees = sellwithout_fees.toFixed(8);
                    $("#sellwithout_fees").text(parseFloat(sellwithout_fees).toString());
                    $('#sellwithout_feesval').val(1);
                    var feetxt = (BDTASK.sellfees() / 100) * 1;
                    var feetxt2 = (BDTASK.sellfees() / 100) * sellwithout_fees;
                    feetxt = feetxt.toFixed(8);
                    feetxt2 = feetxt2.toFixed(8);

                    $("#sellfees").text(parseFloat(feetxt2).toString()+' '+ market_details.market_symbol + ' (' + BDTASK.sellfees() + '%)');
                    $('#sellfeesval').val(parseFloat(feetxt).toString());
                    var total = 1 + +feetxt;
                    var total2 = +sellwithout_fees + +feetxt2;
                    $("#selltotal").text(parseFloat(total2.toFixed(8)).toString());
                    $('#selltotalval').val(parseFloat(total).toString());
                });
            },
            error: function(data) {
                $(".sellloginMessage").prepend("<pre>" + data + "</pre>");
            }
        });
    });



    function balloon(item, graph) {
        var txt;
        if (graph.id === "asks") {
            txt = "Ask: <strong>" + formatNumber(item.dataContext.value, graph.chart, 4) + "</strong><br />" +
                "Total volume: <strong>" + formatNumber(item.dataContext.askstotalvolume, graph.chart, 4) + "</strong><br />" +
                "Volume: <strong>" + formatNumber(item.dataContext.asksvolume, graph.chart, 4) + "</strong>";
        } else {
            txt = "Bid: <strong>" + formatNumber(item.dataContext.value, graph.chart, 4) + "</strong><br />" +
                "Total volume: <strong>" + formatNumber(item.dataContext.bidstotalvolume, graph.chart, 4) + "</strong><br />" +
                "Volume: <strong>" + formatNumber(item.dataContext.bidsvolume, graph.chart, 4) + "</strong>";
        }
        return txt;
    }

    function formatNumber(val, chart, precision) {
        return AmCharts.formatNumber(
            val, {
                precision: precision ? precision : chart.precision,
                decimalSeparator: chart.decimalSeparator,
                thousandsSeparator: chart.thousandsSeparator
            }
        );
    }

    //Ajax Language Change start
    $("#lang-change").on("change", function(event) {
        event.preventDefault();

        var inputdata = {};
        inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
        inputdata['lang'] = $("#lang-change").val();

        $.ajax({
            url: BDTASK.getSiteAction('langChange'),
            type: "post",
            data: inputdata,
            success: function(result, status, xhr) {
                location.reload();
            },
            error: function(xhr, status, error) {
                location.reload();
            }
        });
    });

});

$(function() {
    "use strict";
    var info = $('table tbody tr');
    info.click(function() {
        var email = $(this).children().first().text();
        var password = $(this).children().first().next().text();
        var user_role = $(this).attr('data-role');

        $("input[name=luseremail]").val(email);
        $("input[name=lpassword]").val(password);
        $('select option[value=' + user_role + ']').attr("selected", "selected");
    });

    $('.footerHide').on('click', function() {
        $('#footer').hide();
    });

    $('.footerShow').on('click', function() {
        $('#footer').show();
    });

    //get news details
    $(".eachNews").on("click", function(event) {

        var postdata = {};
        postdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
        postdata['newsId'] = $(this).attr('data-news-id');

        $.ajax({
            url: BDTASK.getSiteAction('news_details'),
            type: "post",
            data: postdata,
            dataType: "JSON",
            success: function(data) {
                if (data.article_image != "") {
                    var newsimg = data.article_image;
                } else {
                    var newsimg = "./assets/images/icons/no-img.png";
                }

                $('#newsDetails').html('<div class="modal-content"><button type="button" class="close news-modal_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><header class="header-img"><img src="' + BDTASK.baseUrl() + '/' + newsimg + '"></header><div class="modal-body"><div class="news-details"><h1>' + data.headline_en + '</h1><div class="news-details_content"><p><b>' + data.article1_en + '</b></p></div></div></div></div>');
            }
        });
    });
});
//Confirm Password check
function rePassword() {
    var pass = document.getElementById("pass").value;
    var r_pass = document.getElementById("r_pass").value;

    if (pass !== r_pass) {
        document.getElementById("r_pass").style.borderColor = '#f00';
        document.getElementById("r_pass").style.boxShadow = '0 0 0 0.2rem rgba(255, 0, 0,.25)';
        return false;
    } else {
        document.getElementById("r_pass").style.borderColor = '#ced4da';
        document.getElementById("r_pass").style.boxShadow = 'unset';
        return true;
    }
}

function validateForm() {

    var name = document.forms["registerForm"]["rf_name"].value;
    var email = document.forms["registerForm"]["remail"].value;
    var pass = document.forms["registerForm"]["rpass"].value;
    var r_pass = document.forms["registerForm"]["rr_pass"].value;
    var checkbox = document.forms["registerForm"]["accept_terms"].value;

    if (name == "") {

        allert_warning('warning', obj['first_name_required'][BDTASK.language()]);
        return false;
    } else if (email == "") {

        allert_warning('warning', obj['email'][BDTASK.language()]);
        return false;
    } else if (pass == "") {

        allert_warning('warning', obj['password_required'][BDTASK.language()]);
        return false;
    } else if (!pass.match(/[a-z]/)) {

        allert_warning('warning', obj['a_lowercase_letter'][BDTASK.language()]);
        return false;
    } else if (!pass.match(/[A-Z]/)) {

        allert_warning('warning', obj['a_capital_uppercase_letter'][BDTASK.language()]);
        return false;
    } else if (!pass.match(/\d/)) {

        allert_warning('warning', obj['a_number'][BDTASK.language()]);
        return false;
    } else if (!pass.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g)) {

        allert_warning('warning', obj['a_special'][BDTASK.language()]);
        return false;

    } else if (pass.length < 8) {

        allert_warning('warning', obj['please_enter_at_least_8_characters_input'][BDTASK.language()]);
        return false;

    } else if (r_pass == "") {

        allert_warning('warning', obj['confirm_password_must_be_filled_out'][BDTASK.language()]);
        return false;

    } else if (checkbox == "") {

        allert_warning('warning', obj['must_confirm_privacy_policy_and_terms_and_conditions'][BDTASK.language()]);
        return false;
    }
}

function allert_warning(type, message) {

    toastr[type]("", message)
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}
//Valid Email Address Check
function checkEmail() {
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        document.getElementById("email").style.borderColor = '#f00';
        document.getElementById("email").style.boxShadow = '0 0 0 0.2rem rgba(255, 0, 0,.25)';
        return false;
    } else {
        document.getElementById("email").style.borderColor = '#ced4da';
        document.getElementById("email").style.boxShadow = 'unset';
        return true;
    }
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return pattern.test(emailAddress);
}
//print a div
function printContent(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
    location.reload();
}
//copy url clickbord
function copyFunction() {
    var copyText = document.getElementById("copyed");
    copyText.select();
    document.execCommand("Copy");
}