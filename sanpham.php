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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>
    <?php
      include('shared/layouts.php');
      include('src/session.php');
      include('src/carts.php');
      include('src/product.php');

      $l = new layouts();
      $s = new session();
      $c = new cart();
      $p = new product();
      //$s -> update_cart_quantity($_SESSION["user_id"]);
      //$s -> check_cookie();
      $l -> header();
    ?>
    <div class="container col-md-10 bg-light p-5">
      <h1>Chi tiết sản phẩm</h1>
      <div class="row">
        <?php
          $p->show_detail($_GET['id'])
        ?>
      </div>
    </div>
  </body>
  <script>
    function decrease(){
      quantity = document.getElementById('quantity');
      value = parseInt(quantity.value);
      if(value > 1){
        quantity.value = value - 1;
        update_cart("-");
      }
    }

    function increase(){
      quantity = document.getElementById('quantity');
      value = parseInt(quantity.value);
      quantity.value = value + 1;
      update_cart("+");
    }

    function add_to_cart(user_id, product_id){
      quantity = document.getElementById('quantity');
      quantity = parseInt(quantity.value);
      url = "src/carts.php?submit=add&user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity;
      const http = new XMLHttpRequest();
      http.open("GET", url);
      http.send();
      swal("Bạn có muốn mua thêm sản phẩm ?", {
        buttons: {cancel:"Thanh toán luôn", Có: true},
      }).then((value)=>{
          switch (value) {
            case "Có":
              window.location = "/";
              break;
            default:
              window.location = "giohang.php";
              break;

          }
        })
    }
    function update_cart(action){
      // quantity = document.getElementById('total_cart_quantity');
      // value = parseInt(quantity.textContent);
      // if(action == "+"){
      //   quantity.innerHTML = value + 1;
      // }else{
      //   quantity.innerHTML = value - 1;
      // }
    }
  </script>
</html>