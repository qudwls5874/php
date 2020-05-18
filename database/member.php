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
        case "view":
            $id = $_POST["id"];
            $query = 'SELECT * FROM member WHERE ID = "'.$id.'"';
            $result=mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            $html = '<div class="list4">';
            $html .= 'ID <input type="text" id="id" value="'.$row["id"].'"readonly><br>';
            $html .= 'PASSWORD <input type="password" id="password" onkeyup="password2(this)" value="'.$row["PASSWORD"].'">';
            $html .= '<span id="pw_ck_sp"></span><br>';
            $html .= '<span id="sp_pw"></span>';
            $html .= '<span id="pw_ck_sp2"></span>';
            $html .= 'NAME <input type="text" id="names" value="'.$row["NAME"].'" onkeyup="name_ck(this)">';
            $html .= '<span id="name_ck_sp"></span><br>';
            $html .= 'PHONE <input type="text" id="phone" value="'.$row["phone"].'"><br>';
            $html .= 'EMAIL <input type="text" id="email" value="'.$row["email"].'"><br>';
            $html .= '<input type="submit" id="modify_btn" onclick="modify()" style="display: none;" value="수정하기">';
            $html .= '<button onclick="view(this)" id="modify_btn_c" value="cancel" style="display: none;">취소</button>';
            $html .= '<button onclick="delete_btn(this)" id="delete_btnid" value="'.$id.'">회원탈퇴</button>';
            $html .= '</div>';
            echo $html;
            mysqli_close($conn);
        break;
        case "modify":
            $id = $_POST["id"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $query = 'UPDATE member SET PASSWORD = "'.$password.'", NAME="'.$name.'",phone="'.$phone.'",email="'.$email.'" WHERE id="'.$id.'"';
            if(mysqli_query($conn,$query)) echo "수정되었습니다.";
            mysqli_close($conn);
        break;

        default:
          statement3;
      }
}else{
    echo "없다";
}



?>