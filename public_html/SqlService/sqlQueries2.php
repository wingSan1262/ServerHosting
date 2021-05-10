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
showRetrievedData ($servername, $username, $password, $dbName, $tbl_name);

function showRetrievedData ($servername, $username, $password, $dbName, $tbl_name){
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    
    $sql = "SELECT * FROM $tbl_name";
    $result = $conn->query($sql);
    
    $sqlArray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $sqlArray[] = $row;
    }
    
    echo json_encode($sqlArray);

    // if ($result->num_rows > 0) {
    // // output data of each row
    //  while($row = $result->fetch_assoc()) {
    //         echo "id: " . $row["indexID"]. " - Date: " . $row["Date"]. " - Time" . $row["Time"]." - Temperature" . $row["Temperature"]. " - isFanOn" . $row["isFanOn"]." - isPersonThere" . $row["isPersonThere"]. "<br>";
    //     }
    // } else {
    //     echo "0 results";
    // }
}

?>

</body>
</html>