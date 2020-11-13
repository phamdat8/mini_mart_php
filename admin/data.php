<?php
  session_start();
  include('../src/connect.php');
  $p = new connect();
  $GLOBALS['con'] = $p -> conn();
  class data{
    function slides(){
      $data = '';
      $sql = 'select * from slides';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
          $data .= '<tr>';
          $data .= '<td>'.$row["id"].'</td>';
          $data .= '<td>'.$row["name"].'</td>';
          $data .= '<td><img src=../'.$row['img_link'].' height=50px></td>';
          if($row["active"]==1){
            $data .= '<td><img class="img-custom" src=../shared/images/true.png height=20px></td>';
          }else{
            $data .= '<td><img class="img-custom" src=../shared/images/false.png height=20px></td>';
          }
          $data .= '<td><img src=../shared/images/edit.png height=40px><img src=../shared/images/delete.png height=20px></td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function products(){
      $data = '';
      $sql = 'select p.id, p.name, p.img_link, p.price, p.unit_type, u.username, c.name as category_name
              from products p join users u join categories c
              where p.user_id = u.id and  p.category_id = c.id
              group by p.id;';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
          $data .= '<tr>';
          $data .= '<td>'.$row["id"].'</td>';
          $data .= '<td>'.$row["name"].'</td>';
          $data .= '<td><img src=../'.$row['img_link'].' height=50px></td>';
          $data .= '<td>'.$row["name"].'</td>';
          $data .= '<td>'.$row["price"].'/'.$row["unit_type"].'</td>';
          $data .= '<td><img src=../shared/images/edit.png height=40px><img src=../shared/images/delete.png height=20px></td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function users(){
      $data = '';
      $sql = 'select * from users';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
          $data .= '<tr>';

          $data .= '<td>'.$row["id"].'</td>';
          $data .= '<td>'.$row["username"].'</td>';
          $data .= '<td>'.$row["role"].'</td>';
          $data .= '<td><img src=../shared/images/edit.png height=40px><img src=../shared/images/delete.png height=20px></td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function check_admin(){
      include('../src/session.php');
      $s = new session();
      $rel = $s -> is_admin();
      if($rel == 0){
        header('location: ../index.php');
      }
    }

    function check_manager(){
      include('../src/session.php');
      $s = new session();
      $rel = $s -> is_manager();
      if($rel == 0){
        header('location: product.php');
      }
    }
  }
?>