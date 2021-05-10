<!DOCTYPE html>
<html>
<body>

<?php
// this is global variable
$color = "red";
$thisIsBoolean = true;
echo "My car is " . $color."</p>";

// this is main program excute
echo "And this is from method". returnSomeInt();
printGlobalShit();
learnGlobalArray();
if($thisIsBoolean){
    echo "</p>it is true !!!";
}
doLoopingForNoReason();
doArrayKeysValue();


//main program execute endshere


function returnSomeInt() {
    $someInt = 2342;
    return $someInt;
}

function printGlobalShit(){
    global $color;
    echo "</p>This is calling global from a function". $color;
}

function learnGlobalArray() {
  $GLOBALS[0] = "blue";
  echo "</p>this is modifying global value from accessing global array :". $GLOBALS[0];
}

function doLoopingForNoReason() {
    for ($i = 0; $i<5; $i++){
        echo "</p>this is". $i;
    }
}

function doArrayKeysValue (){
    $age = array("Peter"=>"35", "Ben"=>"Unlimited", "Joe"=>33);

    foreach($age as $x => $val) {
        echo "<br>$x = $val";
    }
    echo "<br> this like hashmap hmmm ...";
}
?> 

</body>
</html>