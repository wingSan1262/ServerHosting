<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "learn_tbl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$date = date("Y/m/d");
$time = date("H:i:s");
$temperature = 5;
$isFanOn = true;
$isPersonThere = true;

$sql = "INSERT INTO ".$tbl_name." (Date, Time, Temperature, IsFanOn, IsPersonThere)
VALUES ('$date', '$time', '$temperature', '$isFanOn', '$isPersonThere')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

</body>
</html>