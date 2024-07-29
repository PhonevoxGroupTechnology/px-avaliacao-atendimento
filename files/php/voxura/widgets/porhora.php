<?php
	require("../config.php");

	// Create connection
	$con = mysqli_connect(SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
	
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="highcharts.js" type="text/javascript"></script>
    <script src="exporting.js" type="text/javascript"></script>

</head>
<body style="overflow:hidden">
    <script type="text/javascript">
	$(function () {
    $('#container').highcharts({
        chart: {
	    renderTo: 'container',
	    height: 305,
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
		legend: {
			enabled: false
		},
        xAxis: {
            categories: [
                '00',
                '01',
                '02',
                '03',
                '04',
                '05',
                '06',
                '07',
                '08',
                '09',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
            shared: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
	series: [
			<?php
				$hour = 0;
				do{
					$SQL = "SELECT COUNT(info1) as total, info1 as satisfacao FROM pesquisa WHERE HOUR(datetime) = " . $hour . " GROUP BY satisfacao";
					$result_per_hour = mysqli_query($con, $SQL);
					while ($row = mysqli_fetch_assoc($result_per_hour)) { 
						$strDataCount = 0;
						$strData = null;
						while($strDataCount < 24){
							if($strDataCount === $hour){
								if(is_null($strData))
									$strData = "" . $row["total"];
								else
									$strData = $strData . "," . $row["total"];
							}else{
								if(is_null($strData))
									$strData = "null";
								else
									$strData = $strData . ", null";
							}
							$strDataCount++;
						}
						if(isset($row['total']) AND $row['total'] > 0 AND $strDataCount > 0){
							echo "{name: '" . ($hour < 10 ? "0" . $hour : $hour) . " horas - " . $row['satisfacao'] . "', data: [" . $strData . "]},";
						}
					}
					
					$hour++;	
				}while($hour < 24);
			?>
			]
    });
});
    </script>
    <div id="container"></div>
</body>
</html>
