<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include('layout.php');
  include('data.php');
  $d = new data();
  $l = new layout();
  $d -> check_admin();
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Trang Quản lý Mini Mart</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style2.css" rel="stylesheet">
    <link href="../assets/css/style1.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>

  <body>
    <?php
    if(isset($_SESSION['notification'])){
      echo '<script>swal("'.$_SESSION['notification'].'");</script>';
      unset($_SESSION['notification']);
    }
    ?>
    <?php $l->top();?>
    <div class="container-fluid" style="margin-top: 90px">
      <div class="row mt-5">
        <?php $l->left();
            switch ($_GET['type']) {
              case 'slide':
                echo '<title-name style="font-size: 40px">Thêm ảnh nền</title-name>';
                echo $d -> slide_form(0);
                break;
              case 'product':
                echo '<title-name style="font-size: 40px">Thêm sản phẩm</title-name>';
                echo $d -> product_form(0);
                break;
              case 'user':
                echo '<title-name style="font-size: 40px">Thêm người dùng</title-name>';
                echo $d -> user_form(0);
                break;
              case 'category':
                echo '<title-name style="font-size: 40px">Thêm Doanh mục</title-name>';
                echo $d -> category_form(0);
                break;
            }
          ?>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      function loadFile(event) {
        var image = document.getElementById("output");
        image.src = URL.createObjectURL(event.target.files[0]);
      };
    </script>
  </body>
</html>