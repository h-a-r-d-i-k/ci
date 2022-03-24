<?php 
//servername
$servername = "localhost";
//username
$username = "root";
//empty password
$password = "";
//database is the database name
$dbname = "ci_test";
  
// Create connection by passing these connection parameters
$conn = new mysqli($servername, $username, $password, $dbname);
// Check this connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// $id = $this->session->set_userdata('userlogged_in');
// $login_id = $_SESSION['login_session'][0]['id'];
// echo $login_id;exit;
$sql = "SELECT product.price,product.user_id
FROM product
LEFT JOIN user
ON product.user_id = user.id
WHERE product.user_id = 26 AND STATUS = 1";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);

// set API Endpoint, access key, required parameters
$endpoint = 'convert';
$access_key = '440720d9e0336dae0ab5fe102fe24632';

$from = 'USD';
$to = 'EUR';
$amount = $row[0];

// initialize CURL:
$ch = curl_init('http://api.exchangeratesapi.io/v1/latest?access_key=440720d9e0336dae0ab5fe102fe24632&symbols=USD,INR,RON&format=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
echo"<pre>";print_r($conversionResult);exit;
?>