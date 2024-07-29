<?php
	require("../config.php");

	// Create connection
	$con = mysqli_connect(SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
	$result2016 = mysqli_query($con, "SELECT info1 as satisfacao, COUNT(info1) as total FROM pesquisa WHERE YEAR(datetime) = 2020 GROUP BY info1;");
	$result2017 = mysqli_query($con, "SELECT info1 as satisfacao, COUNT(info1) as total FROM pesquisa WHERE YEAR(datetime) = 2021 GROUP BY info1;");
	$result2018 = mysqli_query($con, "SELECT info1 as satisfacao, COUNT(info1) as total FROM pesquisa WHERE YEAR(datetime) = 2022 GROUP BY info1;");
	
	
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
    <script type="text/javascript">
    </script>
</head>
<body style="overflow:hidden">
    <div id="container"></div>
    <script type="text/javascript">
    $(function () {
    $('#container').highcharts({
            chart: {
                type: 'bar',
                height: 260
            },
            title: {
                text: ''
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            xAxis: {
                categories: ['2022', '2021', '2020']
            },
            legend: {
                reversed: true
            },
	    tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
	    series: [
			<?php
				// ano de 2016
				while ($row = mysqli_fetch_assoc($result2016)) { 
					echo "{name: '" . $row['total'] . " - " . $row['satisfacao'] . "', data: [0, 0, " . $row['total'] . "] },";
				}
				
				// ano de 2017
				while ($row = mysqli_fetch_assoc($result2017)) { 
					echo "{name: '" . $row['total'] . " - " . $row['satisfacao'] . "', data: [0, " . $row['total'] . ", 0] },";
				}
				
				// ano de 2018
				while ($row = mysqli_fetch_assoc($result2018)) { 
					echo "{name: '" . $row['total'] . " - " . $row['satisfacao'] . "', data: [" . $row['total'] . ", 0, 0] },";
				}
			?>
			]
        });
        });
    </script>
</body>
</html>
