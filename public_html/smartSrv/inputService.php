<html> 
  <head>
     <title>Upload and Store video to MySQL Database with PHP</title>
       <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      
<?php
$target_dir = "videos/";


// Valid file extensions
$extensions_arr = array("mp4","avi","3gp","mov","mpeg");


//Data 
$userMail = "";
$voltage=0;
$current=0;
$electricity_energy=0;
$water=0;
$guestMsg = "";
$isCourier = 0;
$isAcOn = 0;
$temperature = 0;

date_default_timezone_set('Asia/Jakarta');

$time = date("H:i:s");
$year = date("Y");
$month = date("m");
$date = date("d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

 
 $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    // Select file type
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$temp = explode(".", $_FILES["file"]["name"]);
$newName = $dateTime . '.' . end($temp);

if( in_array($videoFileType,$extensions_arr) ){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir. $newName)) {
    echo "The file ". htmlspecialchars($target_dir . $newName). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
} else {
    echo "Sorry, the file is not video or the type is not supported";
}

    
    // mail
 if (!empty($_POST["user_mail"])){
     $userMail = $_POST["user_mail"];
 }
 

 
 // voltage
 
 if (!empty($_POST["voltage"])){
     $voltage = $_POST["voltage"];
 }
 
 // current
 
 if (!empty($_POST["current"])){
     $current = $_POST["current"];
 }
 
 // water
 
 if (!empty($_POST["water"])){
     $water = $_POST["water"];
 }
 
 // guestMessage
 
 if (!empty($_POST["guestMsg"])){
     $guestMsg = $_POST["guestMsg"];
 }
 
 // isCourier
 if (!empty($_POST["isCourier"])){
     if($_POST["isCourier"]){
         $isCourier = 1;
     } 
 }
 
  // isCourier
 if (!empty($_POST["isAcOn"])){
     if($_POST["isAcOn"]){
         $isCourier = 1;
     } 
 }
 
 // temperature
  if (!empty($_POST["temperature"])){
     $temperature = $_POST["temperature"];
 }
 
echo $userMail."/n";
echo $voltage."/n";
echo $current ."/n";
echo $water."/n";
echo $guestMsg."/n";
echo $isCourier."/n";
echo $isAcOn."/n";
echo $temperature."/n";
 
 //INSERT TO sql
 
$servername = "localhost";
$username = "id15909315_badcode";
$password = "1262Wing.Wira";
$dbName = "id15909315_badcodedatabase";
$tbl_name = "users_device_inputs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


// Calculate electricity energy
$sql = "SELECT (indexID) FROM $tbl_name WHERE indexID = (SELECT MAX(indexID) FROM $tbl_name WHERE user_email = $userMail) AND user_email = $userMail";
$result = $conn->query($sql);
var_dump ($result);// debug here
if($result > 0){
    $timeCommandSql = "SELECT (time, month, date, year) FROM $tbl_name WHERE indexID = (SELECT MAX(indexID) FROM $tbl_name WHERE user_email = $userMail) AND user_email = $userMail";
    $timeQuery = $conn->query($timeCommandSql);
    $timeQuery = json_encode($timeQuery);
    $timeQuery = json_decode($timeQuery);
    
    // $start_date = new DateTime('2007-09-01 04:10:58');
    
    $start_date = new DateTime($timeQuery -> year . "-" . $timeQuery -> month . "-" . $timeQuery -> date . "T".$timeQuery -> date);
    
    $deltaTime = $start_date->diff(new DateTime($year. "-". $month. "-". $date. "-". "T". $date));
    
    $timeDiff = (($deltaTime-> days * 1440) + ($deltaTime-> h * 60) + ($deltaTime-> i ))/60 ;
    
    $electricity_energy = (($volt * $current) + $result) * $timeDiff * 0.5;
}





//// Insertion Start


$appendedVideoDir = $target_dir.$newName;
$sql = "INSERT INTO ".$tbl_name." (user_email, voltage, current, electricity_energy,water_debit, isAcOn, temperature, isCourier, courier_msg, video_surveillance_path, time, month, date, year)
VALUES ('$userMail', '$voltage', '$current', '$electricity_energy', '$water', $isAcOn, $temperature, '$isCourier', '$guestMsg', '$appendedVideoDir', '$time', '$year', '$month', '$date' )";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
    
}

?>
    
    <div class="card" style="margin-top: 15px;width : 60%; left : 20%;
     position: relative; text-align: center; padding: 2%; background-color: rgb(179, 199, 156);box-shadow: 0 0 10px black; ">
        
        <h2>Input Your Data.</h2> <br>
        
        
            <form method="post" action="" enctype='multipart/form-data'>
        <p>Select a file <br>
        <input type='file' name='file' style = 'vertical-align : middle; display : inline;'/><br>
        </p>
      
      <p>your email <br>
        <input type="text" id="name" required name="user_mail" maxlength="30" size="10"><br>
        </p>
        
        <!--todo change name form-->
        <p> Voltage input : <br>
        <input type="number"  required name="voltage" min="0" value=$temperature step="1"> <h0 style="color:black;font-size:15px;" size="1">  C</h0></br> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>
        </p>
        
        <!--todo change name form-->
        <p> Current input : <br>
        <input type="number" required name="current" min="0" step="1"> <h0 style="color:black;font-size:15px;" size="1">  C</h0></br> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>
        </p>
        
        <!--todo change name form-->
        <p> Water debit input : <br>
        <input type="number" required name="water" min="0"step="1"> <h0 style="color:black;font-size:15px;" size="1">  C</h0></br> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>
        </p>
        
        <p> isAcOn : <br>
            <input type="radio" name="isAcOn" value=true>True
            <input type="radio" name="isAcOn" value=false>False
        </p>
        
        <!--todo change name form-->
        <p> Temperature : <br>
        <input type="number" required name="temperature" min="0"step="0.1"> <h0 style="color:black;font-size:15px;" size="1">  C</h0></br> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>
        </p>
        
        <!--todo change name form-->
        <p> guest message : <br>
        <textarea name="guestMsg" style = "  margin: 0; padding: 0;  width: 50%; height: 20%;">Enter your message here</textarea><br>
        </p>
        
        <p> isCourier : <br>
            <input type="radio" name="isCourier" value=true>True
            <input type="radio" name="isCourier" value=false>False
        </p>
        
        
      
      

      <input class = 'btn-warning' type='submit' value='Upload' name='but_upload'>
    </form>
        
    </div>

    
  </body>
</html>