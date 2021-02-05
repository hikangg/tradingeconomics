<?php            
	function getGdpByCountry($country) {
		$url = 'https://api.tradingeconomics.com/country/'.$country.'/gdp';
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
	
	function getGDPAnnualGrowthRate($country) {
		$url = 'https://api.tradingeconomics.com/country/'.$country.'/gdp annual growth rate';
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

	$first_gdp_data = getGdpByCountry($_POST['first']);
	$second_gdp_data = getGdpByCountry($_POST['second']);

	$first_gdp_growth_rate_data = getGDPAnnualGrowthRate($_POST['first']);
	$second_gdp_growth_rate_data = getGDPAnnualGrowthRate($_POST['second']);
?>

<html>
<head>
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
  <tr>
    <td>GDP</td>
    <td><?php echo($first_gdp_data[0]['LatestValue']) ?></td>
    <td><?php echo($second_gdp_data[0]['LatestValue']) ?></td>
  </tr>
  <tr>
    <td>GDP Annual Growth Rate</td>
    <td><?php echo($first_gdp_growth_rate_data[0]['LatestValue']) ?></td>
    <td><?php echo($second_gdp_growth_rate_data[0]['LatestValue']) ?></td>
  </tr>
</table>
</body>
</html>