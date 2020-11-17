<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  class layouts{
    function header(){
      $data = '<nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand large-name" href="#">MINI MART</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          </ul>
          <ul class="form-inline my-2 my-lg-0">
            <li class="nav-item">
              <form class="form-custom">
                <input class="form-control mr-sm-2 input-custom" type="search" placeholder="Search" aria-label="Search">
                <button class="btn" type="submit"><img src="./shared/images/search.png" class="search-icon" height="25px"></button>
              </form>
            </li>';
      if (isset($_SESSION['user_id'])){
        $data .= '<li class="nav-item btn-right">
                    <img src="./shared/images/cart.jpg" class="search-icon" height="33px" style="padding-right:0px">('.$_SESSION["cart_quantity"].')
                  </li>';
        $data .= '<li class="nav-item">
          <button class="btn btn-outline-primary my-2 my-sm-0 btn-right"><a href="logout.php">Đăng xuất</a></button>
        </li>
        <li class="nav-item">'.$_SESSION["username"].'</li>';
      }else{
        $data .= '<li class="nav-item">
          <a href="login.php"><button class="btn btn-outline-primary my-2 my-sm-0 btn-right">Đăng nhập</button></a>
        </li>
        <li class="nav-item">
          <a href="signup.php"><button class="btn btn-outline-primary my-2 my-sm-0">Đăng Ký</button></a>
        </li>';
      }
      $data .='</ul></div></nav>';
      echo $data;
    }
  }
?>