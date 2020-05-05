function login_btn(){
    var id = document.getElementById("id").value;
    var password = document.getElementById("password").value;
    $.ajax({
        type : "post",
		url : "../database/id_check2.php",
		data : {"id" : id},
		dataType : "json",
		success : function(data){
            console.log(data);
        }
    })
}