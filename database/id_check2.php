<?php
include 'conn.php';

$id = $_POST["id"];
$password = $_POST["password"];
if($password){
    $query = "SELECT * FROM  member WHERE id = \"$id\"";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    if($row){
        if($row['PASSWORD']== $password){
            $_SESSION["id"] = $id;
            session_start();
            echo "ok";
            // print_r($_SESSION);
            // var_dump($_SESSION);
        }else{
            echo "비밀번호가 다릅니다.";
        }   
    }else{
        echo "해당 id가 없습니다.";
    }
}else{
    echo "비밀번호를 입력해주세요.";
}




mysqli_close($conn);
?>