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
              <form class="form-custom">
                <input class="form-control mr-sm-2 input-custom" type="search" placeholder="Search" aria-label="Search">
                <button class="btn" type="submit"><img src="./shared/images/search.png" class="search-icon" height="25px"></button>
              </form>
            <a></li>';
      if (isset($_SESSION['user_id'])){
        $data .= '<a href="giohang.php"><li class="nav-item btn-right">
                    <img src="shared/images/cart.png" class="search-icon" height="33px" style="padding-right:0px">
                  </li></a>';
        $data .= '<li ><div id="total_cart_quantity" class="nav-item btn-right">'.$_SESSION["cart_quantity"].'</div></li>';
        // $data .= '<li class="nav-item">
        //   <button class="btn btn-light my-2 my-sm-0 btn-right"><a href="logout.php">Đăng xuất</a></button>
        // </li>
        // <li class="nav-item">'.$_SESSION["username"].'</li>';

        $data .='<li class="nav-item">
                  <div class="dropdown text-light">
                    <div class="ml-3"><b>Hi, '.$_SESSION["username"].'</b></div>
                    <div class="dropdown-content">
                      <a href="/index.php">Trang chủ</a>
                      <a href="/matkhau.php">Mật khẩu</a>';
                      if($_SESSION["role"] == "manager" || $_SESSION["role"] == "admin"){
                        $data .= '<a href="/admin/product.php">Trang quản lý</a>';
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
    function show_slide(){
      $data = '<div class="container col-md-10 bg-light" style="height:300px; margin-top: 86px">
                  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" >
                      <div class="carousel-item active">
                          <img src="db/images/slides/1" class="h-100 img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="db/images/slides/2" class="h-100 mx-auto img-fluid" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="db/images/slides/3" class="h-100 img-fluid" alt="...">
                      </div>
                    </div>
                  </div>
                </div>';
      echo $data;
    }
  }
?>