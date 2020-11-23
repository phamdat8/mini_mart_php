<?php
if(!isset($_SESSION)) {
 //session_start();
}
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();

class session{
  function login($username, $pass, $remember_me){
    $sql = "select * from users where where deleted = false and username ='".$username."'";
    $rel = mysqli_query($GLOBALS['con'], $sql);
    if ($rel->num_rows == 1) {
      $row = $rel->fetch_array();
      if($row['password'] == $pass){
        $_SESSION['username'] = $row["username"];
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['role'] = $row["role"];
        $this->update_cart_quantity($row["id"]);
        return 1;
      }else{
        return 0;
      }
    } else {
      return 0;
    }
  }

  function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
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