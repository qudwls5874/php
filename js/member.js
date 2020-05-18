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
            // console.log(data);
        } 
    })
}

function delete_btn(d){
    if(confirm('탈퇴하시겠습니까?')){
        location.href="../database/member.php?id="+d.value+"&m=delete";
    };

}

function view(d){
    if($("#id")[0]==null){
        $.ajax({
            type : "post",
            url : "../database/member.php?m=view",
            data : {"id" : d.value},
            success : function(data){
                $("#memberview").html(data);
            }
        })
    }else{
        if(d.value==="cancel")alert("취소되었습니다.");
        $("#memberview").html("");
    }
}

function password2(d){
    var html = 'PASSWORD_CHECK<input type="password" id="passwordck"onkeyup="pw_ck(this)">';
    $("#modify_btn").css("display","inherit");
    $("#modify_btn_c").css("display","inherit");
    $("#delete_btnid").css("display","none")
    $("#sp_pw").html(html);
    $("#pw_ck_sp2").html("<br>");
    $("#pw_ck_sp2").val("false");
    var thisIsPw = /^(?=.*\d)(?=.*[$@$!%#?&])[A-Za-z\d$@$!%*#?&]{8,14}$/;
	var pw = d.value;
	if (pw.match(thisIsPw)) {
        $("#pw_ck_sp").html("가능한 비밀번호입니다.");
		$("#pw_ck_sp").css("color","green");
        $("#pw_ck_sp").css("font-size","10px");
        $("#pw_ck_sp").val("true");
	} else {
        $("#pw_ck_sp").html("숫자,문자,특수문자 포함 8자리 이상 14자리 이하로 입력해주세요.");
		$("#pw_ck_sp").css("color","red");
        $("#pw_ck_sp").css("font-size","10px");
        $("#pw_ck_sp").val("false");
	}
}

function pw_ck(d){
    if(d.value===document.getElementById("password").value){
        $("#pw_ck_sp2").html("일치합니다.<br>");
        $("#pw_ck_sp2").css("color","green");
        $("#pw_ck_sp2").css("font-size","10px");
        $("#pw_ck_sp2").val("true");
    }else{
        $("#pw_ck_sp2").html("비밀번호가 다릅니다.<br>");
        $("#pw_ck_sp2").css("color","red");
        $("#pw_ck_sp2").css("font-size","10px");
        $("#pw_ck_sp2").val("false");
    }
}

function name_ck(d) {
    $("#modify_btn").css("display","inherit");
    $("#modify_btn_c").css("display","inherit");
    var pattern = /^[가-힣]{2,4}$|^[a-zA-Z]{2,10}$/;
	if(d.value.match(pattern)){
        $("#name_ck_sp").html("가능한 이름(별명)입니다.");
        $("#name_ck_sp").css("color","green");
        $("#name_ck_sp").css("font-size","10px");
        $("#name_ck_sp").val("true");
	}else{
        $("#name_ck_sp").html("한글은2~4(공백x),영문은2~10내외로 입력해주세요");
        $("#name_ck_sp").css("color","red");
        $("#name_ck_sp").css("font-size","10px");
        $("#name_ck_sp").val("false");
	}
}

function modify() {
    if($("#pw_ck_sp").val() != "") var pw_ck_sp = $("#pw_ck_sp").val();
    else var pw_ck_sp = "true";
    if($("#pw_ck_sp2").val() != "") var pw_ck_sp2 = $("#pw_ck_sp2").val();
    else var pw_ck_sp2 = "true";
    if($("#name_ck_sp").val() != "" ) var name_ck_sp = $("#name_ck_sp").val(); 
    else var name_ck_sp = "true";
	if(pw_ck_sp == "true" && pw_ck_sp2=="true" && name_ck_sp =="true"){
        $.ajax({
            type : "post",
            url : "../database/member.php?m=modify",
            data : {"id" : id.value,"password":password.value,"name":names.value,"phone":phone.value,"email":email.value},
            success:function(data){
                alert(data);
                location.href = "mainpage.html";
            }
        })
	}else{
		alert("입력란을 확인해주세요.")
    }
}