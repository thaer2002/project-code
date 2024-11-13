<?php
session_start();
require_once 'headerPage.php';
require_once "db_connect.php";
?>
<body class="bg-light">
  <style type="text/css">
    html {
      scroll-behavior: smooth;
    }

    .title {
      text-align: center;
      margin-top: 50px;
      color: white;
      text-shadow: 2px 2px 2px black;
      font-size: calc(6vw + 10px);
    }


    blockquote {
      border: none;
      font-family: 'Changa', sans-serif;

      quotes: "\201C" "\201D" "\2018" "\2019";
    }

    blockquote h3 {
      font-size: calc(3vw + 10);
      font-family: 'Changa', sans-serif;
      color: white;
      text-shadow: 2px 2px 2px black;
      text-align: center;
      margin-bottom: 50px;
    }

    blockquote h3:before {
      content: open-quote;
      font-weight: bold;
      font-size: calc(3vw + 10px);
      color: #fff;
    }

    blockquote h3:after {
      content: close-quote;
      font-weight: bold;
      font-size: calc(3vw + 10px);
      color: #fff;
    }

    .btnStyle {
      border-radius: 20px;
      padding: 10px;
      padding-left: 20px;
      padding-right: 20px;
      background-color: transparent;
      transition: 0.4s;
      color: white;
      text-shadow: 1px 1px 1px black;
      font-size: calc(1vw + 10px);
      font-weight: bolder;
    }
    .btnStyle:hover {
      background-color: white;
      color: black;
      text-shadow: none;
      transition: 0.4s;
    }
    #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      border: solid 1px silver;
      outline: none;
      background-color: #DFD0B8;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 50px;
      font-size: 18px;
      
    }
    #myBtn:hover {
      background-color: #555;
    }
  </style>
  <div class="container-fluid" style="background-image: url(img/background2.jpg); background-size:100% 100%; height: 100vh ">
    <?php require_once "mainNavBar.php"; ?>
    <div class="row text-center">
      <div class="col-sm-12">
        <h1 class="display-2 title">بوصلة الجامعات</h1>
        <blockquote>
          <h3>موقعك المثالي لاستكشاف الجامعات والمواقع الهامة</h3>
        </blockquote>
        <a href="search.php" class="btn btn-light btn-lg btnStyle">ابحث على الخريطه</a>
        <a href="moreItem.php" class="btn btn-light btn-lg btnStyle"> إستكشف الموقع </a>
        </>
      </div>
    </div>
  </div>

</body>