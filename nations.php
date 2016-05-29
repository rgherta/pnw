<?php

libxml_use_internal_errors(true);
header("Content-type: text/plain");

$alliance = $_GET['alliance'];

$json = file_get_contents('https://politicsandwar.com/api/nations/');
$nations= json_decode($json);
$nation = $nations->nations;

foreach ($nation as $nt) {
    
    if (strtoupper($nt->alliance) === strtoupper ($alliance)) {
    echo $nt->nationid . "\r\n";
    }
}

?>
