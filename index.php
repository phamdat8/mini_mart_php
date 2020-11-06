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
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  </head>
  <body>
    <?php
    include('shared/layouts.php');
    include('src/session.php');
    $l = new layouts();
    $s = new session();
    $status = $s -> check_cookie();
    $l -> header();
    ?>
  </body>
</html>