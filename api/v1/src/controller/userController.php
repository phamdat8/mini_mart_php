<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/api/v1/src/model/user.php");
  class userController extends User{
    function check_exist_user($params){
      $nums = $this -> check_user($params['username']);
      $exist_user = ($nums == 1) ? true : false;
      $data = ['exist_user'=> $exist_user];
      echo json_encode(['status'=> 'success', 'data'=> $data]);
    }
  }

?>