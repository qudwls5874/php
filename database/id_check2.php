<?php
include 'conn.php';

$id = $_POST["id"];

$query = "SELECT * FROM  member WHERE id = \"$id\"";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

$ss = print_r($row);

echo $ss ;
mysqli_close($conn);
?>