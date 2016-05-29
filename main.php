<?php
libxml_use_internal_errors(true);

$alliance = $_GET['alliance'];
$file = "https://www.politicsandwar.com/index.php?id=15&memberview=true&keyword=" . $alliance . "&cat=alliance&ob=score&od=DESC&backpage=%3C%3C&maximum=500&minimum=50" ;
$doc = new DOMDocument();
$doc->loadHTMLFile($file);
$xpath = new DOMXpath($doc);
 
$nodes = $xpath->query("//table[@class='nationtable']//a[contains(@href, 'nation')]//@href");
header("Content-type: text/plain");

foreach($nodes as $node) {
 GetDataPnW($node->nodeValue);
}



// Functions

function GetDataPnW($url) {
    
    //take nationid from url
    $nationid = substr($url, strripos($url,"=")+1, strlen($url)-strripos($url,"="));
    
    //retrieve DOM data
    $doctemp = new DOMDocument();
    $doctemp->loadHTMLFile($url);
    $xpathtemp = new DOMXpath($doctemp);
    
    $nodestemp = $xpathtemp->query("//div[@class='col-sm-6 col-xs-12']/table[@class='nationtable']/tr/td[contains(text(),'Ships:')]//following-sibling::td/text()");
    
    foreach($nodestemp as $nodetemp) {
        if ($nodetemp->nodeValue !== "0") {
            echo "NationId " . $nationid . " currently has " . $nodetemp->nodeValue . " ships \r\n";
        }
    }
    
    //release memory
    $doctemp = null;
    $nodestemp = null;
    $xpathtemp = null;
    unset($doctemp);
    unset($nodestemp);
    unset($xpathtemp);
    usleep(500);
}




?>
