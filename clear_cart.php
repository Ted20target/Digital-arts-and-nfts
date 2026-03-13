<?php

$conn = new mysqli("localhost","root","","digital arts and nfts_db");

if($conn->connect_error){
    die("Connection failed");
}

$user = $_POST['user'];

$conn->query("DELETE FROM cart_items WHERE user='$user'");

echo "Cart cleared";

$conn->close();

?>