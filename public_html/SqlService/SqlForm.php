<html>
<body>
<?php
// Dashboard
$url = "https://badcodegr.000webhostapp.com/SqlService/tryReceivePost.php";
echo "Dashboard </p>";
echo "<b>Today is </b>" . date("<b>Y/m/d</b>") . "<br>";
echo "<b>Today is</b> " . date("<b>Y.m.d</b>") . "<br>";

// define variables and set to empty values
$time = null;
$temperature = 0;
$isFanOn = $isTherePerson = false;
echo "inside php inputs </p>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //fill time
  if(!empty($_POST["timeBoolean"]) && !empty($_POST["isFanOn"]) && !empty($_POST["isTherePerson"])){
      $time = date("H:i:s");
        $temperature = test_input($_POST["temperature"]);
        $isFanOn = test_input($_POST["isFanOn"]);
        $isTherePerson = test_input($_POST["isTherePerson"]);
  }
  
  // simple validation
  if ($temperature === 0 || $time === null) {
    showNameError($time, $temperature, $isFanOn, $isTherePerson);
  } else {
    showRetrievedData($time, $temperature, $isFanOn, $isTherePerson, $url);
  }
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

function showRetrievedData ($time, $temperature, $isFanOn, $isTherePerson, $url){
    echo $time. "</p>";
    echo $temperature. "</p>";
    echo $isFanOn. "</p>";
    echo $isTherePerson. "</p>";
    
    
    $response = httpPost($url, array("time"=>"$time", "temperature"=>"$temperature", "isFanOn"=>"$isFanOn", "isTherePerson"=>"$isTherePerson"));
    
    echo $response;
    if ($response === "OK") {
        echo "OK";
    }
}

function httpPost($url, $data){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// end of php service
?>

<h1 style="color:red;font-size:15px;" size="1">*required fields</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="number" required name="temperature" min="0" value=$temperature step="1"> <h0 style="color:black;font-size:15px;" size="1">  C</h0></br> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>

time:
<input type="radio" name="timeBoolean" value=true>True
</br>
</br>
isFanOn:
<input type="radio" name="isFanOn" value=true>True
<input type="radio" name="isFanOn" value=false>False
</br>
</br>
isTherePerson:
<input type="radio" name="isTherePerson" value=true>True
<input type="radio" name="isTherePerson" value=false>False
</br>
</br>
<input type="submit">
</form>



</body>
</html>