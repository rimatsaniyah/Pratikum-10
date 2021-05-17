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
			<title>Grafik Pie New Deaths</title>
			<script type="text/javascript" src="Chart.js"></script>
		</head>
		</head>
		<body>
			<div id="canvas-holder" style="width:80%">
				<canvas id="chart-area"></canvas>
			</div>
			<script>
				var config = {
					type: 'pie', //membuat chart type pie
					data: {
						datasets: [{
							data:<?php echo json_encode($new_deaths); ?>,
							backgroundColor: [ 
							'rgba(242, 130, 2, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(0, 247, 255, 0.2)',
							'rgba(81, 240, 7, 0.2)',
							'rgba(170, 7, 240, 0.2)',
							'rgba(255, 0, 170, 0.2)',
							'rgba(85, 0, 255, 0.2)',
							'rgba(255, 99, 132, 0.2)'
							],
							
							borderColor: [ 
							'rgba(242, 130, 2, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(0, 247, 255, 1)',
							'rgba(81, 240, 7, 1)',
							'rgba(170, 7, 240, 1)',
							'rgba(255, 0, 170, 1)',
							'rgba(85, 0, 255, 1)',
							'rgba(255,99,132,1)'
							],
							label: 'Kasus Covid-19'
						}],
						labels: <?php echo json_encode($country); ?>}, 
					options: {
						responsive: true
					}
				};
				//untuk mengatur pie chart
				window.onload = function() {
					var ctx = document.getElementById('chart-area').getContext('2d');
					window.myPie = new Chart(ctx, config);
				};

				document.getElementById('randomizeData').addEventListener('click', function() {
					config.data.datasets.forEach(function(dataset) {
						dataset.data = dataset.data.map(function() {
							return randomScalingFactor();
						});
					});

					window.myPie.update();
				});

				var colorNames = Object.keys(window.chartColors);
				document.getElementById('addDataset').addEventListener('click', function() {
					var newDataset = {
						backgroundColor: [],
						data: [],
						label: 'New dataset ' + config.data.datasets.length,
					};

					for (var index = 0; index < config.data.labels.length; ++index) {
						newDataset.data.push(randomScalingFactor());

						var colorName = colorNames[index % colorNames.length];
						var newColor = window.chartColors[colorName];
						newDataset.backgroundColor.push(newColor);
					}

					config.data.datasets.push(newDataset);
					window.myPie.update();
				});

				document.getElementById('removeDataset').addEventListener('click', function() {
					config.data.datasets.splice(0, 1);
					window.myPie.update();
				});
			</script>
		</body>
	</html>