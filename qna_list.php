<?php
include $_SERVER['DOCUMENT_ROOT']."/mysite/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/mysite/lib/create_table.php";
create_table($conn,'qna');//가입인사게시판테이블생성
define('SCALE', 10);
//*****************************************************
$sql=$result=$total_record=$total_page=$start="";
$row="";
$memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
$total_record=0;
//*****************************************************
//찾기버튼누르고 db에서 조회해서 가져오기
if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 아이디 콤보박스
  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql="SELECT * from `qna` where $find like '%$q_search%' order by num desc;";
}else{
  $sql="SELECT * from `qna` order by group_num desc, ord asc;";
}

$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);
$total_page=($total_record % SCALE == 0 )?
($total_record/SCALE):(ceil($total_record/SCALE));
//ceil 올림 +1
//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

//3.현재페이지 시작번호계산함.
$start=($page -1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;
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
         <div id="title">
           <img src="./img/title_qna.gif" alt="">
         </div>
          <form name="board_form" action="qna_list.php?mode=search" method="post">
           <div id="list_search">
             <div id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</div>
             <div id="list_search2"> <img src="./img/select_search.gif"></div>
             <div id="list_search3">
               <select  name="find">
                 <option value="subject">제목</option>
                 <option value="content">내용</option>
                 <option value="id">아이디</option>
               </select>
             </div><!--end of list_search3  -->
             <div id="list_search4"><input type="text" name="search"></div>
             <div id="list_search5"> <input type="image" src="./img/list_search_button.gif"></div>
           </div><!--end of list_search  -->
         </form>
         <div id="clear"></div>
         <div id="list_top_title">
           <ul>
             <li id="list_title1"><img src="./img/list_title1.gif"></li>
             <li id="list_title2"><img src="./img/list_title2.gif"></li>
             <li id="list_title3"><img src="./img/list_title3.gif"></li>
             <li id="list_title4"><img src="./img/list_title4.gif"></li>
             <li id="list_title5"><img src="./img/list_title5.gif"></li>
           </ul>
         </div><!--end of list_top_title  -->

         <div id="list_content">

         <?php
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $num=$row['num'];
            $id=$row['id'];
            $name=$row['name'];
            $nick=$row['nick'];
            $hit=$row['hit'];
            $date= substr($row['regist_day'],0,10);
            $subject=$row['subject'];
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
            $space="";
            for($j=0;$j<$depth;$j++){
              $space="&nbsp;&nbsp;".$space;
            }
        ?>
            <div id="list_item">
              <div id="list_item1"><?=$number?></div>
              <div id="list_item2">
                  <a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$space.$subject?></a>
              </div>
              <div id="list_item3"><?=$id?></div>
              <div id="list_item4"><?=$date?></div>
              <div id="list_item5"><?=$hit?></div>
            </div><!--end of list_item -->
            <div id="memo_content"><?=$memo_content?></div>
        <?php
            $number--;
         }//end of for
        ?>

        <div id="page_button">
          <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
          <?php
            for ($i=1; $i <= $total_page ; $i++) {
              if($page==$i){
                echo "<b>&nbsp;$i&nbsp;</b>";
              }else{
                echo "<a href='./list.php?page=$i'>&nbsp;$i&nbsp;</a>";
              }
            }
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
          <br><br><br><br><br><br><br>
        </div><!--end of page num -->
        <div id="button">
          <!--목록 버튼  -->
          <a href="./qna_list.php?page=<?=$page?>"> <img src="./img/list.png" alt="">&nbsp;</a>
          <?php
            //세션아디가 있으면 글쓰기 버튼을 보여줌.
            if(!empty($_SESSION['userid'])){
            echo '<a href="write_edit_form.php"><img src="./img/write.png"></a>';
            }
          ?>
        </div><!--end of button -->
      </div><!--end of page button -->
      </div><!--end of list content -->
      </div><!--end of col2  -->
    </div><!-- end of content -->
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
