
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // user_name=$userName&password=$password"
    
    if(!empty($_POST["user_name"]) && !empty($_POST["password"]) ){
        $userName = $_POST["user_name"];
    $password = $_POST["password"];
    
    
    $array = [
    'name' => $userName,
    'password' => $password,
    ];
    $append_array = array();
    $append_array[] = $array;
    echo json_encode ($append_array);
    }
}
// sql informations
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "users_table";
showRetrievedData ($servername, $username, $password, $dbName, $tbl_name);

function showRetrievedData ($servername, $username, $password, $dbName, $tbl_name){
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT email, password, first_name, last_name FROM $tbl_name";
    $result = $conn->query($sql);
    
    $sqlArray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $sqlArray[] = $row;
    }
    
    echo json_encode($sqlArray);

}

?>