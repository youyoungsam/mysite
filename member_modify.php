<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "update members set pass='$pass', name='$name' , email='$email'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);
    //이름바꿀수있으닌깐 섹션도바꿈

    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    mysqli_close($con);

    session_start();
    $_SESSION["userid"] = $row["id"];
    $_SESSION["username"] = $row["name"];

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
