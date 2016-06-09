<?php
// Set the JSON header
header("Content-type: text/json");

$servername = "127.0.0.1";
$username = "appmania";
$password = "";
$dbname = "projetox_modo_aviao";

$con = mysql_connect("127.0.0.1","root","");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("projetox_modo_aviao", $con);

$sth = mysql_query("SELECT temperatura FROM dados order by tempo DESC LIMIT 1");
$rowsTemp = array();

$rowsTemp['name'] = 'Temperatura';

while($r = mysql_fetch_assoc($sth)) {
    $rowsTemp['data'][] = $r['temperatura'];
}

$result = array();
array_push($result,$rowsTemp);

$finalValue = $rowsTemp['data'][0];
$d = floatval($finalValue);

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number

$y = $d;

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>