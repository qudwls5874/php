function id_check(d){
    $.ajax({
        type : "post",
		url : "./database/id_check.php",
		data : {"id" : d.value},
		dataType : "text",
		success : function(data){
            if(data == "null"){
                id_check_span.style.color="green";
				id_check_span.style.fontSize="10px";
				id_check_span.innerHTML = "사용가능 합니다."
            }else{
                id_check_span.style.color = "#ff0000";
				id_check_span.style.fontSize="10px";
				id_check_span.innerHTML = "사용할수 없는 id 입니다.";
            }
        },
        error : function(){
            alert("실패");
        }
    })
}