<?php
class layout{
  function left(){
    echo '<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="order.php">
            <div class="row">
              <img src="../shared/images/order.png" width="24" height="24" class="ml-3 mr-1"/>
              <div>Hoá đơn</div>
            </div>
          </a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="slide.php">
              <div class="row">
                <img src="../shared/images/slide_icon.svg" width="24" height="24" class="ml-3 mr-1"/>
                <div>Ảnh nền</div>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Sản phẩm
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
               Tài khoản
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
              Doanh mục
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>';

  }

  function top(){
    $data = '<nav class="navbar navbar-expand-lg bg-primary bd-navbar fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand large-name" href="/">MINI MART</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
        <ul class="form-inline my-2 my-lg-0">
          ';
      $data .= '
      <li class="nav-item">
                <div class="dropdown text-light">
                  <div class="ml-3"><b>Hi, '.$_SESSION["username"].'</b></div>
                  <div class="dropdown-content">
                    <a href="../index.php">Trang chủ</a>
                    <a href="../matkhau.php">Mật khẩu</a>';
                    if($_SESSION["role"] == "manager" || $_SESSION["role"] == "admin"){
                      $data .= '<a href="../admin/product.php">Trang quản lý</a>';
                    }
                    $data .= '<a href="../hoadon.php">Đơn hàng</a>
                    <a href="../logout.php">Đăng xuất</a>
                  </div>
                </div>
              </li></ul></div></nav>';
    echo $data;
  }
}
?>