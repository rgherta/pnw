<?php

libxml_use_internal_errors(true);

$alliance = $_GET['alliance'];
$result = "";

$json = file_get_contents('https://politicsandwar.com/api/nations/');

$nations= json_decode($json);
$nation = $nations->nations;

foreach ($nation as $nt) {
    
    if (strtoupper($nt->alliance) === strtoupper ($alliance)) {
    $result = $result . GetNationStats($nt->nationid) ;
    }
}

$result = "[" . substr_replace($result, "", strrpos($result, ",")) . "]" ;


$resultarray = json_decode($result, true);

$fp = fopen('php://output', 'a');
fputcsv($fp, array_keys($resultarray[0]));

foreach ($resultarray as $row) {
    fputcsv($fp, $row);
}
fclose($fp);


//Functions

function GetNationStats($nationid) {
    
    $json = file_get_contents('https://politicsandwar.com/api/nation/id=' . $nationid);
    
    return $json . ", ";

    $json = null;
    unset($json);
    
}

?>

