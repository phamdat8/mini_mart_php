<?php
if(!isset($_SESSION)) {
  session_start();
}
include_once('connect.php');
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
        $_SESSION['role'] = $row["role"];
        $this->update_cart_quantity($row["id"]);
        // if($remember_me == 1){
        //   $random = $this -> rand_string();
        //   $sql = "update users set cookie_token='".$random."' where id=".$row["id"];
        //   mysqli_query($GLOBALS['con'], $sql);
        //   setcookie("id", $row["id"], time()+3600*24*7);
        //   setcookie("token", $random, time()+3600*24*7);
        // }
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

  function signup($username, $password){
    $sql = "insert into users(username, password,role) values('".$username."','".$password."', 'customer')";
    $rel = mysqli_query($GLOBALS['con'], $sql);
    if ($rel) {
      return 1;
    }
  }

  // function check_cookie(){
  //   $id = $_COOKIE['id'];
  //   $token = $_COOKIE['token'];
  //   if(($id != '') && ($token != '')){
  //     $sql = "select * from users where id ='".$id."'";
  //     $rel = mysqli_query($GLOBALS['con'], $sql);
  //     if($rel->num_rows == 1){
  //       $row = $rel->fetch_array();
  //       if($row['cookie_token'] == $token){
  //         $_SESSION['username'] = $row["username"];
  //         $_SESSION['user_id'] = $row["id"];
  //         $_SESSION['cart_quantity'] = $row["cart_quantity"];
  //         return 1;
  //       }
  //     }
  //   }
  //   return 0;
  // }


  function is_admin(){
    $id = $_SESSION['user_id'];
    $sql = "select * from users where id ='".$id."'";
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $row = $rel->fetch_array();
    if($row['role'] == 'admin' || $row['role'] == 'manager'){
      return 1;
    }else{
      return 0;
    }
  }

  function is_manager(){
    $id = $_SESSION['user_id'];
    $sql = "select * from users where id ='".$id."'";
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $row = $rel->fetch_array();
    if($row['role'] == 'manager'){
      return 1;
    }else{
      return 0;
    }
  }

  function update_cart_quantity($user_id){
    $sql = 'select sum(quantity) as total from carts where user_id='.$user_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $row = $rel->fetch_array();
    $sql = 'update users set cart_quantity = '.$row["total"].'where id='.$user_id;
    $_SESSION['cart_quantity'] = $row["total"];
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

  function change_pass($id, $new_pass, $old_pass){
    $sql = 'update users set password ="'.$new_pass.'" where id='.$id.' and password = "'.$old_pass.'"';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    if(mysqli_affected_rows($GLOBALS['con']) == 1){
      return 1;
    }
  }
}
?>