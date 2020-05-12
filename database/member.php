<?php
include 'conn.php';
if(isset($_GET["m"])){
    $m = $_GET["m"];
    switch ( $m ) {
        case "join":            

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
            echo '<script type="text/javascript">location.href = \'../main.html\';</script>';
        break;


        case "delete":
            include "session.php";
            $id = $_GET["id"];
            $query = "DELETE FROM member WHERE ID = \"$id\" ";

            if(mysqli_query($conn,$query)) echo '<script type="text/javascript">alert("탈퇴 되었습니다.");</script>';
            mysqli_close($conn);
            session_unset();
            session_destroy();
            echo '<script type="text/javascript">location.href = \'../index.php\';</script>';
        break;

        case "out":
            include "session.php";
            session_unset();
            session_destroy();
            header('location: ../index.php');

        break;
        case "login":
            $id = $_POST["id"];
            $password = $_POST["password"];
            if($password){
                $query = "SELECT * FROM  member WHERE id = \"$id\"";
                $result = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($result);
                if($row){
                    if($row['PASSWORD']== $password){
                        session_start();
                        $_SESSION["id"] = $id;
                        echo "ok";
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
        break;

        default:
          statement3;
      }
}else{
    echo "없다";
}



?>