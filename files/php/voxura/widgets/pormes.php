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
            type: 'line'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Sep',
                'Out',
                'Nov',
                'Dez'
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
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>Total: {point.y} </b><br/>',
            shared: true
        },
	legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: 
			[
				<?php
					$month = 1;
					do{
						$result_per_month = mysqli_query($con, "SELECT COUNT(info1) as total, info1 as satisfacao FROM pesquisa WHERE MONTH(datetime) = " . $month .  " AND YEAR(datetime) = YEAR(CURDATE()) GROUP BY satisfacao");
						while ($row = mysqli_fetch_assoc($result_per_month)) { 
							$strDataCount = 1;
							$strData = null;
							while($strDataCount < 13){
								if($strDataCount === $month){
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
							if(isset($row['total']) AND $row['total'] > 0)
								echo "{name: '" . $row['satisfacao'] . "', data: [" . $strData . "]},";
						}
						
						$month++;	
					}while($month < 13);
				?>
			]
		});
});
    </script>
    <div id="container"></div>
</body>
</html>
