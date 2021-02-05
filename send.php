<?php
	$display_dataset = [
		'GDP', 
		'GDP Annual Growth Rate', 
		'GDP Constant Prices', 
		'GDP From Agriculture', 
		'GDP From Construction', 
		'GDP From Manufacturing',
		'GDP From Mining',
		'GDP From Public Administration',
		'GDP From Services',
		'GDP From Transport',
		'GDP From Utilities'];

	function getDataByCountry($country) {
		$url = 'https://api.tradingeconomics.com/country/'.$country;
		$headers = array(
			"Accept: application/xml",
			"Authorization: Client 0u8z6so9rqva9tp:laguhrtr813pidw"
		);
		$handle = curl_init(); 
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($handle);
		curl_close($handle);

		$data = json_decode($data, true);
		return $data;
	}

	$first_data = getDataByCountry($_POST['first']);
	$second_data = getDataByCountry($_POST['second']);
?>

<html>
	<head>
		<title>Trading Economics</title>
		<style>
			table {
				width:100%;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 15px;
				text-align: left;
			}
			#t01 tr:nth-child(even) {
				background-color: #eee;
			}
			#t01 tr:nth-child(odd) {
				background-color: #fff;
			}
			#t01 th {
				background-color: black;
				color: white;
			}
		</style>
	</head>
	<body>
		<table id="t01">
			<tr>
				<th>Category</th>
				<th><?php echo($_POST['first']) ?></th> 
				<th><?php echo($_POST['second']) ?></th>
			</tr>
			<?php
				for($i=0; $i<count($display_dataset); $i++) {
					$first['LatestValue'] = '';
					$second['LatestValue'] = '';
					for($k=0; $k<count($first_data); $k++) {
						if($first_data[$k]['Category'] == $display_dataset[$i]) {
							$first = $first_data[$k];
						}
					}

					for($k=0; $k<count($second_data); $k++) {
						if($second_data[$k]['Category'] == $display_dataset[$i]) {
							$second = $second_data[$k];
						}
					}
					echo('<tr>
						<td>'.$display_dataset[$i].'</td>
						<td>'.$first['LatestValue'].'</td>
						<td>'.$second['LatestValue'].'</td>
					</tr>');
				}
			?>
		</table>
		<a href="index.php">Return</a>
	</body>
</html>