<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main_secssion.css">
    <script src="./js/vendor/modernizr.custom.min.js"></script>
    <script src="./js/vendor/jquery-1.10.2.min.js"></script>
    <script src="./js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="./js/main.js"></script>
  </head>
  <body>
    <div id="main_img_bar">
      <div class="slideshow">
        <div class="slideshow_slides">
          <a href="#"> <img src="./img/arongTnT.jpg" alt="slide1"> </a>
          <a href="#"> <img src="./img/arong_face.jpg" alt="slide2"> </a>
          <a href="#"> <img src="./img/arong_pants.jpg" alt="slide3"> </a>
          <a href="#"> <img src="./img/arongball.jpg" alt="slide4"> </a>
    </div>
    <div class="slideshow_nav">
      <a href="#" class="prev">prev</a>
      <a href="#" class="next">next</a>
    </div>
    <div class="indicator">
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
      <a href="#">&nbsp;</a>
      </div>
      </div>


    </div>
  </body>
</html>

<div id="main_content">
    <div id="latest">
        <h4>최근 게시글</h4>
        <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
  $con = mysqli_connect("localhost", "root", "123456", "sample");
  $sql = "select * from board order by num desc limit 5";
  $result = mysqli_query($con, $sql);

  if (!$result)
    echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
  else{
    while( $row = mysqli_fetch_array($result) ){
      $regist_day = substr($row["regist_day"], 0, 10);
 ?>
        <li>
            <span><?=$row["subject"]?></span>
            <span><?=$row["name"]?></span>
            <span><?=$regist_day?></span>
        </li>
 <?php
       }
     }
     mysqli_close($con);
 ?>
    </div>
    <div id="point_rank">
        <h4>포인트 랭킹</h4>
        <ul>
  <!-- 포인트 랭킹 표시하기 -->
  <?php
    $rank = 1;
    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "select * from members order by point desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
      echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
    else{
      while( $row = mysqli_fetch_array($result) ){
        $name  = $row["name"];
        $id    = $row["id"];
        $point = $row["point"];
        $name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1);
        // mb_substr 은 한글을가져와서 자르는 정의되어 있는함수 유*삼 <- 이런식으로
   ?>
          <li>
              <span><?=$rank?></span>
              <span><?=$name?></span>
              <span><?=$id?></span>
              <span><?=$point?></span>
          </li>
  <?php
      $rank++;
        }
      }
  mysqli_close($con);
  ?>
          </ul>
      </div>
  </div>
