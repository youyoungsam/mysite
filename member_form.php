<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="./js/login.js"></script>
<style>
  span{
        visibility: hidden;
      }
</style>
</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div id="slide_box">
            <?php include "slide.php"; ?>
        </div>
        <div id="main_content">
      		<div id="join_box">
			    <h2>회원 가입</h2>
          <form method="POST" action="member_insert.php" name="signup">
            <div id="left_form">
              <ul id="left_ul">
                <li>이름 :</li>
                <li>성별 :</li>
                <li>휴대폰 번호 :</li>
                <li>이메일 :</li>
                <li>아이디 :</li>
                <li>패스워드 (6~8 글자) :</li>
                <li>패스워드 검증 :</li>
                <li>별명 :</li>
                <li><input type="button" name="" value="가입" onclick="check()"></li>
              </ul>
            </div>
            <div id="center_form">
              <ul id="center_ul">
                <li><input class="inputfeild" name="name" type="text" id="txtName" onkeyup="checkJoinForm('txtName');"></li>
                <li><input type="radio" name="C1" value="남자">남자<input type="radio" name="C1" value="여자">여자<br /></li>
                <li><input class="inputfeild" name="phonenumber" type="text" id="txtPhone" onkeyup="checkJoinForm('txtPhone');"></li>
                <li><input class="inputfeild" name="email" type="text" id="txtEmail" onkeyup="checkJoinForm('txtEmail');"></li>
                <li><input class="inputfeild" type="text" name="id" id="txtId" onkeyup="checkJoinForm('txtId');"><a href="#">
                  <img src="./img/check_id.gif"onclick="check_id()" id="check_id_btn"></a></li>
                <li><input class="inputfeild" name="password" type="text" id="txtPassword" onkeyup="checkJoinForm('txtPassword');"></li>
                <li><input class="inputfeild" type="text" name="password_confirm" id="txtPasswordCheck" onkeyup="checkJoinForm('txtPasswordCheck');"></li>
                <li><input class="inputfeild" type="text" name="nick" id="txtNick" onkeyup="checkJoinForm('txtNick');"> </li>
                <li><span id="check_ajax_nick">중복된 별명이 있습니다.</span> </li>
              </ul>
            </div>
            <div id="right_form">
              <ul id="right_ul">
                <li><span id="span_name">한글로 2-4자를 입력해주세요.</span><br /></li>
                <li><sapn ></span></li>
                <li><span id="span_phone">010-xxxx-xxxx 형식으로적어주세요.</span></li>
                <li><span id="span_email">id@domain.com 형식으로적어주세요.</span></li>
                <li><span id="span_id">아이디는 영문자로 시작하는 6-20자 영문자,숫자</span> <br></li>
                <li><span id="span_pass">패스워드는6-8숫자입니다.</span></li>
                <li><span id="span_pass2">패스워드가잘못되었습니다 확인해주세요.</span></li>
                <li><span id="span_nick">특수문자 사용불가.</span> </li>
              </ul>
            </div>
              
          </form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section>
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
