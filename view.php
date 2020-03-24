<?php

include $_SERVER['DOCUMENT_ROOT']."/mysite/lib/db_connector.php";

//*****************************************************
$num=$id=$subject=$content=$day=$hit="";
//*****************************************************

if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

if(isset($_GET["num"])&&!empty($_GET["num"])){
    $num = test_input($_GET["num"]);
    $hit = test_input($_GET["hit"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    $sql="UPDATE `qna` SET `hit`=$hit WHERE `num`=$q_num;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql="SELECT * from `qna` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $day=$row['regist_day'];
    $hit=$row['hit'];
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" href="./css/greet.css">
<link rel="stylesheet" type="text/css" href="./css/common.css">
<script type="text/javascript" src="./js/member_form.js"></script>
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
	<div id="slide_box">
        <?php include "slide.php"; ?>
    </div>
    <!-- ************************************************************************************** -->
    <div id="content">

       <div id="col2">
         <div id="title"><img src="./img/title_greet.gif"></div>
         <div class="clear"></div>
         <div id="write_form_title"></div>
         <div class="clear"></div>
            <div id="write_form">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  조회 : <?=$hit?> &nbsp;&nbsp;&nbsp; 입력날짜: <?=$day?>
                </div>

              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"> <input type="text" name="subject" value="<?=$subject?>" readonly></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="write_row3">
                <div class="col1">내&nbsp;&nbsp;용</div>
                <div class="col2"> <textarea name="content" rows="15" cols="79" readonly><?=$content?>
                </textarea></div>
              </div><!--end of write_row3  -->
              <div class="write_line"></div>
            </div><!--end of write_form  -->

            <div id="write_button">
              <!--목록보기 -->
              <a href="./qna_list.php?page=<?=$page?>"><img src="./img/list.png"></a>

            <?php
              //세션값이 존재하면 수정기능과 삭제기능부여하기
              if(isset($_SESSION['userid'])){
                if($_SESSION['userid']=="admin" || $_SESSION['userid']==$id){
                  echo('<a href="./write_edit_form.php?mode=update&num='.$num.'"><img src="./img/modify.png"></a>&nbsp;');
                  echo('<img src="./img/delete.png" onclick="check_delete('.$num.')">&nbsp;');
                }
              }
              // 세션값이 존재하면 답변기능과 글쓰기 기능부여하기
              if(!empty($_SESSION['userid'])){
                echo '<a href="write_edit_form.php?mode=response&num='.$num.'"><img src="./img/response.png"></a>';
                echo '<a href="write_edit_form.php"><img src="./img/write.png"></a>';
              }
            ?>
            </div><!--end of write_button-->
      </div><!--end of col2  -->
      </div><!--end of content -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
<?php
//로그인확인점검
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
if ( !$userid )
{
    echo("
                <script>
                alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                history.go(-1)
                </script>
    ");
            exit;
}


 ?>
</html>
