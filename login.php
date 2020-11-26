<?php
if(!isset($_SESSION)) {
   session_start();
}
?>
<html>
  <head>
    <title>HI</title>
    <link rel="stylesheet" media="all" href="../assets/css/bootstrap.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>

    <?php
      include('src/session.php');
      $s = new session();
      $username = $_POST['username'];
      $pass = $_POST['password'];
      if(isset($_POST["commit"])){
        switch ($_POST["commit"]) {
          case 'Đăng nhập':
            $login = $s -> login($username, $pass);
            if($login == 1){
              echo '<script>window.location = "index.php"</script>';
            }
            else{
              echo '<script>swal("Sai tài khoản hoặc mật khẩu.")</script>';
            }
          default:

            break;
        }
      }
    ?>
    <div class="container-fluid h-100 text-dark login-form">
      <div class="row justify-content-center align-items-center">
        <h2>Log in</h2>
      </div>
      <div class="row justify-content-center align-items-center" style="height: 350px;">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <form class="new_user" id="new_user" accept-charset="UTF-8" method="post">
            <div class="form-group">
              <label for="username">Username</label><br>
              <input autofocus="autofocus" autocomplete="email" class="form-control" placeholder="Enter your username" type="text" value="" name="username" id="username">
            </div>

            <div class="form-group">
              <label for="user_password">Password</label><br>
              <input autocomplete="current-password" class="form-control" placeholder="Enter your password" type="password" name="password" id="user_password">
            </div>

            Bạn chưa có tài khoản, <a href="./signup.php">Đăng ký</a> ngay.

            <div class="actions">
              <input type="submit" name="commit" value="Đăng nhập" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>