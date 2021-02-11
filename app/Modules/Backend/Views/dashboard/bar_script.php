<?php

    if ($monthly_fees) {

    $feesmonth = '';
    $fessamount = '';
    foreach ($monthly_fees as $key => $value) {
        $feesmonth .= '"'.$value->month.'", ';
        $fessamount .= $value->fees.', ';
    }

    $feesmonth  = rtrim($feesmonth, ", "); 
    $fessamount = rtrim($fessamount, ", ");

?>
$(document).ready(function () {
"use strict"; // Start of use strict

    var ctx = document.getElementById("barChart").getContext("2d");
        var myBar2 = new Chart(ctx, {
            type: 'roundedBar',
            data: {
                labels: [<?php echo $feesmonth; ?>],
                datasets: [{
                        label: 'Fees Collected',
                        backgroundColor: chartColors.green,
                        data: [<?php echo $fessamount;  ?>]
                    }, {
                        label: 'Teachers',
                        backgroundColor: chartColors.gray,
                        data: [15, 10, 20, 12, 6, 7, 10, 15, 15, 20, 15, 20]
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
});
<?php } else {   ?>

$(document).ready(function () {
"use strict"; // Start of use strict

    if(window.myChart4 != undefined)
        window.myChart4.destroy();

    // single bar chart
    var ctx = document.getElementById("singelBarChart");
    window.myChart4 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["No data"],
            datasets: [
                {
                    label: "Fees Collected",
                    data: [0],
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(55, 160, 0, 0.5)"
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
});

<?php } ?>