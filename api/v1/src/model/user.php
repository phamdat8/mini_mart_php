<?php
  require_once "application.php";
  class User extends Application{
    public function check_user($username){
      $sql = 'select * from users where username = "'. $username.'"';
      $rel = mysqli_query($this-> conn(), $sql);
      return $rel->num_rows;
    }
  }
?>