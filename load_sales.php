<?php

$conn = new mysqli("localhost","root","","digital arts and nfts_db");

if($conn->connect_error){
die("Connection failed");
}

$result = $conn->query("SELECT * FROM transactions ORDER BY date DESC");

$sales = [];

while($row = $result->fetch_assoc()){
$sales[] = $row;
}

echo json_encode($sales);

$conn->close();

?>