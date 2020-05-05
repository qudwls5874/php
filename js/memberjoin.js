function id_ck(d){
    $.ajax({
        type : "post",
		url : "./database/id_check.php",
		data : {"id" : d.value},
		dataType : "text",
		success : function(data){
            if(data != '1'){
                id_ck_sp.style.color="green";
				id_ck_sp.style.fontSize="10px";
				id_ck_sp.innerHTML = "사용가능 합니다."
            }else{
                id_ck_sp.style.color = "#ff0000";
				id_ck_sp.style.fontSize="10px";
				id_ck_sp.innerHTML = "사용할수 없는 id 입니다.";
            }
        },
        error : function(){
            alert("실패");
        }
    })
}

function pw(d) {
	var thisIsPw = /^(?=.*\d)(?=.*[$@$!%#?&])[A-Za-z\d$@$!%*#?&]{8,14}$/;
	var pw = d.value;
	if (pw.match(thisIsPw)) {
		pw_ck_sp.innerHTML = "가능한 비밀번호입니다.";
		pw_ck_sp.style.color = "green";
		pw_ck_sp.style.fontSize = "10px";
	} else {
		pw_ck_sp.innerHTML = "숫자,문자,특수문자 포함 8자리 이상 14자리 이하로 입력해주세요.";
		pw_ck_sp.style.color = "red";
		pw_ck_sp.style.fontSize = "10px";
	}
}

function pw_ck(d){
    var password = document.getElementById("password").value;
    if(d.value===password){
        pw_ck_sp2.style.color = "green";
		pw_ck_sp2.style.fontSize="10px";
		pw_ck_sp2.innerHTML = "일치합니다.";
    }else{
        pw_ck_sp2.style.color = "#ff0000";
		pw_ck_sp2.style.fontSize="10px";
		pw_ck_sp2.innerHTML = "비밀번호가 다릅니다.";
    }
}

function name_ck(d) {
    var pattern = /^[가-힣]{2,4}$|^[a-zA-Z]{2,10}$/;
    console.log(d.value);
	if(d.value.match(pattern)){
		name_ck_sp.innerHTML = "가능한 이름(별명)입니다.";
		name_ck_sp.style.color = "green";
		name_ck_sp.style.fontSize = "10px";
	}else{
		name_ck_sp.innerHTML = "한글은2~4(공백x),영문은2~10내외로 입력해주세요";
		name_ck_sp.style.color = "red";
		name_ck_sp.style.fontSize = "10px";
	}
}

function joinForm_ck() {
	var id_ck_sp = document.getElementById("id_ck_sp").innerHTML;	
    var pw_ck_sp = document.getElementById("pw_ck_sp").innerHTML;
    var pw_ck_sp2 = document.getElementById("pw_ck_sp2").innerHTML;
    var name_ck_sp = document.getElementById("name_ck_sp").innerHTML;
    console.log("id_ck_sp 값: ",id_ck_sp);
    console.log("pw_ck_sp 값: ",pw_ck_sp);
    console.log("pw_ck_sp2 값: ",pw_ck_sp2);
    console.log("name_ck_sp 값: ",name_ck_sp);
	if(id_ck_sp == "사용가능 합니다." && pw_ck_sp == "가능한 비밀번호입니다." && pw_ck_sp2=="일치합니다." && name_ck_sp =="가능한 이름(별명)입니다."){
		joinForm.submit();
	}else{
		alert("입력란을 확인해주세요.")
		return false;
    }
}