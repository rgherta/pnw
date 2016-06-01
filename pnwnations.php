<?php
libxml_use_internal_errors(true);
header("Content-Type: text/plain");
$result = "";
$json = file_get_contents('https://politicsandwar.com/api/nations/');
$nations= json_decode($json, true);


$fp = fopen('php://output', 'a');
fputcsv($fp, array_keys($nations[nations][0]));
foreach ($nations[nations] as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

?>
