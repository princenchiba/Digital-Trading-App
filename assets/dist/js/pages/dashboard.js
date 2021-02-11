$(document).ready(function () {+
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //pie chart
    if($('#pieChart').length){

        $.getJSON(BDTASK.getSiteAction('dashboard/linechart-fees-data'), function(data){
            var ctx = document.getElementById("pieChart");
            
            var myChartpie = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                            data: [data.depositFees, data.withdrawFees, data.transferFees, data.buySellFees],
                            backgroundColor:[
                                "rgba(0, 153, 255, 0.5)",
                                "rgba(55, 160, 0, 0.5)",
                                "rgba(168, 168, 0, 0.5)",
                                "rgba(120, 240, 77, 0.5)",
                            ],
                            hoverBackgroundColor: [
                                "rgba(0, 153, 255, 0.8)",
                                "rgba(55, 160, 0, 0.8)",
                                "rgba(168, 168, 0, 0.8)",
                                "rgba(120, 240, 55, 0.8)",
                            ]

                        }],
                    labels: ['Deposit', 'Withdraw', 'Transfer', 'Buy & Sell']
                },
                options: {
                    legend: false,
                    responsive: true
                }
            });
         window.myChartpie = myChartpie;
        });
    }

    $("#feessymbol").on("change", function(event) {
            event.preventDefault();
            var inputdata = $("#feessymbolform").serialize();
          
            $.ajax({
                url: BDTASK.getSiteAction('dashboard/linechart-fees-data'),
                type: "post",
                data: inputdata,
                dataType: "json",
                success: function(response) {

                    if(window.myChartpie != undefined){
                        window.myChartpie.data.datasets[0].data = [response.depositFees, response.withdrawFees, response.transferFees, response.buySellFees];
                        window.myChartpie.update();
                    }                        
                },
                error: function(data){}
            });
    });

    //bar chart
    var chartColors = {
        green: 'rgba(55, 160, 0,.3)',
        blue: 'rgba(255, 195, 203,.3)',
    };

    var randomScalingFactor = function () {
        return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
    };

    // draws a rectangle with a rounded top
    Chart.helpers.drawRoundedTopRectangle = function (ctx, x, y, width, height, radius) {
        ctx.beginPath();
        ctx.moveTo(x + radius, y);
        // top right corner
        ctx.lineTo(x + width - radius, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
        // bottom right corner
        ctx.lineTo(x + width, y + height);
        // bottom left corner
        ctx.lineTo(x, y + height);
        // top left 
        ctx.lineTo(x, y + radius);
        ctx.quadraticCurveTo(x, y, x + radius, y);
        ctx.closePath();
    };

    Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
        draw: function () {
            var ctx = this._chart.ctx;
            var vm = this._view;
            var left, right, top, bottom, signX, signY, borderSkipped;
            var borderWidth = vm.borderWidth;

            if (!vm.horizontal) {
                // bar
                left = vm.x - vm.width / 2;
                right = vm.x + vm.width / 2;
                top = vm.y;
                bottom = vm.base;
                signX = 1;
                signY = bottom > top ? 1 : -1;
                borderSkipped = vm.borderSkipped || 'bottom';
            } else {
                // horizontal bar
                left = vm.base;
                right = vm.x;
                top = vm.y - vm.height / 2;
                bottom = vm.y + vm.height / 2;
                signX = right > left ? 1 : -1;
                signY = 1;
                borderSkipped = vm.borderSkipped || 'left';
            }

            // Canvas doesn't allow us to stroke inside the width so we can
            // adjust the sizes to fit if we're setting a stroke on the line
            if (borderWidth) {
                // borderWidth shold be less than bar width and bar height.
                var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
                borderWidth = borderWidth > barSize ? barSize : borderWidth;
                var halfStroke = borderWidth / 2;
                // Adjust borderWidth when bar top position is near vm.base(zero).
                var borderLeft = left + (borderSkipped !== 'left' ? halfStroke * signX : 0);
                var borderRight = right + (borderSkipped !== 'right' ? -halfStroke * signX : 0);
                var borderTop = top + (borderSkipped !== 'top' ? halfStroke * signY : 0);
                var borderBottom = bottom + (borderSkipped !== 'bottom' ? -halfStroke * signY : 0);
                // not become a vertical line?
                if (borderLeft !== borderRight) {
                    top = borderTop;
                    bottom = borderBottom;
                }
                // not become a horizontal line?
                if (borderTop !== borderBottom) {
                    left = borderLeft;
                    right = borderRight;
                }
            }

            // calculate the bar width and roundess
            var barWidth = Math.abs(left - right);
            var roundness = this._chart.config.options.barRoundness || 0.5;
            var radius = barWidth * roundness * 0.5;

            // keep track of the original top of the bar
            var prevTop = top;

            // move the top down so there is room to draw the rounded top
            top = prevTop + radius;
            var barRadius = top - prevTop;

            ctx.beginPath();
            ctx.fillStyle = vm.backgroundColor;
            ctx.strokeStyle = vm.borderColor;
            ctx.lineWidth = borderWidth;

            // draw the rounded top rectangle
            Chart.helpers.drawRoundedTopRectangle(ctx, left, (top - barRadius + 1), barWidth, bottom - prevTop, barRadius);

            ctx.fill();
            if (borderWidth) {
                ctx.stroke();
            }

            // restore the original top value so tooltips and scales still work
            top = prevTop;
        }
    });

    Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);

    Chart.controllers.roundedBar = Chart.controllers.bar.extend({
        dataElementType: Chart.elements.RoundedTopRectangle
    });
   
    if($('#barChart').length){

        $.getJSON(BDTASK.getSiteAction('dashboard/monthly-buy-sell'), function(data){

            var monthsdata      = data.buy_months.split(',');
            var buy_amount      = data.buy_amount.split(',');
            var sell_amount     = data.sell_amount.split(',');
            var chart_labels    = monthsdata;
            var buyAmount       = buy_amount;
            var sellAmount      = sell_amount;

            var ctx = document.getElementById("barChart").getContext("2d");
            var myBar = new Chart(ctx, {
                type: 'roundedBar',
                data: {
                    labels: chart_labels,
                    datasets: [{
                            label: 'Buy',
                            backgroundColor: chartColors.green,
                            data: buyAmount
                        }, {
                            label: 'Sell',
                            backgroundColor: chartColors.blue,
                            data: sellAmount
                        }]
                },
                options: {
                    legend: false,
                    responsive: true,
                    barRoundness: 1,
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    padding: 10
                                },
                                gridLines: {
                                    borderDash: [2],
                                    borderDashOffset: [2],
                                    drawBorder: false,
                                    drawTicks: false
                                }
                            }],
                        xAxes: [{
                                maxBarThickness: 10,
                                gridLines: {
                                    lineWidth: [0],
                                    drawBorder: false,
                                    drawOnChartArea: false,
                                    drawTicks: false
                                },
                                ticks: {
                                    padding: 20
                                }
                            }]
                    }
                }
            }); 
        window.myBar=myBar;
        }); 
    } 

    $("#buySell").on("change", function(event) {
        event.preventDefault();
        var inputdata = $("#buysellform").serialize();

        $.ajax({
            url: BDTASK.getSiteAction('dashboard/monthly-buy-sell'),
            type: "post",
            data: inputdata,
            dataType: "json",
            success: function(response) {

                var monthsdata      = response.buy_months.split(',');
                var buy_amount      = response.buy_amount.split(',');
                var sell_amount     = response.sell_amount.split(',');
                var chart_labels    = monthsdata;
                var buyAmount       = buy_amount;
                var sellAmount      = sell_amount;

                var data = myBar.config.data;
                data.datasets[0].data = buyAmount;
                data.datasets[1].data = sellAmount;
                data.labels = monthsdata;
                myBar.update();                       
            },
            error: function(data){}
        });
    }); 

    //linechart js start
    if($('#lineChart').length){

        $.getJSON(BDTASK.getSiteAction('dashboard/deposit-withdraw-transfer-chart-data'), function(data){

            var monthsdata   = data.dep_months.split(',');
            var dep_amount   = data.dep_amount.split(',');
            var with_amount  = data.with_amount.split(',');
            var trans_amount = data.trans_amount.split(',');
            var chart_labels = monthsdata;
            var depAmount    = dep_amount;
            var withAmount   = with_amount;
            var transAmount  = trans_amount;

            var ctx = document.getElementById("lineChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chart_labels,
                    datasets: [
                        {
                            label: "Deposit",
                            borderColor: "rgba(0,108,217,.9)",
                            borderWidth: "2",
                            backgroundColor: "rgba(0,108,217,.07)",
                            data: depAmount
                        },
                        {
                            label: "Withdraw",
                            borderColor: "#37a000",
                            borderWidth: "2",
                            backgroundColor: "rgba(55, 160, 0, 0.1)",
                            pointHighlightStroke: "rgba(26,179,148,1)",
                            data: withAmount
                        },
                        {
                            label: "Transfer",
                            borderColor: "#FF6272",
                            borderWidth: "2",
                            backgroundColor: "rgba(255, 98, 114, 0.3)",
                            pointHighlightStroke: "rgba(255,98,114,1)",
                            data: transAmount
                        }
                    ]
                },
                options: {
                    legend: false,
                    scales: {
                        yAxes: [{
                                gridLines: {
                                    color: "#e6e6e6",
                                    zeroLineColor: "#e6e6e6",
                                    borderDash: [2],
                                    borderDashOffset: [2],
                                    drawBorder: false,
                                    drawTicks: false
                                },
                                ticks: {
                                    padding: 20
                                }
                            }],
                        xAxes: [{
                                maxBarThickness: 50,
                                gridLines: {
                                    lineWidth: [0]
                                },
                                ticks: {
                                    padding: 20,
                                    fontSize: 14,
                                    fontFamily: "'Nunito Sans', sans-serif"
                                }
                            }]
                    }
                }
            });
            window.myChart = myChart;
        });
    }

    $("#dwtSymbol").on("change", function(event) {
        event.preventDefault();
        var inputdata = $("#dwtForm").serialize();
        $.ajax({
            url: BDTASK.getSiteAction('dashboard/deposit-withdraw-transfer-chart-data'),
            type: "post",
            data: inputdata,
            dataType: "json",
            success: function(rdata) {

                var monthsdata = rdata.dep_months.split(',');
                var amountdata = rdata.dep_amount.split(',');
                var with_amount = rdata.with_amount.split(',');
                var trans_amount = rdata.trans_amount.split(',');

                var data = myChart.config.data;

                data.datasets[0].data = amountdata;
                data.datasets[1].data = with_amount;
                data.datasets[2].data = trans_amount;
                data.labels = monthsdata;
                myChart.update();
            },
            error: function(data){
            }
        });
    });
    //linechart js end

    //Performance Chart
    if($('#forecast').length){
        $.getJSON(BDTASK.getSiteAction('dashboard/user-growth'), function(data){

            var months   = data.months.split(',');
            var toaluser  = data.toaluser.split(',');
            var chart_labels = months;
            var total_user    = toaluser;
            
            var ctx = document.getElementById("forecast").getContext('2d');
            var config = {
                type: 'bar',
                data: {
                    labels: chart_labels,
                    datasets: [{
                            type: 'line',
                            label: "Total Users",
                            borderColor: "rgb(55, 160, 0)",
                            fill: false,
                            data: total_user
                        }, {
                            type: 'bar',
                            label: "Total Users",
                            backgroundColor: "rgba(55, 160, 0, .1)",
                            borderColor: "rgba(55, 160, 0, .4)",
                            data: total_user
                        }]
                },
                options: {
                    legend: false,
                    scales: {
                        yAxes: [{
                                gridLines: {
                                    color: "#e6e6e6",
                                    zeroLineColor: "#e6e6e6",
                                    borderDash: [2],
                                    borderDashOffset: [2],
                                    drawBorder: false,
                                    drawTicks: false
                                },
                                ticks: {
                                    padding: 20
                                }
                            }],

                        xAxes: [{
                                maxBarThickness: 50,
                                gridLines: {
                                    lineWidth: [0]
                                },
                                ticks: {
                                    padding: 20,
                                    fontSize: 14,
                                    fontFamily: "'Nunito Sans', sans-serif"
                                }
                            }]
                    }
                }
            };
            var forecast_chart = new Chart(ctx, config);
            $("#user_growth").on("change", function(event) {
                event.preventDefault();
                var inputdata = $("#userGrowthForm").serialize();
                $.ajax({
                    url: BDTASK.getSiteAction('dashboard/user-growth'),
                    type: "post",
                    data: inputdata,
                    dataType: "json",
                    success: function(response) {

                        var months        = response.months.split(',');
                        var toaluser      = response.toaluser.split(',');
                        var chart_labels  = months;
                        var total_user    = toaluser;

                        var data = forecast_chart.config.data;
                        data.datasets[0].data = total_user;
                        data.datasets[1].data = total_user;
                        data.labels = chart_labels;
                        forecast_chart.update();

                    },
                    error: function(data){
                    }
                });
            });
        });
    }
});
