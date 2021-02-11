<?php
if ($monthly_deposit) {

    $monthsd = array();
    $monthsw = array();
    $monthst = array();

    $depomonth = '';
    $depoamount = '';
    foreach ($monthly_deposit as $key => $value) {
        $depomonth .= '"'.$value->month.'", ';
        $depoamount .= $value->deposit.', ';

        array_push($monthsd,$value->month);
    }
    $depomonth     = rtrim($depomonth, ", "); 
    $depoamount   = rtrim($depoamount, ", ");



    $withmonth = '';
    $withamount = '';
    foreach ($monthly_withdraw as $key => $value) {
        $withmonth .= '"'.$value->month.'", ';
        $withamount .= $value->withdraw.', ';

        array_push($monthsw,$value->month);
    }
    $withmonth     = rtrim($withmonth, ", "); 
    $withamount   = rtrim($withamount, ", ");



    $trnsmonth = '';
    $trnsamount = '';
    foreach ($monthly_transfer as $key => $value) {
        $trnsmonth .= '"'.$value->month.'", ';
        $trnsamount .= $value->transfer.', ';

        array_push($monthst,$value->month);
    }    
    $trnsmonth     = rtrim($trnsmonth, ", "); 
    $trnsamount   = rtrim($trnsamount, ", ");

    $month = array_merge($monthsd, $monthsw, $monthst);

    $months = '';
    foreach (array_unique($month) as $key => $value) {
        $months .= '"'.$value.'", ';
    }
    $months = rtrim($months, ", "); 

?>
$(document).ready(function () {
"use strict"; // Start of use strict
    //line chart
    if(window.myChart3 != undefined){
        window.myChart3.destroy();
    }
    var ctx = document.getElementById("lineChart");
    window.myChart3 = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $depomonth ?>],
            datasets: [
               
                {
                    label: "Deposit",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(55, 160, 0, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [<?php echo $depoamount;  ?>]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });
});
<?php } else{ ?>
$(document).ready(function () {
"use strict"; // Start of use strict
    //line chart
    if(window.myChart3 != undefined){
        window.myChart3.destroy();
    }
    var ctx = document.getElementById("lineChart");
    window.myChart3 = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["No Data"],
            datasets: [
                {
                    label: "Deposit",
                    borderColor: "rgba(0, 0, 0, .09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(55, 160, 0, 0.5)",
                    pointHighlightStroke: "rgba(26, 179, 148, 1)",
                    data: [0]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });
});

<?php } ?>