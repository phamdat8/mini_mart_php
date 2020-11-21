<?php
  session_start();
  include_once('connect.php');
  $p = new connect();
  $GLOBALS['con'] = $p -> conn();
  class order{
    function show_all($user_id){
      echo '<div class="container bg-light mt-5 pt-5 pb-3">
              <h3 class="text-light">Các hoá đơn đã mua</h3>';
      $sql = 'select * from orders where user_id='.$user_id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
        $this-> show($row['id']);
      }
      echo '</div>';
    }

    function show($id){
      $sql = 'select *, date_format(created_at, "%d-%m-%Y") as day, date_format(created_at, "%h:%m") as time from orders where id='.$id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $row = $rel->fetch_array();
      $data = '<div class="row border border-primary rounded m-3 bg-white">
                <div class="col-md-3 p-5">
                  <h3>#'.$id.'</h3>
                </div>
                <div class="col-md-3 p-3">
                  <div class="row">
                    <div class="m-0 p-1"><img src="shared/images/day.png" width="40px"></div>
                    <div class="p-2 m-1"><h5><b>'.$row["day"].'</b></h5></div>
                  </div>
                  <div class="row">
                    <div class="m-0 p-1"><img src="shared/images/time.png" width="30px"></div>
                    <div class="p-2 m-1"><h5>'.$row["time"].'</h5></div>
                  </div>
                </div>
                <div class="col-md-4 p-4">
                  <div class="row">
                    <div class="mt-1 p-1"><img src="shared/images/money.png" width="50px"></div>
                    <div class="p-2 mt-3"><h4>'.$row["total_price"].'  đồng</h4></div>
                  </div>
                </div>
                <div class="col-md-2 pt-5">
                  <a href="/chitiet-hoadon.php?id='.$id.'"><button class="btn btn-outline-primary">Xem chi tiết</button></a>
                </div>
              </div>';
      echo $data;
    }
    function detail($id){
      echo '<div class="row justify-content-center align-items-center" style="padding-top: 90px">
              <div class="table-responsive col-sm-10 col-md-10 m-5 mt-1 border border-dark rounded">
                <h1>Đơn hàng của bạn #'.$id.'</h1>
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th class="p-3">Tên sản phẩm</th>
                      <th class="p-3 text-center">Ảnh</th>
                      <th class="p-3 text-center">Số lượng</th>
                      <th class="p-3 text-center">Đơn giá</th>
                      <th class="p-3 text-center">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>';
      $sql = 'select *, d.quantity as d_quantity from order_details d join products p where d.product_id= p.id and order_id='.$id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $total = 0;
      $data = '';
      while($row = $rel->fetch_assoc()){
        $money = $row["price"]*$row["d_quantity"];
        $total += $money;
        $data .= '<tr>';
        $data .= '<td>'.$row["name"].'</td>';
        $data .= '<td><img src=../'.$row['img_link'].' height=50px width=70px></div></td>';
        $data .= '<td class="text-center">'.$row["d_quantity"].'</td>';
        $data .= '<td class="text-center">'.$row["price"].'</td>';
        $data .= '<td class="text-center">'.$money.'</td>';
        $data .= '</tr>';
      }
      $data .= '<tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center"><b>Tổng cộng:</b></td>
                  <td class="text-center"><b>'.$total.'</b></td>
                </tr>';
      echo $data;
      echo '</tbody>
          </table>
        </div>
      </div>';

    }
  }
?>
