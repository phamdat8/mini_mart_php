<?php
  if(!isset($_SESSION)) {
     session_start();
  }

  include('src/session.php');
  $s = new session();




  switch ($_POST['commit']) {
    case 'Đăng ký':
      $username = $_POST['username'];
      $pass = $_POST['password'];
      $pass_confirm = $_POST['password_confirm'];
      if($pass == $pass_confirm){
        $rel = $s -> signup($username, $pass);
        if($rel == 1){
          $s -> login($username, $pass, '');
          $_SESSION["notification"] = "Tạo tài khoản không thành công";
          echo '<script>window.location = "index.php"</script>';
          // header("location: index.php");
        }else{
          $_SESSION["notification"] = "Tạo tài khoản không thành công";
        }
      }else{
        $_SESSION["notification"] = "Xác nhận mật khẩu không trùng khớp";
        header("location: signup.php");
      }
      break;

    default:
      // code...
      break;
  }
?>
<html>
  <head>
    <title>Đăng ký</title>
    <link rel="stylesheet" media="all" href="../assets/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.css">
  </head>

  <body>
    <?php
    if(isset($_SESSION['notification'])){
      echo '<script>swal.fire("Oh no","'.$_SESSION['notification'].'", "error");</script>';
      unset($_SESSION['notification']);
    }
    ?>
    <div class="container-fluid h-100 text-dark login-form">
      <div class="row justify-content-center align-items-center">
        <h2>Đăng ký tài khoản</h2>
      </div>
      <div class="row justify-content-center align-items-center" style="height: 350px;">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <form class="new_user" id="new_user" accept-charset="UTF-8" method="post">
            <div class="form-group">
              <label for="username">Tài khoản</label><br>
              <input autofocus="autofocus" autocomplete="email" class="form-control" placeholder="Enter your username" type="text" value="" name="username" id="username">
            </div>

            <div class="form-group">
              <label for="user_password">Mật khẩu</label><br>
              <input autocomplete="current-password" class="form-control" placeholder="Enter your password" type="password" name="password" id="user_password">
            </div>

            <div class="form-group">
              <label for="user_password_confirm">Xác nhận mật khẩu</label><br>
              <input autocomplete="current-password" class="form-control" placeholder="Enter your password" type="password" name="password_confirm" id="user_password_confirm">
            </div>

            <div class="actions">
              <input type="submit" name="commit" value="Đăng ký" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>