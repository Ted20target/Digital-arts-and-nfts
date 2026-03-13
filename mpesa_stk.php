<?php

$consumerKey = "YOUR_CONSUMER_KEY";
$consumerSecret = "YOUR_CONSUMER_SECRET";

$BusinessShortCode = "174379";
$Passkey = "YOUR_PASSKEY";

$phone = $_POST['phone'];
$amount = $_POST['amount'];

$timestamp = date("YmdHis");
$password = base64_encode($BusinessShortCode.$Passkey.$timestamp);

/* get access token */

$url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

$credentials=base64_encode($consumerKey.":".$consumerSecret);

$curl=curl_init();

curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Authorization: Basic ".$credentials));
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$result=curl_exec($curl);
$token=json_decode($result)->access_token;

/* STK PUSH */

$url="https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

$data=array(

"BusinessShortCode"=>$BusinessShortCode,
"Password"=>$password,
"Timestamp"=>$timestamp,
"TransactionType"=>"CustomerPayBillOnline",
"Amount"=>$amount,
"PartyA"=>$phone,
"PartyB"=>$BusinessShortCode,
"PhoneNumber"=>$phone,
"CallBackURL"=>"https://yourdomain.com/callback.php",
"AccountReference"=>"NFTMarket",
"TransactionDesc"=>"NFT Purchase"

);

$data_string=json_encode($data);

$curl=curl_init($url);

curl_setopt($curl,CURLOPT_HTTPHEADER,array(
"Content-Type:application/json",
"Authorization:Bearer ".$token
));

curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,$data_string);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

$response=curl_exec($curl);

echo json_encode(["success"=>true]);

?>