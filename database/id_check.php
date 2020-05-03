<?php
include 'conn.php';

$id = $_POST["id"];

$query = "SELECT * FROM  member WHERE id = $id";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);

if($row != NULL){
             // 값 int(0) 형으로 변형
    var_dump($result->num_rows);
}else{
    echo"null";
}

mysqli_close($conn);
?>