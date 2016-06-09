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

//X
$sth = mysql_query("SELECT g_x FROM dados order by tempo DESC LIMIT 1");
$rowsGx = array();

$rowsGx['name'] = 'Aceleração X';

while($r = mysql_fetch_assoc($sth)) {
    $rowsGx['data'][] = $r['g_x'];
}

$result = array();
array_push($result,$rowsGx);

$finalValue = $rowsGx['data'][0];
$valorGx = floatval($finalValue);

// Y
$sth2 = mysql_query("SELECT g_y FROM dados order by tempo DESC LIMIT 1");
$rowsGy = array();

$rowsGy['name'] = 'Aceleração Y';

while($r2 = mysql_fetch_assoc($sth2)) {
    $rowsGy['data'][] = $r2['g_y'];
}

$result2 = array();
array_push($result2,$rowsGy);

$finalValueY = $rowsGy['data'][0];
$valorGy = floatval($finalValueY);

//

//Z

$sth3 = mysql_query("SELECT g_z FROM dados order by tempo DESC LIMIT 1");
$rowsGz = array();

$rowsGz['name'] = 'Aceleração Z';

while($r3 = mysql_fetch_assoc($sth3)) {
    $rowsGz['data'][] = $r3['g_z'];
}

$result3 = array();
array_push($result3,$rowsGz);

$finalValueZ = $rowsGz['data'][0];
$valorGz = floatval($finalValueZ);

//



// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number

$y = $valorGx;
$b = $valorGy;
$c = $valorGz;

// Create a PHP array and echo it as JSON
$ret = array(array($x, $y), array($x,$b), array($x,$c));
echo json_encode($ret);
?>