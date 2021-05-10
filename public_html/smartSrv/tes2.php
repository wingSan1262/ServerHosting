<?php

$date1 = new DateTime('2006-04-12T12:30:00');
$date2 = new DateTime('2006-04-14T11:30:00');

$diff = $date2->diff($date1);

$hours = $diff->h;
$hours = $hours + ($diff->days*24);

echo $hours."<br>";


// sql informations
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "users_device_inputs";
showRetrievedData ($servername, $username, $password, $dbName, $tbl_name);

function showRetrievedData ($servername, $username, $password, $dbName, $tbl_name){
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM $tbl_name";
    $result = $conn->query($sql);
    
    $sqlArray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $sqlArray[] = $row;
    }
    
    $jsonObj = json_encode($sqlArray, JSON_PRETTY_PRINT);
    
    echo $jsonObj."<br>"."<br>";
    
    $jsonModel = json_decode($jsonObj);
    
    
    if (is_string($jsonModel)) {
     echo "this is string";
    } else {
        echo "this is not string";
     var_dump($jsonModel)."<br>"."<br>";
    }
    
    echo $jsonModel[0] -> water_debit;
}


?>
