<?php
// sql informations
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "learn_tbl";
$file = "uploads/tes.jpg";
// header('content-type: image/jpg');
// echo base64_decode($file);

if (file_exists($file)){
    readfile($file);
} else {
    echo "nah ....";
}

function returnImageBinary ($file) {
}

?>