function veiw(d){ 
    $.ajax({
        type : "post",
		url : "../database/board.php?m=veiw",
        data : {"NUMBER" : d.value,"view":"view"},
		success : function(data){
            $("#aa").html(data);
            $.ajax({
                type : "post",
                url : "../database/board.php?m=veiw",
                data : {"NUMBER" : d.value,"view":"hit"},
                success : function(hit_d){
                    $("#hit"+d.value).html(hit_d);
                    com_list(d);
                }
            })
        }
    })
}

function veiw_m(d){
    $.ajax({
        type : "post",
		url : "../database/board.php?m=veiw",
        data : {"NUMBER" : d.value,"view":"modify"},        
		success : function(data){
            $("#aa").html(data);
        }
    })
}

function delete_btn(d){
    if(confirm("삭제 하시겠습니까??")){
        $.ajax({
            type : "post",
            url : "../database/board.php?m=delete",
            data : {"NUMBER" : d.value},
            success : function(data){
                alert("삭제되었습니다.");
                location.href = '../board.html';
            }
        })
    }
}

function modify(){
    if(id.value != "" && title.value!= "" && content.value != "" ){
        if(confirm("수정하시겠습니까??")){
            $.ajax({
                type : "post",
                url : "../database/board.php?m=modify",
                data : {"title":title.value,"content":content.value,"NUMBER":number.value},
                success : function(d){
                    alert(d);
                    location.href = "board.html";
                }
            })
        }
    }else{
        alert("빈칸을 모두 채워주세요");
        return false;
    }   
    return false;
}


function com_insert(){
    if(comments.value != ""){
        $.ajax({
            type : "post",
            url : "../database/comment.php?m=insert",
            data :{"number":number.value,"comment":comments.value,"session":session.value},
            success : function(com_d){
                // document.getElementById("comments").value(null);
                comments.value = "" ;
                com_list(number);
            }
        })
    }else{
        alert("댓글을 입력해주세요");
        return false;
    }
}


function com_list(d){
    if(d.value != null) var d = d.value;
    $.ajax({
        type : "post",
        url : "../database/comment.php?m=list",
        data :{"board_number": d},
        success : function(com_d){
            console.log(com_d);
            if(com_d !='<h3>댓글</h3><table border="1px"></table>')$("#comment_s").html(com_d);
            else $("#comment_s").html("등록된 댓글이 없습니다.");
        }
    })
}

function com_delete(d){
    if(confirm("삭제하시겠습니까?")){
        $.ajax({
            type : "post",
            url : "../database/comment.php?m=delete",
            data :{"NUMBER": d.value},
            success : function(com_d){
                alert("삭제되었습니다.");
                com_list(com_d);
            }
        })
    }
}