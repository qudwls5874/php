<?php
$db_host = "localhost";
$db_user = "root";
$db_passwd = "3759";
$db_name = "php_project";
$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

/*
if (mysqli_connect_errno($conn)) {
echo "데이터베이스 연결 실패: " . mysqli_connect_error();
} else {
echo "성공~!!!";
}
*/
?>