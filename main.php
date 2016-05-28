<?php
libxml_use_internal_errors(true);

$alliance = $_GET['alliance'];
$file = "https://www.politicsandwar.com/index.php?id=15&memberview=true&keyword=" . $alliance . "&cat=alliance&ob=score&od=DESC&backpage=%3C%3C&maximum=500&minimum=50" ;
$doc = new \DOMDocument();
$doc->loadHTMLFile($file);

$xpath = new DOMXpath($doc);
 
$nodes = $xpath->query("//table[@class='nationtable']//a[contains(@href, 'nation')]//@href");
header("Content-type: text/plain");

foreach($nodes as $node) {
 echo $node->nodeValue . "\r\n" ;
}

?>