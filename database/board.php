<?php
include 'conn.php';
if(isset($_GET["m"])){
    $m = $_GET["m"];
    switch ($m) {
        case "insert" :
            $title = $_POST["title"];
            $content = $_POST["content"];
            $id = $_POST["id"];
            $query = "INSERT INTO board VALUES(NULL,'$title','$content','$id',NOW(),0)";

            if (mysqli_query($conn, $query)) {
                echo '<script type="text/javascript">alert("등록되었습니다.");</script>';
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
            
            mysqli_close($conn);
            echo '<script type="text/javascript">location.href = \'../board.html\';</script>';
        
        break;

        case "veiw" :
            $number = $_POST['NUMBER'];
            $view = $_POST['view'];
            $query = "SELECT * FROM board WHERE NUMBER='$number'";
            $result  = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            if($view === "modify"){
                echo print_r($row) ;
            }else{
                echo print_r($row) ;
            }
            
        break;
        
        case "delete" :
            $number = $_POST['NUMBER'];
            $query = "DELETE FROM board WHERE NUMBER='$number'";
            mysqli_query($conn,$query);
            mysqli_close($conn);
        break;
        
        default:

    }

}else{
    $query = "SELECT * FROM board";
    $result = mysqli_query($conn,$query);
    
    $html ='<table border=\"1px\"><th>번호</th><th>제목</th><th>내용</th><th>작성자</th><th>날짜</th><th>조회수</th>';
    while($row = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .=    "<td>".$row['NUMBER']."</td>";
        $html .=    "<td>".$row['title']."</td>";
        $html .=    "<td>".$row['content']."</td>";
        $html .=    "<td>".$row['id']."</td>";
        $html .=    "<td>".$row['DATE']."</td>";
        $html .=    "<td>".$row['hit']."</td>";
        $html .=    "<td><a href=\"boardmodify.html\">수정</a></td>";
        // $html .=    "<td><button onclick=\"veiw_m(this)\" value=\"".$row['NUMBER']."\">수정</button></td>";
        $html .=    "<td><button onclick=\"delete_btn(this)\" value=\"".$row['NUMBER']."\">삭제</button></td>";
        $html .= "</tr>";
    };
    $html .= "</table>";
}


?>