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
            if($view === "view") mysqli_query($conn,"UPDATE board SET hit = hit+1 WHERE NUMBER = '$number'");
            $query = "SELECT * FROM board WHERE NUMBER='$number'";
            $result  = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            if($view === "modify"){
                $html = "<h1>글수정</h1><form method=\"POST\" id=\"view\" onsubmit=\"return false\">";
                $html .= "<input type=\"hidden\" id=\"number\" value=\"".$row['NUMBER']."\"><br>";
                $html .= "<input type=\"text\" id=\"title\" placeholder=\"제목\" value=\"".$row['title']."\"><br>";
                $html .= "<input type=\"text\" id=\"id\" value=\"".$row['id']."\" readonly ><br>";
                $html .= "<textarea id=\"content\" placeholder=\"내용\" value=\"".$row['content']."\">".$row['content']."</textarea><br>";
                $html .= "<input type=\"submit\" onclick=\"modify()\" value=\"수정하기\">";
                $html .= "</form><a href=\"board.html\">취소</a>";
                echo $html;                 
            }else if($view === "view"){
                include 'session.php' ;           
                $html = "<input type=\"text\" id=\"title\" value=\"".$row['title']."\" readonly><br>";
                $html .= "<input type=\"text\" id=\"id\" value=\"".$row['id']."\" readonly ><br>";
                $html .= "<textarea id=\"content\" value=\"".$row['content']."\" readonly>".$row['content']."</textarea><br>";
                $html .= "<form  method=\"POST\" onsubmit=\"return false\">";
                $html .= "<input type=\"hidden\" id=\"session\" value=\"".$_SESSION['id']."\">";
                $html .= "<input type=\"hidden\" id=\"number\" value=\"".$row['NUMBER']."\">";
                $html .= "<input type=\"text\" id=\"comments\" placeholder=\"댓글 내용\">";
                $html .= "<input type=\"submit\" onclick=\"com_insert()\" value=\"등록\"></form>";
                echo $html;
            }else{
                $hit = $row['hit'];
                echo $hit;
            }
            mysqli_close($conn);
        break;

        case "modify" :
            $num = $_POST["NUMBER"];
            $title  = $_POST["title"];
            $content = $_POST["content"];
            $query = "UPDATE board SET title = '$title',content= '$content' WHERE NUMBER = '$num'";
            if(mysqli_query($conn,$query)){
                echo '수정되었습니다.';
            }else{
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            };
            mysqli_close($conn);
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
    if(!isset($_GET['page'])){
        $page = 0;        
    }else{
        $page = $_GET['page']-1;
    };
    $list = 5; // 나올 페이지 개수
    $limit = $list * $page;
    $data = mysqli_query($conn,"SELECT RN FROM board_view ORDER BY RN DESC");
    $count = mysqli_num_rows($data); // 개시물 총 개수
    $t_num = ceil($count / $list); // 하단 숫자 개수

    if($page == 0){
        $query = "SELECT * FROM board_view LIMIT $list";
    }else{
        $query = "SELECT * FROM board_view LIMIT $limit,$list";
    }
    $result = mysqli_query($conn,$query);
    

    $html ='<h1>게시판 목록</h1><table border="1px"><th>번호</th><th style="width:15%;">제목</th><th style="width:30%;">내용</th><th>작성자</th><th>날짜</th><th>조회수</th>';
    while($row = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .=    "<td>".$row['NUMBER']."</td>";
        $html .=    "<td>".$row['title']."</td>";
        $html .=    "<td><button class=\"number_btn\" onclick=\"veiw(this)\" value=\"".$row['NUMBER']."\">".$row['content']."</button></td>";
        $html .=    "<td>".$row['id']."</td>";
        $html .=    "<td>".$row['DATE']."</td>";
        $html .=    "<td><a id=\"hit".$row['NUMBER']."\">".$row['hit']."</a></td>";     
        if($_SESSION['id']===$row['id']){
            $html .=    '<td><button onclick="veiw_m(this)" value='.$row['NUMBER'].'">수정</button></td>';     
            $html .=    '<td><button onclick="delete_btn(this)" value="'.$row['NUMBER'].'">삭제</button></td>';     
        }   
        $html .= "</tr>";
    };
    $html .= "</table>";
    $html .= "<div class=\"paging\">";
    $html .= "<ul>";
    if($page!=0) $html .= "<li><a href=\"board.html\">[처음]</a></li>";
    for($i=1;$i<= $t_num;$i++) {        
        $html .= "<li><a href=\"board.html?page=".$i."\">".$i."</a></li>&emsp;";
    }
    if($page+1 != $t_num) $html .= "<li><a href=\"board.html?page=".$t_num."\">[마지막]</a></li>";
    $html .= "</ul>";
    $html .= "</div><br><br><br>";
    $html .= "<div class=\"footer\">";
    $html .= "<a href=\"boardinsert.html\">글작성</a>&emsp;";
    $html .= "<a href=\"mainpage.html\">뒤로가기</a>";
    $html .= "</div>";
}



?>