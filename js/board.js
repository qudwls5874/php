
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
    location.href="../";
    // $.ajax({
    //     type : "post",
	// 	url : "../database/board.php?m=veiw",
    //     data : {"NUMBER" : d.value,"view":"modify"},
	// 	success : function(data){

    //     }
    // })
}


// function veiw_m(d){
//     $.ajax({
//         type : "post",
// 		url : "../database/board.php?m=veiw",
//         data : {"NUMBER" : d.value,"view":"modify"},
// 		success : function(data){
//             var output = '';
//             var output ='<form action="database/board.php?m=insert" method="POST" id="view">';
//             var output ='<input type="text" name="title" placeholder="제목"><br>'
//             var output ='<input type="text" name="id" value="'+data[id]+'" readonly ><br>';
//             var output ='<textarea name="content" placeholder="내용" value="'+data[content+'"></textarea><br>';
//             var output ='<input type="submit" value="작성하기">';
//             var output ='</form>';
//             $("#view").html(output);
//         }
//     })
// }

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