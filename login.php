<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include('src/session.php');
  $s = new session();
  $username = $_POST['username'];
  $pass = $_POST['password'];
  $remember_me = $_POST['remember_me'];
  if(isset($_POST["commit"])){
    switch ($_POST["commit"]) {
      case 'Đăng ký':
        header('location: signup.php');
        exit();
      case 'Đăng nhập':
        $login = $s -> login($username, $pass, $remember_me);
        if($login == 1){
          header('location: index.php');
        }
        else{
          echo 'ahsbdhasbdjsbjhabs';
        }
      default:

        break;
    }
  }
?>
<html>
  <head>
    <title>HI</title>
    <link rel="stylesheet" media="all" href="../assets/css/bootstrap.min.css">
  </head>

  <body>
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

              <div class="form-group">
                <input name="user[remember_me]" type="hidden" value="0"><input type="checkbox" value="1" name="remember_me" id="user_remember_me">
                <label for="user_remember_me">Remember me</label>
              </div>

            <div class="actions">
              <input type="submit" name="commit" value="Đăng nhập" class="btn btn-primary">
              <input type="submit" name="commit" value="Đăng ký" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>