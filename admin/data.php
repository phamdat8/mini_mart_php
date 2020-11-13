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
  }
?>