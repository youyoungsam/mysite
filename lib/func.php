<?php
function latest_article($table, $loop, $char_limit){
  global $conn;

  $sql="select * from $table order by num desc limit $loop";
  $result=mysqli_query($conn,$sql);

  while($row=mysqli_fetch_array($result)){
   $num=$row['num'];
   $hit=$row['hit'];
   $len_subject=strlen($row['subject']);
   $subject=$row['subject'];
   if($len_subject>$char_limit){
     $subject=mb_substr($row['subject'], 0, $char_limit, 'utf-8');
     $subject=$subject."...";
   }
   $regist_day=substr($row['regist_day'], 2, 9);
   echo("
    <div class='col1'>
    <a href='./$table/view.php?num=$num&hit=$hit'>$subject</a>
    </div>
    <div class='col2'>$regist_day</div>
    <div class='clear'></div>
   ");
 }

}
?>
