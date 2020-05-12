function login_btn(){
    var id = document.getElementById("id").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type : "post",
		url : "../database/member.php?m=login",
        data : {"id" : id,
                "password" : password},
		success : function(data){
            if(data === "ok"){
                location.href = '../mainpage.html';
            }else{
                alert(data);
            }
            console.log(data);
        } 
    })
}

function delete_btn(d){
    console.log(d.value);
    if(confirm('탈퇴하시겠습니까?')){
        location.href="../database/member.php?id="+d.value+"&m=delete";
    };

}