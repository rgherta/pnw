<?php
libxml_use_internal_errors(true);

$nationid = $_GET['id'];

$file = "https://politicsandwar.com/nation/id=" . $nationid ;
$doc = new DOMDocument();
$doc->loadHTMLFile($file);
$xpath = new DOMXpath($doc);

//Multiple Nationtable class tables. Only way to Anchor as of now is to use div class 'col-sm-6 col-xs-12' . Might have to revise in the future.
 
$nodes = $xpath->query("//div[@class='col-sm-6 col-xs-12']/table[@class='nationtable']/tr/td[contains(text(),'Ships:')]//following-sibling::td/text()"); 
header("Content-type: text/plain");

//print_r($nodes);

foreach($nodes as $node) {
echo "NationId " . $nationid . " currently has " . $node->nodeValue . " ships \r\n";
};


?>
