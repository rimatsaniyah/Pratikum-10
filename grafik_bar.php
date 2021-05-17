<?php
    include('koneksi.php'); //untuk memanggil file koneksi database
    $query = mysqli_query($koneksi,"select * from tb_corona"); //untuk mengambil data dari tabel database
    
    while($row = mysqli_fetch_array($query)){
	    $country[] = $row['negara'];//untuk menyimpan nama setiap negara dalam array
	    $total_cases[] = $row['total_cases']; //untuk mengambil total kasus dari tabel sesuai negara yang disimpan pada array
    }
?>

<!DOCTYPE html>
	<html>
		<head>
			<title>Grafik Bar dengan ChartJS</title>
		</head>
		<script type="text/javascript" src="Chart.js"></script>
		<body>
			<div style="width: 950px;height: 500px">
				<canvas id="myChart"></canvas>
			</div>
				<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: <?php echo json_encode($country); ?>,
						datasets: [{
							label: 'Total Kasus',
							data: <?php echo json_encode($total_cases); ?>,
							backgroundColor: 'rgba(170, 7, 240, 0.2)',
							borderColor: 'rgba(170, 7, 240, 1)',
							borderWidth: 2
						}]
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
	
