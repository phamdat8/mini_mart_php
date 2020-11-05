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
              <label for="user_email">Email</label><br>
              <input autofocus="autofocus" autocomplete="email" class="form-control" placeholder="Enter your email" type="email" value="" name="user[email]" id="user_email">
            </div>

            <div class="form-group">
              <label for="user_password">Password</label><br>
              <input autocomplete="current-password" class="form-control" placeholder="Enter your password" type="password" name="user[password]" id="user_password">
            </div>

              <div class="form-group">
                <input name="user[remember_me]" type="hidden" value="0"><input type="checkbox" value="1" name="user[remember_me]" id="user_remember_me">
                <label for="user_remember_me">Remember me</label>
              </div>

            <div class="actions">
              <input type="submit" name="commit" value="Log in" class="btn btn-primary" data-disable-with="Log in">
            </div>
          </form>

          <?php
            $servername = "127.0.0.1";
            $username = "phamdat";
            $password = "";

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
          ?>
        </div>
      </div>
    </div>
  </body>
</html>