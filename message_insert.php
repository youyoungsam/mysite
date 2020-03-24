<meta charset="utf-8">
<?php
  $send_id = $_GET["send_id"];

  $rv_id = $_POST['rv_id'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];
  /*이 함수는 문자열에서 특정한 특수 문자를 HTML 엔티티로 변환한다.
  이함수를 사용하면 악성 사용자로 부터 XSS 공격을 방지 할 수 있다.
  변환되는 문자는 아래와 같다

  ENT_COMPAT : 기본모드로, 겹따옴표만 변환

  ENT_QUOTES : ''(홑따옴표) 와 ""(겹따옴표) 둘다 변환

  ENT_NOQUOTES : ''(홑따옴표) 와 ""(곁따옴표) 둘다 변환하지 않음*/
  $subject = htmlspecialchars($subject, ENT_QUOTES);
  $content = htmlspecialchars($content, ENT_QUOTES);
  $regist_day = date("Y-m-d (H:i)");
  if(!$send_id){
    echo("
      <script>
      alert('로그인 후에 이용해라');
      history.go(-1)
      </script>
    ");
    exit;
  }

  $con = mysqli_connect("localhost","root","123456","sample");
  $sql = "select * from members where id='$rv_id'";
  $result = mysqli_query($con,$sql);
  $num_record = mysqli_num_rows($result);
  if($num_record){
    $sql = "insert into message (send_id, rv_id, subject, content, regist_day)";
    $sql .= "values('$send_id','$rv_id','$subject','$content','$regist_day')";
    mysqli_query($con,$sql);
  }else{
    echo ("
      <script>
      alert('수신 아이디가 잘못 되었습니다.');
      history.go(-1)
      </script>
    ");
    exit;
  }
  mysqli_close($con);
  echo "
     <script>
     location.href = 'message_box.php?mode=send';
     </script>
  ";
 ?>
