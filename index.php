<?php
//change this to $_POST during integration. $_GET is for test only
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
$text = str_replace("in", "", $text);
$text = str_replace("to", "", $text);

$spaces = substr_count(trim($text), " ");

//need to make sure that the currency codes are 3 letters
if($spaces == 1)
{
    //get initial currency
    $from_pos = strpos($text, " ");
    $from = trim(substr($text, $from_pos, 4));
    $text = trim(str_replace($from, "", $text));
    
    //get amount
    $amount = intval($text); 
}
else
{
    $from = trim($text);
}

//connect to Google currency converter
$get = file_get_contents('https://www.google.com/finance/converter?a='.$amount.'&from='.$from.'&to='.$to);
$get = explode("<span class=bld>",$get);
$get = explode("</span>",$get[1]);  
$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);

echo $converted_amount;

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