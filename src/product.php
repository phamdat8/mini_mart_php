<?php
session_start();
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();
class product{
  function show_detail($product_id){
    $user_id = $_SESSION["user_id"];
    $sql = 'select * from carts where user_id='.$user_id.' and product_id='.$product_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $num = $rel->num_rows;
    if($num==1){
      $row = $rel->fetch_array();
      $quantity = $row['quantity'];
    }else{
      $quantity = 1;
    }
    $sql = 'select * from products where id='.$product_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $data = '';
    $row = $rel->fetch_array();
    $data .= '<div class="col-md-6" stype="border: 40px">
                <img src="'.$row["img_link"].'" height=100%>
              </div>';
    $data .= '<div class="col-md-6">
                <h2>'.$row["name"].'</h2>
                <p>'.$row["description"].' </p></br>
                <h3>'.$row["price"].'đ/'.$row["unit_type"].'</h3></br>
                <button class="btn btn-outline-primary" onclick="decrease()">-</button>
                <input type="text" id="quantity" value="'.$quantity.'" style="border: 0px; width: 20px; margin: 5px; text-align: center">
                <button class="btn btn-outline-primary" onclick="increase()">+</button>
                <div style="margin-top: 20px">
                  <button onclick="add_to_cart('.$user_id.','.$product_id.')" class="btn btn-primary">Chọn mua</button>
                </div>
              </div>';
    echo $data;
  }

  function show_all(){
    echo '<div class="container col-md-10 p-5 bg-light">';
    $sql = 'select * from categories';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    while($row = $rel->fetch_assoc()){
      $this->show_with_category($row['id'], $row['name']);
    }
    echo '</div>';
  }
  function show_with_category($id, $category_name){
    $data = '<h2 class="pl-4">'.$category_name.'</h2><div class="container"><div class="row">';
    $sql = 'select * from products where category_id='.$id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    while($row = $rel->fetch_assoc()){
      $data .= '

                    <div class="col-12 col-md-3 p-4 bg-white">
                      <div class=" p-2 border border-primary rounded">
                        <div style="height: 250px; vertical-align: center;">
                          <img src="'.$row["img_link"].'" width="100%" align="center" valign="center"/>
                        </div>
                        <b>'.$row["price"].'đ</b></br>
                        '.$row["name"].'</br>
                        <div class="text-center">
                          <a href="sanpham.php?id='.$row["id"].'"><button class="btn btn-outline-primary">Xem chi tiết</button></a>
                        </div>
                      </div>
                    </div>

                ';
    }
    $data .= '</div></div>';
    echo $data;
  }
}
?>