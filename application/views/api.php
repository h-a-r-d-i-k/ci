<?php 

$summarized_prices = $this->db->select('p1.title, p1.price')
			    ->from('product as p1')
			    ->join('user as u1', 'p1.user_id = u1.id', 'LEFT')
			    ->where('p1.user_id', $id)
			    ->where('status',1)
			    ->get();
			$result = $summarized_prices->result_array();
			// $covert = $result[0]['price'];

// $url = "http://api.exchangeratesapi.io/latest/base=USD";

// set API Endpoint, access key, required parameters
$endpoint = 'convert';
$access_key = '440720d9e0336dae0ab5fe102fe24632';

$from = 'USD';
$to = 'EUR';
$amount = $result[0]['price'];

// initialize CURL:
$ch = curl_init('https://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
echo $conversionResult['result'];
?>