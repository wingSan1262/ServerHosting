<!DOCTYPE html>
<html>
<body>
    
<?php
// sql informations
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "learn_tbl";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $time = test_input($_POST["time"]);
        $temperature = test_input($_POST["temperature"]);
        $isFanOn = test_input($_POST["isFanOn"]);
        $isTherePerson = test_input($_POST["isTherePerson"]);
    showRetrievedData($time, $temperature, $isFanOn, $isTherePerson, $servername, $username, $password, $dbName, $tbl_name);
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function showNameError ($time, $temperature, $isFanOn, $isTherePerson){
    echo "input not valid </br>";
    echo (isset($time)) ? $time : 'null </br>';
    echo "temperature ". $temperature ."</br>";
    echo "isFanOn". $isFanOn ."</br>";
    echo "isTherePerson". $isTherePerson ."</br>";
}

function showRetrievedData ($time, $temperature, $isFanOn, $isTherePerson, $servername, $username, $password, $dbName, $tbl_name){
    // echo $time. "</p>";
    // echo $temperature. "</p>";
    // echo $isFanOn. "</p>";
    // echo $isTherePerson. "</p>";
    echo "OK inserting SQL";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    
    $sql = "INSERT INTO ".$tbl_name." (Time, Temperature, IsFanOn, IsPersonThere)
    VALUES ('$time', $temperature, $isFanOn, $isTherePerson)";

    if ($conn->query($sql) === TRUE) {
     echo "New record created successfully";
    } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

return "OK"
?>

</body>
</html>