var check_sign = [false,false,false,false,false,false];

function redBox(id, res) {
    // document.getElementById(id).style.border = "2px solid red";
    if (res === "ok") {
        document.getElementById(id).style.background = "white";
    } else {
        document.getElementById(id).style.background = "red";
    }
}

function checkJoinForm(id) {
    var value1 = /^[가-힣]{2,4}$/;
    var value2 = /^[0-1]{3}-[0-9]{4}-[0-9]{4}$/;
    var value3 = /^[\w]+@[a-z]+.[a-z]+$/;
    var value4 = /^[a-z]+[a-z0-9]{5,19}$/g;
    var value5 = /^[1-9]{6,8}$/;
    var value6 = /^[가-힣 a-z A-z 0-9]{2,10}$/;


    var testStr = document.getElementById(id).value;

    switch (id) {
        case "txtName":
            if (!value1.test(testStr)) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_name").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_name").css("visibility", "hidden");
                });
                check_sign[0] = true;
            }
            break;
        case "txtPhone":
            if (!value2.test(testStr)) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_phone").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_phone").css("visibility", "hidden");
                });
                check_sign[1] = true;
            }
            break;
        case "txtEmail":
            if (!value3.test(testStr)) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_email").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_email").css("visibility", "hidden");
                });
                check_sign[2] = true;
            }
            break;
        case "txtId":
            if (!value4.test(testStr)) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_id").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_id").css("visibility", "hidden");
                });
                check_sign[3] = true;
            }
            break;
        case "txtPassword":
            if (!value5.test(testStr)) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_pass").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_pass").css("visibility", "hidden");
                });
                check_sign[4] = true;
            }
            break;
        case "txtPasswordCheck":
            if (!value5.test(testStr) || testStr !== document.getElementById('txtPassword').value) {
                redBox(id, "no");
                $(document).ready(function () {
                    $("#span_pass2").css("visibility", "visible");
                });
            } else {
                redBox(id, "ok");
                $(document).ready(function () {
                    $("#span_pass2").css("visibility", "hidden");
                });
                check_sign[5] = true;
            }
            break;
            case "txtNick":
                if (!value6.test(testStr)) {
                    redBox(id, "no");
                    $(document).ready(function () {
                        $("#span_nick").css("visibility", "visible");
                    });
                } else {
                    redBox(id, "ok");
                    $(document).ready(function () {
                        $("#span_nick").css("visibility", "hidden");

                        $.ajax({
                          url : "member_checknick.php?nick="+testStr,
                          type : "get",
                          success : function(data){
                            if(data == 1){
                              $("#check_ajax_nick").css("visibility", "visible");

                            }else{
                              $("#check_ajax_nick").css("visibility", "hidden");

                            }
                          }
                        });
                    });
                    check_sign[6] = true;
                }
                break;
    }
}
function check(){
  var ok=true;
  if(check_sign[0] == false) alert("이름이잘못됨");
  if(check_sign[1] == false) alert("폰번호가잘못됨");
  if(check_sign[2] == false) alert("이메일이잘못됨");
  if(check_sign[3] == false) alert("아이디가잘못됨");
  if(check_sign[4] == false) alert("비밀번호가잘못됨");
  if(check_sign[5] == false) alert("2차비번잘못됨");
  if(check_sign[6] == false) alert("별명잘못됨");

  for(var i=0;i<8;i++){
    if(check_sign[i]==false) ok=false;
  }
  if(ok){
    var d = new Date();
    var date = d.getFullYear()+"년"+(d.getMonth()+1)+"월"+d.getDate()+"일";
    document.signup.submit();
    //DB에저장해야하기떄문에 window 열고 php 파일불러서 처리하기
    window.open("signUpClear.php?id=" + document.signup.id.value,
                "&pass="+document.signup.password.value,
                "&name="+document.signup.password.value,
                "&phonenumber="+document.signup.phonenumber.value,
                "&gender="+document.signup.C1.value,
                "&email="+document.signup.email.value,
                "&regist_day="+date,
                "&level=1",
                "&point=0",
                "&nick="+document.signup.nick.value,

                "signUpCheck",
                "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");

  }else{
    alert(다시입력바람);
  }
}
//중복확인 php
function check_id() {
  window.open("member_check_id.php?id=" + document.signup.id.value,
      "IDcheck",
       "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
}

//로그인할때 db에서조회하고 비번 매치하고 하는함수~
function check_input()
{
    if (!document.login_form.id.value)
    {
        alert("아이디를 입력하세요");
        document.login_form.id.focus();
        return;
    }

    if (!document.login_form.pass.value)
    {
        alert("비밀번호를 입력하세요");
        document.login_form.pass.focus();
        return;
    }
    document.login_form.submit();
}
