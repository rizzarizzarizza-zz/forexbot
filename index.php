<?php
//Get values from Slack
$command = $_GET['command'];
$text = $_GET['text'];

$amount = 1;
$from = "";
$to = "";

//get final currency
$to_pos = strrpos($text, " ");
$to = trim(substr($text, $to_pos, 4));
$text = trim(str_replace($to, "", $text));

//remove connectors
$text = str_replace("to", "", $text);

//get initial currency
$from = trim($text);
if (strpos($from, " ") !== FALSE)
{
    $from_pos = strrpos($from, " ");
    $from = trim(substr($from, $from_pos, 4));
    $text = trim(str_replace($from, "", $text));
    
    $amount = $text;
}

//connect to Google currency converter
$get = file_get_contents('https://www.google.com/finance/converter?a='.$amount.'&from='.$from.'&to='.$to);
$get = explode("<span class=bld>",$get);
$get = explode("</span>",$get[1]);  
$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);

echo $amount." ".strtoupper($from)." = ".$converted_amount." ".strtoupper($to);

?>