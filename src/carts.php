<?php
session_start();
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();
switch ($_GET['submit']) {
  case 'decrease':
    $sql = 'update carts set quantity = quantity - 1 where id='.$_GET['id'];
    $rel = mysqli_query($GLOBALS['con'], $sql);
    break;
  case 'increase':
    $sql = 'update carts set quantity = quantity + 1 where id='.$_GET['id'];
    $rel = mysqli_query($GLOBALS['con'], $sql);
    break;
  case 'delete':
    $sql = 'delete from carts where id='.$_GET['id'];
    $rel = mysqli_query($GLOBALS['con'], $sql);
    break;
  case 'pay':
    $user_id = $_SESSION['user_id'];
    $sql = 'insert into orders(user_id) values ('.$user_id.')';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $sql = 'select * from orders where user_id = '.$user_id.' order by id desc limit 1';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $row = $rel->fetch_array();
    $orders_id = $row['id'];
    $total_price = 0;
    $sql = 'select *, c.quantity as c_quantity from carts c join products p where c.product_id = p.id and c.user_id='.$user_id;
    $rel_2 = mysqli_query($GLOBALS['con'], $sql);
    while($row = $rel_2->fetch_assoc()) {
      $sql = 'insert into order_details(order_id, product_id, quantity) values ('.$orders_id.','.$row["product_id"].','.$row["c_quantity"].')';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $total_price += $row["c_quantity"]*$row["price"];
    }
    $sql = 'update orders set total_price = '.$total_price.' where id='.$orders_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $sql = 'delete from carts where user_id='.$user_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    break;
  case 'add':
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
    $quantity = $_GET['quantity'];
    $sql = 'select * from carts where user_id='.$user_id.' and product_id='.$product_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $num = $rel->num_rows;
    if($num == 1){
      $sql = 'update carts set quantity = '.$quantity.' where user_id='.$user_id.' and product_id='.$product_id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
    }else{
      $sql = 'insert into carts(user_id, product_id, quantity) values ('.$user_id.','.$product_id.','.$quantity.')';
      $rel = mysqli_query($GLOBALS['con'], $sql);
    }
    break;
}
class cart{
  function show(){
    $user_id = $_SESSION["user_id"];
    if(!isset($user_id)){
      return 0;
    }
    $sql = 'select *, c.quantity as c_quantity, c.id as c_id from carts c join products p
            where c.product_id = p.id and c.user_id='.$user_id;
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $data = '';
    $total = 0;
    while($row = $rel->fetch_assoc()){
        $money = $row["price"]*$row["c_quantity"];
        $total += $money;
        $data .= '<tr id="_'.$row["c_id"].'">';
        $data .= '<td>'.$row["name"].'</td>';
        $data .= '<td><img src=../'.$row['img_link'].' height=50px width=70px></div></td>';
        $data .= '<td>
                    <div class="change_quantity" onclick="decrease('.$row["c_id"].')">-</div>
                    <div class="change_quantity" id="quantity_'.$row["c_id"].'">'.$row["c_quantity"].'</div>
                    <div class="change_quantity" onclick="increase('.$row["c_id"].')">+</div>
                  </td>';
        $data .= '<td id="price_'.$row["c_id"].'">'.$row["price"].'</td>';
        $data .= '<td id="money_'.$row["c_id"].'">'.$money.'</td>';
        $data .= '</tr>';
    }

    $data .= '<tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Tổng cộng:</th>
                <th id = "total">'.$total.'</th>
              </tr>';
    echo $data;
  }
}
?>