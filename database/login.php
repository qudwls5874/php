<?php
include 'conn.php';
$id = $_POST["id"];
$password = $_POST["password"];

$query = "SELECT * FROM member WHERE ID = \"$id\"";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

if($row){
    echo "1";
    // var_dump($row);
    print_r($row);
}else{
    
}




//mysqli_query($conn,);
?>