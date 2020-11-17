<?php
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();
class product{
  function show(){
    $sql = 'select * from categories;';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    while($row = $rel->fetch_assoc()){
    $a = $this->show_with_category($row["id"]);
    }
  }

  function show_with_category($category_id){
    $data = '<br>';
    $sql = 'select * from categories where id='.$category_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $row = $rel->fetch_array();
    $category_name = $row['name'];
     //echo $category_name; // xuất tên của category vd: trái cây, rau củ
    $data .= '<div class="category_name">'.$category_name.'</div>';
    $sql = 'select * from products where category_id='.$category_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    while($row = $rel->fetch_assoc()){
      echo $row['name'];
      $img = $row['img_link'];
      echo '<img src="'.$img.'" height=50px width=50px/>';
    }
    echo $data;
  }


}
?>