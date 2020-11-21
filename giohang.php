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
  <body onload="hide_pay_button()">
    <?php
      include('shared/layouts.php');
      include('src/session.php');
      include('src/carts.php');
      $l = new layouts();
      $s = new session();
      $c = new cart();
      //$s -> check_cookie();
      if(!isset($_SESSION['user_id'])){
        echo '<script>window.location = "/index.php"</script>';
      }


      if(isset($_SESSION["user_id"])){
        $s -> update_cart_quantity($_SESSION["user_id"]);
      }
      $l -> header();
    ?>
    <div class="row justify-content-center align-items-center">
      <h1>Giỏ hàng của bạn</h1>
      <div class="table-responsive col-sm-10 col-md-10 m-5 border border-dark rounded">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th class='p-3'>Tên</th>
              <th class='p-3 text-center'>Ảnh</th>
              <th class='p-3'>Số lượng</th>
              <th class='p-3'>Đơn giá</th>
              <th class='p-3'>Thành tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $c-> show();

            ?>
            <tr id="last_row">
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th><button class="btn btn-primary" onclick="pay(<?php echo $_SESSION['user_id']?>)">Thanh toán</button></th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
  <script>
    function decrease(id){
      quantity = document.getElementById('quantity_'+id);
      price = document.getElementById('price_'+ id).textContent;
      money = document.getElementById('money_'+ id);
      money_value = money.textContent - 1 + 1 - price;
      value = quantity.textContent - 1;
      if(value == 0){
        swal("Bạn muốn xoá sản phẩm này khỏi giỏ hàng", {
          buttons: {cancel:"Không", Có: true},
        }).then((value)=>{
            switch (value) {
              case "Có":
                update_total("d");
                update_total_price(parseInt(price)- 2*parseInt(price));
                document.getElementById("_"+id).remove();
                url = "src/carts.php?submit=delete&id="+id;
                const http = new XMLHttpRequest();
                http.open("POST", url);
                http.send();
                break;
              default:
                break;

            }
          })
      }else{
        update_total("d");
        update_total_price(parseInt(price)- 2*parseInt(price));
        money.innerHTML = money_value;
        quantity.innerHTML = value;
        url = "src/carts.php?submit=decrease&id="+id;
        const http = new XMLHttpRequest();
        http.open("GET", url);
        http.send();
      }
    }
    function increase(id){
      quantity = document.getElementById('quantity_'+ id);
      price = document.getElementById('price_'+ id).textContent;
      money = document.getElementById('money_'+ id);
      money_value = parseInt(money.textContent) + parseInt(price);
      value = quantity.textContent - 1 + 2;
      update_total("i");
      update_total_price(parseInt(price));
      money.innerHTML = money_value;
      quantity.innerHTML = value;
      url = "src/carts.php?submit=increase&id="+id;
      const http = new XMLHttpRequest();
      http.open("GET", url);
      http.send();
    }
    function update_total(type){
      total = document.getElementById('total_cart_quantity');
      if (type == "i"){
        total_value = parseInt(total.textContent) + 1;
      }else{
        total_value = parseInt(total.textContent) - 1;
      }
      total.innerHTML = total_value;
    }
    function pay(user_id){
      url = "src/carts.php?submit=pay";
      const http = new XMLHttpRequest();
      http.open("GET", url);
      http.send();
      window.location = 'index.php';
    }
    function hide_pay_button(){
      if(document.getElementById("total").textContent == 0){
        document.getElementById('last_row').remove();
      }
    }
    function update_total_price(change){
      total = document.getElementById('total');
      total_value = parseInt(total.textContent) + change;
      total.innerHTML = total_value;
    }
  </script>
</html>