<?php
session_start();
include('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();

class session{
  function login($username, $pass, $remember_me){
    $sql = "select * from users where username ='".$username."'";
    $rel = mysqli_query($GLOBALS['con'], $sql);
    if ($rel->num_rows == 1) {
      $row = $rel->fetch_array();
      if($row['password'] == $pass){
        $_SESSION['username'] = $row["username"];
        $_SESSION['user_id'] = $row["id"];
        if($remember_me == 1){
          $random = $this -> rand_string();
          $sql = "update users set cookie_token='".$random."' where id=".$row["id"];
          mysqli_query($GLOBALS['con'], $sql);
          setcookie("id", $row["id"], time()+3600*24*7);
          setcookie("token", $random, time()+3600*24*7);
        }
        return 1;
      }else{
        return 0;
      }
    } else {
      return 0;
    }
  }

  function logout(){
    session_destroy();
    setcookie("id", '');
    setcookie("token", '');
  }

  function check_cookie(){
    $id = $_COOKIE['id'];
    $token = $_COOKIE['token'];
    if(($id != '') && ($token != '')){
      $sql = "select * from users where id ='".$id."'";
      $rel = mysqli_query($GLOBALS['con'], $sql);
      if($rel->num_rows == 1){
        $row = $rel->fetch_array();
        if($row['cookie_token'] == $token){
          $_SESSION['username'] = $row["username"];
          $_SESSION['user_id'] = $row["id"];
          return 1;
        }
      }
    }
  }

  function rand_string() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
?>