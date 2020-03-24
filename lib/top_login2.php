<div id="logo">
  <a href="../index.php"><img src="../img/logo.gif" border=0></a>
</div>
<div id="moto">
  <img src="../img/moto.gif">
</div>
<div id="top_login">
  <?php
    if(!isset($_SESSION['userid'])){
      echo ('<a href="../login/login_form.php">로그인</a> |');
      echo ('<a href="../member/member_form.php">회원가입</a> |');
    }else{
      echo (" {$_SESSION['usernick']}
      (level: {$_SESSION['userlevel']})|");
      echo ('<a href="../login/logout.php">로그아웃</a> |');
      echo ('<a href="../login/member_form_modify.php">정보수정</a> |');
    }
  ?>
</div>
