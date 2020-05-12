<?php
include 'conn.php';
if(isset($_GET["m"])){
    $m = $_GET["m"];
    switch ($m) {
        case "insert" :
            $comment = $_POST["comment"];
            $number = $_POST["number"];
            $id = $_POST["session"];
            $query = "INSERT INTO comments VALUES(NULL,'$number','$id','$comment',NOW(),0)";
            mysqli_query($conn, $query);
            mysqli_close($conn);
        
        break;

        case "list" :
            include 'session.php';
            $board_number = $_POST['board_number'];
            $result = mysqli_query($conn,"SELECT * FROM comments WHERE board_number='$board_number'");
            $html = '<h3>댓글</h3><table border="1px">';
            while($row = mysqli_fetch_array($result)){
                $html .= "<tr>";
                $html .=    "<td>".$row['id']."</td>";
                $html .=    '<td style="width:35%;">'.$row['content'].'</td>';   
                $html .=    "<td>".$row['DATE']."</td>";
                if($_SESSION['id']===$row['id']){  
                    $html .=    '<td><button onclick="com_delete(this)" value="'.$row['NUMBER'].'">삭제</button></td>';     
                }
                $html .= "</tr>";
            };
            $html .= "</table>";
            echo $html ;
        break;

        case "delete" :
            $number = $_POST['NUMBER'];
            $row = mysqli_fetch_array(mysqli_query($conn,"SELECT board_number FROM comments WHERE NUMBER ='$number'"));
            if(mysqli_query($conn,"DELETE FROM comments WHERE NUMBER='$number'")){
                echo $row['board_number'];
            }else{
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            };

        break;

        default:
    }
}
?>