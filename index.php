<?php
//Get values from Slack
$command = $_GET['command'];
$text = $_GET['text'];

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

//connect to Google currency converter
$get = file_get_contents('https://www.google.com/finance/converter?a=1&from='.$from.'&to='.$to);
$get = explode("<span class=bld>",$get);
$get = explode("</span>",$get[1]);  
$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);

echo "1 ".strtoupper($from)." = ".$converted_amount." ".strtoupper($to);

?>