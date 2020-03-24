<?php
session_start();
if(!isset($_SESSION['userid'])){
  echo "<script>alert('권한없음!');history.go(-1);</script>";
  exit;
}
?>
