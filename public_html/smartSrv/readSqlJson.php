<?php

$file = file_get_contents("https://badcodegr.000webhostapp.com/smartSrv/tes2.php");
$json = json_decode($file, true);

echo $json;

?>