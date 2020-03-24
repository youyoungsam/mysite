<?php
    $name   = $_POST["name"];
    $gender = $_POST["C1"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $id = $_POST["id"];
    $password = $_POST["password"];
    $nick = $_POST["nick"];
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $con = mysqli_connect("localhost", "root", "123456", "sample");

  	$sql = "insert into members(id, pass, name,phonenumber,gender,email,nick, regist_day, level, point) ";
  	$sql .= "values('$id', '$password', '$name', '$phonenumber','$gender','$email','$nick','$regist_day', 9, 0)";

	  mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
