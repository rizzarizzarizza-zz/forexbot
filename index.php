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

/*
// set API Endpoint, Access Key, required parameters
$access_key = 'b30c9800062ca4c5ba7ce2528bb5944e';

// initialize CURL:
$ch = curl_init('http://apilayer.net/api/live?access_key='.$access_key.'&currencies='.$from.','.$to.'');   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the (still encoded) JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
echo $conversionResult['success'];
*/

?>