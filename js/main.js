// document ready 와 똑같다.. 모든 문서가 로딩이 되면 자동으로 실행해주는 함수다.
$(function () {
  // 사용할 변수선언
  var slideshow = $('.slideshow'),
      slideshowSlides = slideshow.find('.slideshow_slides'),
      slides = slideshowSlides.find('a'),
      slidesCount = slides.length,
      nav = slideshow.find('.slideshow_nav'),
      prev = nav.find('.prev'),
      next = nav.find('.next'),
      currentIndex = 0, //현재슬라이드를 첫번째 화면으로 셋팅
      interval = 3000, //자동슬라이드 변화시간
      timer=null,
      indicator = slideshow.find('.indicator');

  //이벤트처리 슬라이드를 배치시킨다. 가로로 배치시킨다.
  //슬라이드0 왼쪽기준으로0% ,슬라이드1 100%,슬라이드2 200%,슬라이드3 300%
  //slides.   each == 각각 a
  slides.each(function(i){
    var newLeft = (i*100)+'%';
    $(this).css({left: newLeft});
  });

  //슬라이드 화면이동하는 함수를 생성한다.
  function gotoSlide(index){
    slideshowSlides.animate({left:(-100*index)+ '%'},1000,'easeInOutExpo' );
    currentIndex = index;
    if(currentIndex == 0){
      prev.addClass('disabled');
    }else{
      prev.removeClass('disabled');
    }

    if(index == slidesCount-1){
      next.addClass('disabled');
    }else{
      next.removeClass('disabled');
    }
    indicator.find('a').removeClass('active');
    indicator.find('a').eq(currentIndex).addClass('avtive');
  }

  //이벤트처리 네비게이션 처리진행
  prev.click(function(event){
    event.preventDefault(); // a 태그 에서 기본기능막기.
    if(currentIndex !== 0){
      currentIndex -= 1;
    }
    gotoSlide(currentIndex);
  });

  next.click(function(event){
    event.preventDefault(); // a 태그 에서 기본기능막기.
    if(currentIndex !== slidesCount-1){
      currentIndex += 1;
    }
    gotoSlide(currentIndex);
  });

  indicator.find('a').click(function(event){
    event.preventDefault();
    var point = $(this).index();
    gotoSlide(point);
  });
  //자동슬라이드함수
  //setInterval(일을하는함수 , 시간)
  function autoDisplayStart(){
    timer=setInterval(function(){
      // 0 , 1 ,2 ,3 ,0 ,1 ,2 ,3 ~~~->
      var nextIndex = (currentIndex +1) % slidesCount;
      gotoSlide(nextIndex);
    },interval);
  }
  function autoDisplayStop(timer){
    clearInterval(timer);
  }

  slideshow.mouseenter(function(event){
    autoDisplayStop(timer);
  });

  slideshow.mouseleave(function(event){
    autoDisplayStart();
  });

  autoDisplayStart();
  // gotoSlide(currentIndex);
});
