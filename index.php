<?php
include "./database/session.php";
if(isset($_SESSION['id'])){
    header('Location: ../mainpage.html');
}else{
    header('Location: ../main.html');
}
?>