<?php
include 'conn.php';

$id = $_POST["id"];
$password = $_POST["password"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$query = "INSERT INTO member VALUES (\"$id\", \"$password\", \"$name\",  \"$phone\", \"$email\")";

if (mysqli_query($conn, $query) === TRUE) {
    echo '<script type="text/javascript">alert("회원가입 되었습니다.");</script>';
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
//header('Location: ../main.html');
echo '<script type="text/javascript">location.href = \'../main.html\';</script>';

?>