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

// X
$sth = mysql_query("SELECT eixo_x FROM dados order by tempo DESC LIMIT 1");
$rowsEixoX = array();

$rowsEixoX['name'] = 'Eixo X';

while($r = mysql_fetch_assoc($sth)) {
    $rowsEixoX['data'][] = $r['eixo_x'];
}

$result = array();
array_push($result,$rowsEixoX);

$finalValue = $rowsEixoX['data'][0];
$valorEixoX = floatval($finalValue);

//


// Y
$sth2 = mysql_query("SELECT eixo_y FROM dados order by tempo DESC LIMIT 1");
$rowsEixoY = array();

$rowsEixoY['name'] = 'Eixo Y';

while($r2 = mysql_fetch_assoc($sth2)) {
    $rowsEixoY['data'][] = $r2['eixo_y'];
}

$result2 = array();
array_push($result2,$rowsEixoY);

$finalValueY = $rowsEixoY['data'][0];
$valorEixoY = floatval($finalValueY);

//

//Z

$sth3 = mysql_query("SELECT eixo_z FROM dados order by tempo DESC LIMIT 1");
$rowsEixoZ = array();

$rowsEixoZ['name'] = 'Eixo Z';

while($r3 = mysql_fetch_assoc($sth3)) {
    $rowsEixoZ['data'][] = $r3['eixo_z'];
}

$result3 = array();
array_push($result3,$rowsEixoZ);

$finalValueZ = $rowsEixoZ['data'][0];
$valorEixoZ = floatval($finalValueZ);

//

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number

$y = $valorEixoX;
$b = $valorEixoY;
$z = $valorEixoZ;

// Create a PHP array and echo it as JSON
$ret = array(array($x, $y), array($x,$b), array($x,$z));
echo json_encode($ret);

?>