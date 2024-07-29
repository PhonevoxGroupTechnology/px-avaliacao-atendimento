<?php
	require("../config.php");

	// Create connection
	$con = mysqli_connect(SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
	$resultHoje = mysqli_query($con, "SELECT COUNT(*) as total, info1 as satisfacao FROM pesquisa WHERE YEARWEEK(`datetime`, 1) = YEARWEEK(CURDATE(), 1) GROUP BY satisfacao ORDER BY YEAR(datetime) ASC, WEEK(datetime) ASC");
	
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
    <div id="container">
    </div>
<script type="text/javascript">

 var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                height: 260
            },
            title: {
                text: ''
            },
	    tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b> {point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
            },
	    plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
            series: [{
                type: 'pie',
                name: 'Total de Chamadas',
                data: 
		[
			<?php
				// Está semana
				while ($row = mysqli_fetch_assoc($resultHoje)) { 
					echo "{name: '" . $row['total'] . " - " . $row['satisfacao'] . "', y: " . $row['total'] . "},";
				}
			?>
		]
            }]
        });


</script>


</body>
</html>
