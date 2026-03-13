<?php

$conn = new mysqli("localhost","root","","digital arts and nfts_db");

if($conn->connect_error){
die("Connection failed");
}

$user = $_POST['user'];
$nft_name = $_POST['nft_name'];
$creator = $_POST['creator'];
$price = $_POST['price'];
$currency = $_POST['currency'];
$paid_via = $_POST['paid_via'];
$payment_info = $_POST['payment_info'];

$stmt = $conn->prepare("INSERT INTO transactions (user,nft_name,creator,price,currency,paid_via,payment_info) VALUES (?,?,?,?,?,?,?)");

$stmt->bind_param("sssdsss",$user,$nft_name,$creator,$price,$currency,$paid_via,$payment_info);

$stmt->execute();

$stmt->close();
$conn->close();

echo "Transaction saved";

?>