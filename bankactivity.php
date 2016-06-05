<?php
libxml_use_internal_errors(true);
header("Content-Type: text/plain");
$alliance = $_GET['alliance'];
$json = file_get_contents('https://politicsandwar.com/api/nations/');
$resarray= json_decode($json);
$nations = $resarray->nations;

echo Getheader();

foreach ($nations as $nt) {
    if (strtoupper($nt->alliance) === strtoupper ($alliance)) {
        GetBankSummary($nt->nationid);
   }};
   

  GetBankSummary("30214");
  

function GetBankSummary($nation) {
    
    //retrieve DOM data
    $doctemp = new DOMDocument();
    $doctemp->loadHTMLFile("https://politicsandwar.com/nation/id=" . $nation . "&display=bank");
    $xpathtemp = new DOMXpath($doctemp);
    $nodestemp = $xpathtemp->query("//table[@class='nationtable']/tr/td");
 
    $i=1;
    foreach($nodestemp as $nodetemp) {
           $i=$i+1;
           if ($i % 18 == 0) {
            $row = $row . "\r\n";
             echo $row;
             $row="";
             $i=1;
           }
           else {
               $row = $row . str_replace(",", "", $nodetemp->nodeValue) . ",";
           }
        };
        
    //release memory
    $doctemp = null;
    $nodestemp = null;
    $xpathtemp = null;
    unset($doctemp);
    unset($nodestemp);
    unset($xpathtemp);
};

function GetHeader() {
    
     //retrieve DOM data
    $doctemp = new DOMDocument();
    $doctemp->loadHTMLFile("https://politicsandwar.com/nation/id=30214&display=bank");
    $xpathtemp = new DOMXpath($doctemp);
    $nodestemp = $xpathtemp->query("//table[@class='nationtable']/tr/th");
    
    $i=1;
    $row = "Nbr";
    
    foreach($nodestemp as $nodetemp) {
           $i=$i+1;
           if ($i % 18 == 0) {
            $row = $row . "\r\n";
             echo $row;
             $row="";
           }
           else {
               $row = $row . str_replace(",", "", $nodetemp->nodeValue) . ",";
           }
        };
        
        Return $row;
        
    //release memory
    $doctemp = null;
    $nodestemp = null;
    $xpathtemp = null;
    unset($doctemp);
    unset($nodestemp);
    unset($xpathtemp);
    
}


?>
