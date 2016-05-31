<?php

libxml_use_internal_errors(true);
header("Content-Type: text/plain");

$alliance = $_GET['alliance'];
$result = "";
$resultcities = "" ;

$json = file_get_contents('https://politicsandwar.com/api/nations/');

$nations= json_decode($json);
$nation = $nations->nations;

//Get Nation Stats(inc cities)
foreach ($nation as $nt) {
    if (strtoupper($nt->alliance) === strtoupper ($alliance)) {
    $result = $result . GetNationStats($nt->nationid) ;
    }
};

$result = "[" . substr_replace($result, "", strrpos($result, ",")) . "]" ;

$resultarray = json_decode($result, true);

//Adds Array Headers and values
for ($k = 0; $k <= count($resultarray)-1; $k++) {
    for ($i = 1; $i <= $resultarray[$k][cities] ; $i++) {
       $resultcities = $resultcities . GetCities($resultarray[$k][cityids][$i-1]) ;
    };
};

$resultcities = "[" . substr_replace($resultcities, "", strrpos($resultcities, ",")) . "]" ; //removes last comma



//Save as array and print csv
$resultarray = json_decode($resultcities, true);
$fp = fopen('php://output', 'a');
fputcsv($fp, array_keys($resultarray[0]));
foreach ($resultarray as $row) {
   fputcsv($fp, $row);
};
fclose($fp);


//Functions

function GetNationStats($nationid) {
    
    $json = file_get_contents('https://politicsandwar.com/api/nation/id=' . $nationid);
    
    return $json . ", ";

    $json = null;
    unset($json);
    
}

function GetCities($cityid) {
    
    $json = file_get_contents('https://politicsandwar.com/api/city/id=' . $cityid);
    
    return $json . ", ";

    $json = null;
    unset($json);
    
}

?>

