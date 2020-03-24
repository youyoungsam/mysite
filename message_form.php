<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>message</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
    function check_input(){
      if(!document.message_form.rv_id.value){
        alert("받는 사람을 입력해 주세욤");
        document.message_form.rv_id.focus();
        return;
      }
      if(!document.message_form.subject.value){
        alert("제목을 입력해주세요");
        document.message_form.subject.focus();
        return;
      }
      if(!document.message_form.content.value){
        alert("내용을 입력하세요..");
        document.message_form.content.focus();
        return;
      }
      document.message_form.submit();
    }
    </script>
  </head>
  <body>
    <header>
      <?php include "header.php"; ?>
    </header>
    <?php
      if(!$userid){
        echo ("<script>
              alert('로그인 하고 이용해주세요.');
              history.go(-1);
              </script>
        ");
        exit;
      }
     ?>
    <section>
      <div id="slide_box">
        <?php include "slide.php"; ?>
      </div>

      <div id="message_box">
        <h3 id="write_title">메세지 보내기</h3>
        <ul class="top_buttons">
          <li><span><a href="message_box.php?mode=rv">메세지 수신함</a></span></li>
          <li><span><a href="message_box.php?mode=send">메세지 송신함</a></span></li>
        </ul>

        <form name="message_form" action="message_insert.php?send_id=<?= $userid ?>" method="post">
          <div id="write_msg">
            <ul>
              <li>
                <span class="col1">보내는 사람 : </span>
                <span class="col2"><?=$userid?></span>
              </li>
              <li>
                <span class="col1">받는 사람(id) : </span>
                <span class="col2"><input type="text" name="rv_id" value=""> </span>
              </li>
              <li>
                <span class="col1">제목 : </span>
                <span class="col2"><input type="text" name="subject" value=""> </span>
              </li>
              <li id="text_area">
                <span class="col1">내용 : </span>
                <span class="col2">
                <textarea name="content"></textarea>
                </span>

              </li>
            </ul>
            <button type="button" onclick="check_input()">보내기</button>
          </div>
        </form>
      </div> <!--message_box-->
    </section>
    <footer>
      <?php include "footer.php"; ?>
    </footer>
  </body>
</html>
