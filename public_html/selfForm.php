<html>
<body>



<?php
// Dashboard

echo "Dashboard </p>";
echo "<b>Today is </b>" . date("<b>Y/m/d</b>") . "<br>";
echo "<b>Today is</b> " . date("<b>Y.m.d</b>") . "<br>";

// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";
echo "inside php inputs </p>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  if (empty($_POST["gender"])){
      // do nothing
  } else {
      $gender = test_input($_POST["gender"]);
  }
  
 
  
  if (empty($name)) {
    $name = "Name is required";
    showNameError($name);
  } else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
    // check if name only contains letters and whitespace
    $name = "Only letters and white space allowed";
    showNameError($name);
  } else {
    showRetrievedData($email, $name, $website, $comment, $gender);
  }
  
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function showNameError ($name){
    echo $name;
}
function showRetrievedData($email, $name, $website, $comment, $gender){
    echo $email. "</p>";
    echo $name. "</p>";
    echo $website. "</p>";
    echo $comment. "</p>";
    echo $gender. "</p>";
}

// end of php service
?>

<h1 style="color:red;font-size:15px;" size="1">*required fields</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name" value="<?php echo $name;?>"> <h0 style="color:red;font-size:15px;" size="1">  *</h0></br>
E-mail: <input type="text" name="email" value="<?php echo $email;?>"></br>
Website: <input type="text" name="website" value="<?php echo $website;?>"></br>
Comment: <textarea name="comment" rows="5" cols="40"> <?php echo $comment;?> </textarea></br>

Gender:
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="other">Other

<input type="submit">
</form>



</body>
</html>