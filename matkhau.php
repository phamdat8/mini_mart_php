<html>
  <head>
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" media="all" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="./assets/css/style1.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.1/sweetalert2.min.css">
  </head>

  <body>
    <?php
      include('src/session.php');
      include("shared/layouts.php");
      $s = new session();
      $l = new layouts();
      if($_POST['commit'] == 'Đổi mật khẩu') {
         $old_password = $_POST['old_password'];
         $pass = $_POST['password'];
         $pass_confirm = $_POST['password_confirm'];

         if($pass == $pass_confirm){
           $rel = $s -> change_pass($_SESSION["user_id"], $pass);
           if($rel == 1){
             echo '<script>window.location = "index.php"</script>';
           }else{
             echo '<script>swal.fire("Thất bại","Sai mật khẩu cũ","error")</script>';
           }
         }else{
           echo '<script>swal.fire("Thất bại","Xác nhận mật khẩu không đúng","error")</script>';
         }
       }
      $l -> header();
    ?>
    <div class="container-fluid h-100 text-dark login-form pt-5">
      <div class="row justify-content-center align-items-center">
        <h2>Đổi mật khẩu</h2>
      </div>
      <div class="row justify-content-center align-items-center" style="height: 350px;">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
          <form class="new_user" id="new_user" accept-charset="UTF-8" method="post">
            <div class="form-group">
              <label for="user_password">Mật khẩu cũ</label><br>
              <input class="form-control" placeholder="Enter your old password" type="password" name="old_password">
            </div>

            <div class="form-group">
              <label for="user_password">Mật khẩu</label><br>
              <input class="form-control" placeholder="Enter your password" type="password" name="password" id="user_password">
            </div>

            <div class="form-group">
              <label for="user_password_confirm">Xác nhận mật khẩu</label><br>
              <input autocomplete="current-password" class="form-control" placeholder="Enter your password" type="password" name="password_confirm" id="user_password_confirm">
            </div>

            <div class="actions">
              <input type="submit" name="commit" value="Đổi mật khẩu" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>