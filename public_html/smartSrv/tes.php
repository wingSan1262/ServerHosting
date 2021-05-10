<?php

$array = [
    'name' => 'Jeff',
    'age' => 20,
    'active' => true,
    'colors' => ['red', 'blue'],
    'values' => [0=>'foo', 3=>'bar'],
];

$tes_array = array();
$tes_array[] = $array;
echo json_encode($tes_array);


?>