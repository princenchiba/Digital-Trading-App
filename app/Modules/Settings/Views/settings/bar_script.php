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

    if(window.myChart4 != undefined)
        window.myChart4.destroy();

    // single bar chart
    var ctx = document.getElementById("singelBarChart");
    window.myChart4 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $feesmonth; ?>],
            datasets: [
                {
                    label: "Fees Collected",
                    data: [<?php echo $fessamount;  ?>],
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
<?php } else{   ?>

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