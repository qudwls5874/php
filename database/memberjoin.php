<?php
include 'conn.php';

$id = $_POST["id"];
$password = $_POST["password"];
$name = $_POST["name"];
$phone = $_POST["phone"];
/*
$query = "SELECT * FROM  member WHERE id = $id";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_row($result);
*/
//if(!$row){
    $query = "INSERT INTO member (id, password, name, phone)
    VALUES ($id, $password, $name,  $phone)";
    $result = mysqli_query($conn,$query);
    echo '<script type="text/javascript">alert("회원가입 되었습니다.");</script>';
//}else{
//    echo '<script type="text/javascript">alert("아이디가 중복 되었습니다.");</script>';
//}

mysqli_close($conn);
//header('Location: ../main.html');
echo '<script type="text/javascript">location.href = \'../main.html\';</script>';

?>