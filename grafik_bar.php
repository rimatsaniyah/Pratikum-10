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
            <script type="text/javascript" src="Chart.js"></script> <!-- memanggil file Chart.js agar kita bisa membuat grafik dengan menggunakan Chart.js -->
        </head>
        <body>
		<div id="canvas-holder" style="width:80%">
			<canvas id="chart-area"></canvas>
		</div>
		<script>
			var config = {
				type: 'bar',
				data: {
					datasets: [{
						data:<?php echo json_encode($total_cases); ?>,//untuk menampilkan jumlah kasus tiap negara
						backgroundColor: [ //warna yang digunakan untuk bagian dalam chart
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
						
						borderColor: [ //warna garis batas dari setiap bagian grafik.
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
						label: 'Presentase Total Kasus'
					}],
					labels: <?php echo json_encode($country); ?>},
				options: {
					responsive: true
				}
			};

			window.onload = function() { //untuk meload grafik ketika laman dimuat
				var ctx = document.getElementById('chart-area').getContext('2d');
				window.myPie = new Chart(ctx, config);
			};
		</script>
	    </body>
    </html>
