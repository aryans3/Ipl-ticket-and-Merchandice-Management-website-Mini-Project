<?php
session_start();//this method will check if session exists agar exist nahi karta hai then it will redirect u to log in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPL</title>
    <link rel="stylesheet" href="style.css">
    <script
src="https://www.gstatic.com/charts/loader.js">
</script>
</head>
<style>
  .navbar a:hover{
    padding: 12px;
    background-color: orange;
    border-radius: 14px;
  }
  #main:hover{
    padding: 0px;
    background:none;
  }
</style>
<body style="margin:0";>
        <header style="z-index: 1;" >
            <nav class="navbar">
                <a href="main.php" id="main"><img id="ipllogo" src="ipllogo.png"></a>
                <div id="hi">
                <a href="#allstats">Stats</a>
                <a href="ticket.php">Buy Tickets</a>
                <a href="merch.php">Buy Merchandise</a>
                <a href="addcart.php">Your Cart</a>
                <a href="yourtic.php">My Tickets</a>
                <a href="order.php">Order History</a>
                <a href="logout.php">Log Out</a>
                </div>
            </nav>
        </header>
        <style>
          
          #s1{
            margin-top: 120px;
            margin-bottom: 120px;
          }
          #slide1{
            width: 1540px;
            height: 790px;
          }
          .first-txt {
            position: absolute;
            top: 380px;
            left: 680px;
            color: white;
          transform: scale(1.5);
            font-size: xx-large;
          transition-duration: 0.3s;
            transition-timing-function: ease-in-out;
        }
        .first-txt:hover {
          transform: scale(1.9);
          transition-duration: 0.3s;
        }
        .second-txt:hover {
          transform: scale(1.9);
          transition-duration: 0.3s;
        }
        .second-txt {
            position: absolute;
            transform: scale(1.7);
            top: 390px;
            left: 600px;
            color: white;
            font-size: xx-large;
            font-family: 'Times New Roman', Times, serif;
            transition-duration: 0.3s;
            transition-timing-function: ease-in-out;
        }
        element.style {
    background-color: #6351ce;
}
.p-4 {
    padding: 1.5rem!important;
}
.justify-content-between {
    -ms-flex-pack: justify!important;
    justify-content: space-between!important;
}
.d-flex {
    display: -ms-flexbox!important;
}
section {
    display: block;
}
.text-white {
    color: #fff!important;
}
.text-center {
    text-align: center!important;
}
font{
  font-family: 'Times New Roman', Times, serif;
  font-weight: 100;
}
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
<script>!function(e){"undefined"==typeof module?this.charming=e:module.exports=e}(function(e,n){"use strict";n=n||{};var t=n.tagName||"span",o=null!=n.classPrefix?n.classPrefix:"char",r=1,a=function(e){for(var n=e.parentNode,a=e.nodeValue,c=a.length,l=-1;++l<c;){var d=document.createElement(t);o&&(d.className=o+r,r++),d.appendChild(document.createTextNode(a[l])),n.insertBefore(d,e)}n.removeChild(e)};return function c(e){for(var n=[].slice.call(e.childNodes),t=n.length,o=-1;++o<t;)c(n[o]);e.nodeType===Node.TEXT_NODE&&a(e)}(e),e});
</script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
<section>

  <div class="swiper-container slideshow" id="hz" style="z-index: 0;  top:-140px;" >
    <div class="swiper-wrapper" >
      <style>
        
      </style>
      <div class="swiper-slide slide">
        <div class="slide-image"></div>
        <span class="slide-title" ><a href="ticket.php"><img src="std.jpg" id="slide1"><h3 class="first-txt">
        <font size="100">TICKETS</font>
        </h3></a></span>
        
    </div>

      <div class="swiper-slide slide">
        <div class="slide-image"></div>
        <span class="slide-title" ><a href="merch.php"><img src="miwin.png" id="slide1"><h3 class="second-txt">
        <font size="100">MERCHANDICE</font>
        </h3></a></span>
      </div>

      
    </div>
  </div>

</section>
<script>
class Slideshow {
    constructor(el) {
        this.DOM = {el: el};
        this.config = {
          slideshow: {
            delay: 3000,
            pagination: {
              duration: 3,
            }
          }
        };
        this.init();
    }
    init() {
      var self = this;
      this.DOM.slideTitle = this.DOM.el.querySelectorAll('.slide-title');
      this.DOM.slideTitle.forEach((slideTitle) => {
        charming(slideTitle);
      });
      
      this.slideshow = new Swiper (this.DOM.el, {
          loop: true,
          autoplay: {
            delay: this.config.slideshow.delay,
            disableOnInteraction: false,
          },
          speed: 500,
          preloadImages: true,
          updateOnImagesReady: true,
          
          pagination: {
            el: '.slideshow-pagination',
            clickable: true,
            bulletClass: 'slideshow-pagination-item',
            bulletActiveClass: 'active',
            clickableClass: 'slideshow-pagination-clickable',
            modifierClass: 'slideshow-pagination-',
            renderBullet: function (index, className) {
              
              var slideIndex = index,
                  number = (index <= 8) ? '0' + (slideIndex + 1) : (slideIndex + 1);
              
              var paginationItem = '<span class="slideshow-pagination-item">';
              paginationItem += '<span class="pagination-number">' + number + '</span>';
              paginationItem = (index <= 8) ? paginationItem + '<span class="pagination-separator"><span class="pagination-separator-loader"></span></span>' : paginationItem;
              paginationItem += '</span>';
            
              return paginationItem;
              
            },
          },

          navigation: {
            nextEl: '.slideshow-navigation-button.next',
            prevEl: '.slideshow-navigation-button.prev',
          },

          scrollbar: {
            el: '.swiper-scrollbar',
          },
        
          on: {
            init: function() {
              self.animate('next');
            },
          }
        
        });
      
        this.initEvents();
        
    }
    initEvents() {
        
        this.slideshow.on('paginationUpdate', (swiper, paginationEl) => this.animatePagination(swiper, paginationEl));
        this.slideshow.on('slideNextTransitionStart', () => this.animate('next'));
        this.slideshow.on('slidePrevTransitionStart', () => this.animate('prev'));
    }
    animate(direction = 'next') {
      
        this.DOM.activeSlide = this.DOM.el.querySelector('.swiper-slide-active'),
        this.DOM.activeSlideImg = this.DOM.activeSlide.querySelector('.slide-image'),
        this.DOM.activeSlideTitle = this.DOM.activeSlide.querySelector('.slide-title'),
        this.DOM.activeSlideTitleLetters = this.DOM.activeSlideTitle.querySelectorAll('span');
        this.DOM.activeSlideTitleLetters = direction === "next" ? this.DOM.activeSlideTitleLetters : [].slice.call(this.DOM.activeSlideTitleLetters).reverse();
      
        this.DOM.oldSlide = direction === "next" ? this.DOM.el.querySelector('.swiper-slide-prev') : this.DOM.el.querySelector('.swiper-slide-next');
        if (this.DOM.oldSlide) {
          this.DOM.oldSlideTitle = this.DOM.oldSlide.querySelector('.slide-title'),
          this.DOM.oldSlideTitleLetters = this.DOM.oldSlideTitle.querySelectorAll('span'); 
          this.DOM.oldSlideTitleLetters.forEach((letter,pos) => {
            TweenMax.to(letter, .3, {
              ease: Quart.easeIn,
              delay: (this.DOM.oldSlideTitleLetters.length-pos-1)*.04,
              y: '50%',
              opacity: 0
            });
          });
        }
      
        this.DOM.activeSlideTitleLetters.forEach((letter,pos) => {
					TweenMax.to(letter, .6, {
						ease: Back.easeOut,
						delay: pos*.05,
						startAt: {y: '50%', opacity: 0},
						y: '0%',
						opacity: 1
					});
				});
      
        TweenMax.to(this.DOM.activeSlideImg, 1.5, {
            ease: Expo.easeOut,
            startAt: {x: direction === 'next' ? 200 : -200},
            x: 0,
        });
    }
    animatePagination(swiper, paginationEl) {
      this.DOM.paginationItemsLoader = paginationEl.querySelectorAll('.pagination-separator-loader');
      this.DOM.activePaginationItem = paginationEl.querySelector('.slideshow-pagination-item.active');
      this.DOM.activePaginationItemLoader = this.DOM.activePaginationItem.querySelector('.pagination-separator-loader');
      
      console.log(swiper.pagination);
        TweenMax.set(this.DOM.paginationItemsLoader, {scaleX: 0});
        TweenMax.to(this.DOM.activePaginationItemLoader, this.config.slideshow.pagination.duration, {
          startAt: {scaleX: 0},
          scaleX: 1,
        });
    }
}

const slideshow = new Slideshow(document.querySelector('.slideshow'));
</script>


        <div class="container" style="margin-top:-150px">
        
        <section id="allstats">
            <div id="s1">
             <img src="uzi.png">
             <div id="info">
                YUZVENDRA CHAHAL
               <br> PURPLE CAP
             </div>
            </div>
            <div id="s3">
            <img src="jasp.png">
            <div id="info">
            JASPREET BUMRAH
            </div>
            </div>
            <div id="s4">
                <img src="jos.png">
            <div id="info">
                JOS BUTTLER
                <br>ORANGE CAP
            </div>
            </div>
        </section>
<div id="myChart1" style="max-width:fit-screen; height:450px"></div>

        <script>

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      
      data.addColumn('number','MI');
      data.addColumn('number','RCB');
      data.addColumn('number','KKR');
      data.addColumn('number','RR');
      data.addColumn('number','KXIP');
      data.addColumn('number','DC');
      data.addColumn('number','GL');
        <?php
        include 'partials/_dbconnect.php';
      $sql2="Select * from matchday";
      $res2 = mysqli_query($conn,$sql2);
      ?>
      data.addRows([
      <?php
      while($result2=mysqli_fetch_assoc($res2)){
        ?>
        [<?php echo $result2['day'] ?>,<?php echo $result2['t1'] ?>,<?php echo $result2['t2'] ?>,<?php echo $result2['t3'] ?>,<?php echo $result2['t4'] ?>,<?php echo $result2['t5'] ?>,<?php echo $result2['t6'] ?>,<?php echo $result2['t7'] ?>],
        <?php
      }
      ?>
      ]);

      var options = {
        hAxis: {
          title: 'Matches'
        },
        vAxis: {
          title: 'Points'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('myChart1'));
      chart.draw(data, options);
    }
</script>
        <div id="team">
            <img src="mi.png" height="100px">
            <img src="rcb.png" height="220px" width="215px">
            <img src="csk.png"  height="200px" width="220px">
            <img src="rr.png" height="220px" width="185px">
            <img src="srh.png"  height="170px" width="210px">
            <img src="kkr.png" height="200px" width="180px">
            <img src="kp.png" height="200px" width="180px">
        <p>Copyright © 2022 All rights reserved</p>
        </div>
</html>