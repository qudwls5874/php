
function veiw(d){
    $.ajax({
        type : "post",
		url : "../database/board.php?m=veiw",
        data : {"NUMBER" : d.value,"view":"view"},
		success : function(data){
            
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