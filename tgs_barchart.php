<?php
    include('koneksi.php'); //untuk memanggil file koneksi database
    $query = mysqli_query($koneksi,"select * from tb_corona"); //untuk mengambil data dari tabel database
    while($row = mysqli_fetch_array($query)){
	    $country[] = $row['negara'];
	    $total_cases[] = $row['total_cases'];
	    $new_cases[] = $row['new_cases'];
	    $new_deaths[] = $row['new_deaths'];
	    $total_recovered[] = $row['total_recovered'];
	    $active_cases[] = $row['active_cases'];
	    $total_deaths[] = $row['total_deaths'];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Grafik Bar Menggunakan Chartjs</title>
	<script type="text/javascript" src="Chart.js"></script> 
</head>
<body>
    <div style="width: 970px;height: 300px">
		<canvas id="myChart"></canvas> 
	</div>
            <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, { 
                    type: 'bar', //membuat chart type bar
                    data: {
                        labels: <?php echo json_encode($country); ?>,
                        datasets: [{
                            label: 'Total Cases',
                            data: <?php echo json_encode($total_cases); ?>,
                            borderColor: 'rgba(242, 130, 2, 1)',
                            borderWidth: 3
                        },
                        {
                            label: 'Total Death',
                            data: <?php echo json_encode($total_deaths); ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 3
                        },
                        {
                            label: 'New Cases',
                            data: <?php echo json_encode($new_cases); ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 3
                        },
                        {
                            label: 'New Death',
                            data: <?php echo json_encode($new_deaths); ?>,
                            borderColor: 'rgba(170, 7, 240, 1)',
                            borderWidth: 3
                        },
                        {
                            label: 'Total Recovered',
                            data: <?php echo json_encode($total_recovered); ?>,
                            borderColor: 'rgba(0, 247, 255, 1)',
                            borderWidth: 3
                        },
                        {
                            label: 'Active Cases',
                            data: <?php echo json_encode($active_cases); ?>,
                            borderColor: 'rgba(81, 240, 7, 1)',
                            borderWidth: 3
				}
				]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>