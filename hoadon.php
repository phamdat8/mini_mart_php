<?php
if(!isset($_SESSION)) {
 session_start();
}
?>
<html>
  <head>
    <title>Mini mart</title>
    <link rel="stylesheet" media="all" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="./assets/css/style1.css">
    <link rel="stylesheet" media="all" href="./assets/css/style2.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  </head>
  <body>
    <?php
    include('shared/layouts.php');
    include('src/session.php');
    include('src/order.php');
    $l = new layouts();
    $s = new session();
    $o = new order();
    // $s -> check_cookie();
    if(isset($_SESSION["user_id"])){
      $s -> update_cart_quantity($_SESSION["user_id"]);
    }
    $l -> header();
    $o -> show_all($_SESSION["user_id"]);
    ?>

  </body>
</html>