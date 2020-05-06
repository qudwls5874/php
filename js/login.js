function login_btn(){
    var id = document.getElementById("id").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type : "post",
		url : "../database/id_check2.php",
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