<?php
  session_start();
  if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
  }else $userid="";


  if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
  }else $username="";


  if(isset($_SESSION["userlevel"])){
    $userlevel = $_SESSION["userlevel"];
  }else $userlevel="";


  if(isset($_SESSION["userpoint"])){
    $userpoint = $_SESSION["userpoint"];
  }else $userpoint="";

 ?>
  <div id="top">
    <h3>
      <a href="index.php">멍멍이 갤러리</a>
    </h3>
      <ul id="top_menu">
      <?php
        if(!$userid){
      ?>
      <li><a href="member_form.php">회원가입</a></li>
      <li> | </li>
      <li><a href="login_form.php">로그인</a></li>
      <?php
    }else{ $logged = $username."(".$userid.")님[level:".$userlevel.",Point:".$userpoint."]";
       ?>
       <li><?= $logged ?> </li>
       <li> | </li>
       <li><a href="logout.php">로그아웃</a></li>
       <li> | </li>
       <li><a href="member_modify_form.php">정보수정</a></li>
       <?php
          } // end of else
        ?>
        <?php
          if($userlevel==999){
         ?>
         <li> | </li>
         <li><a href="admin.php">관리자모드</a></li>
         <?php
            }// end of admin mode
         ?>
    </ul>
  </div>
  <div id="menu_bar">
    <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="message_form.php">쪽지 만들기</a></li>
      <li><a href="board_form.php">게시판 만들기</a></li>
      <li><a href="qna_list.php">문의 게시판</a></li>
    </ul>
  </div>
