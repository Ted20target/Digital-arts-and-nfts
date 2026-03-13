<?php
$conn = new mysqli("localhost", "root", "", "digital arts and nfts_db");
$user = $_GET['user'];
$result = $conn->query("SELECT * FROM cart_items WHERE user='$user'");
$items = [];
while($row = $result->fetch_assoc()) $items[] = $row;
echo json_encode($items);
$conn->close();
?>