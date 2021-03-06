<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include_once('./src/connect.php');
  $p = new connect();
  $GLOBALS['con'] = $p -> conn();
  class layouts{
    function header(){
      $data = '<nav class="navbar navbar-expand-lg bg-primary bd-navbar fixed-top light-text">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand large-name" href="/">MINI MART</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          </ul>
          <ul class="form-inline my-2 my-lg-0">
            <li class="nav-item">
              <form class="form-custom" method="GET" action="/timkiem.php">
                <input class="form-control mr-sm-2 input-custom" type="search" placeholder="Search" aria-label="Search" name="text">
                <button type="submit" class="btn" name="submit" value="search"><img src="./shared/images/search.png" class="search-icon" height="25px"></button>
              </form>
            <a></li>';
      if (isset($_SESSION['user_id'])){
        $data .= '<a href="giohang.php"><li class="nav-item btn-right">
                    <img src="shared/images/cart.png" class="search-icon" height="33px" style="padding-right:0px">
                  </li></a>';
        $data .= '<li ><div id="total_cart_quantity" class="nav-item btn-right">'.$_SESSION["cart_quantity"].'</div></li>';
        $data .='<li class="nav-item">
                  <div class="dropdown text-light">
                    <div class="ml-3"><b>Hi, '.$_SESSION["username"].'</b></div>
                    <div class="dropdown-content">
                      <a href="/index.php">Trang chủ</a>
                      <a href="/matkhau.php">Mật khẩu</a>';
                      if($_SESSION["role"] == "manager" || $_SESSION["role"] == "admin"){
                        $data .= '<a href="/admin/product.php">Quản lý</a>';
                      }
                      $data .= '<a href="/hoadon.php">Đơn hàng</a>
                      <a href="logout.php">Đăng xuất</a>
                    </div>
                  </div>
                </li>';
      }else{
        $data .= '<li class="nav-item">
          <a href="login.php"><button class="btn btn-light my-2 my-sm-0 btn-right">Đăng nhập</button></a>
        </li>
        <li class="nav-item">
          <a href="signup.php"><button class="btn btn-light my-2 my-sm-0">Đăng Ký</button></a>
        </li>';
      }
      $data .='</ul></div></nav>';
      echo $data;
    }
    function footer(){
      echo '<footer>
              <div class="container bg-secondary ml-0 mr-0 p-2 col-12 text-white text-center sticky-bottom">
                <div class="row">
                  <div class="col-md-4">
                    Mini mart là đơn vị cung cấp thực phẩm tiện lợi cho gia đình.
                    <div class="row ml-2 mt-2"><img class="mr-1 ml-1" src="/shared/images/location_icon.svg" width=20px />12 Nguyễn Văn Bảo, P14, Quận Gò Vấp</div>
                    <div class="row ml-2 mr-2"><img class="mr-1 ml-1" src="/shared/images/mail_icon.png" width=20px height=15px />leduyen2003@gmail.com</div>
                    <div class="row ml-2 mr-2"><img class="mr-1 ml-1" src="/shared/images/phone_icon.png" width=20px />0869900510</div>
                  </div>
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4" style="text-align: left">
                    <div>Đơn vị phát triển:</div>
                    <div class="ml-5">Phạm Thành Đạt</div>
                    <div class="ml-5">Phạm Thuỳ Linh</div>
                    <div class="ml-5">Nguyễn Tăng Thắng</div>
                    <div class="ml-5">Thiều Mỹ Chinh</div>
                    <div class="ml-5">Nguyễn Trần Lệ Duyên</div>
                  </div>
                </div>
              </div>
            </footer>';

    }
  }
?>