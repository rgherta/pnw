<?php
libxml_use_internal_errors(true);
header("Content-Type: text/plain");
$result = "";
$number = $_GET['number'];
$json = file_get_contents('https://politicsandwar.com/api/wars/' . $number);
$wars= json_decode($json, true);


$fp = fopen('php://output', 'a');
fputcsv($fp, array_keys($wars[wars][0]));
foreach ($wars[wars] as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

?>
