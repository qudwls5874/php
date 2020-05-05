<?php
include 'conn.php';

$id = $_POST["id"];

$query = "SELECT * FROM  member WHERE id = \"$id\"";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);

if($row){
    echo "1";
}else{
    echo "0";
}
// 값 int 형으로 변형
// if(var_dump($row)==boolean){
//     var_dump($row);
// }else{
//     echo $result->num_rows;
// }


mysqli_close($conn);
?>