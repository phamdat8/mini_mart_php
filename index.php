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
    <link rel="stylesheet" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"> -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.js"></script>


  </head>
  <body>
    <?php
    include('shared/layouts.php');
    include('src/session.php');
    include('src/product.php');
    $l = new layouts();
    $s = new session();
    $p = new product();
    // $s -> check_cookie();
    if(isset($_SESSION["user_id"])){
      $s -> update_cart_quantity($_SESSION["user_id"]);
    }

    if(isset($_SESSION['notification'])){
      echo '<script>swal.fire("Oh no","'.$_SESSION['notification'].'", "error");</script>';
      unset($_SESSION['notification']);
    }
    $l -> header();
    $l -> show_slide();
    $p -> show_all();
    ?>

  </body>
</html>