<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include('../src/connect.php');

  $p = new connect();
  $GLOBALS['con'] = $p -> conn();
  class data{
    function slides_list(){
      $data = '';
      $sql = 'select * from slides';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
          $data .= '<tr>';
          $data .= '<td>'.$row["id"].'</td>';
          $data .= '<td>'.$row["name"].'</td>';
          $data .= '<td><img src=../'.$row['img_link'].' height=50px width=70px></td>';
          if($row["active"]==1){
            $data .= '<td><img class="img-custom" src=../shared/images/true.png height=20px></td>';
          }else{
            $data .= '<td><img class="img-custom" src=../shared/images/false.png height=20px></td>';
          }
          $data .= '<td>
                      <form action="src/action.php" method="POST" style="margin: 0px">
                        <input type="hidden" name="item_id" value="'.$row["id"].'" >
                        <input type="hidden" name="item_table" value="slide" >
                        <button type="submit" name="submit" value="edit" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/edit.png height=40px></button>
                        <button type="submit" name="submit" value="delete" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/delete.png height=30px></button>
                      </form>
                    </td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function products_list(){
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
          $data .= '<td><img src=../'.$row['img_link'].' height=50px width=70px></div></td>';
          $data .= '<td>'.$row["username"].'</td>';
          $data .= '<td>'.$row["price"].'/'.$row["unit_type"].'</td>';
          $data .= '<td>
                      <form action="src/action.php" method="POST" style="margin: 0px">
                        <input type="hidden" name="item_id" value="'.$row["id"].'" >
                        <input type="hidden" name="item_table" value="product" >
                        <button type="submit" name="submit" value="edit" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/edit.png height=40px></button>
                        <button type="submit" name="submit" value="delete" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/delete.png height=30px></button>
                      </form>
                    </td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function product_form($id){
      $data = '';
      $sql = 'select * from products where id='.$id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $row = $rel->fetch_array();
      $img = isset($row["img_link"]) ? $row["img_link"] : "../shared/images/false.png";
      $data .= '<form action="src/action.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                  <input type="hidden" name="item_table" value="product">
                  <input type="hidden" name="item_id" value="'.$row["id"].'">
                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="'.$row["name"].'">
                  </div>
                  <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <input type="text" class="form-control" id="description" name="description" value="'.$row["description"].'">
                  </div>
                  <div>
                    <label for="image">
                      Hình ảnh:<div style="height:40px; width: 100px; background-color: #007bff; text-align: center;color: white; padding-top: 10px; border-radius: 5px; margin: 5px "><b>Thay đổi</b></div>
                      <input type="file" id="image" name="image" accept="image/*" onchange="loadFile(event)" style="display: none;">
                      <img id="output" height="200" src="../'.$img.'" alt="No image selected" />
                    </label>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="price">Giá sản phẩm:</label>
                      <input type="number" class="form-control" id="price" name="price" value="'.$row["price"].'">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="unit_type">Đơn vị tính:</label>
                      <select id="unit_type" class="form-control" name="unit_type">
                        <option selected>'.$row["unit_type"].'</option>
                        <option>Kg</option>
                        <option>Quả</option>
                        <option>Gói</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="category">Doanh mục:</label>
                      <select id="category" class="form-control" name="category">
                        <option selected>'.$row["category"].'</option>
                        <option>Trái cây</option>
                        <option>Rau củ</option>
                      </select>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit" value="update_product">Lưu thay đổi</button>
                  <button type="submit" class="btn btn-danger" name="submit" value="cancel">Huỷ thao tác</button>
                </form>';
      return $data;
    }

    function slide_form($id){
      $data = '';
      $sql = 'select * from slides where id='.$id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $row = $rel->fetch_array();
      $img = isset($row["img_link"]) ? $row["img_link"] : "../shared/images/false.png";
      $data .= '<form action="src/action.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="item_table" value="slide">
                  <input type="hidden" name="item_id" value="'.$row["id"].'">
                  <div class="form-group">
                    <label for="slide_name">Tên ảnh nền:</label>
                    <input type="text" class="form-control" id="silde_name" name="slide_name" value="'.$row["name"].'">
                  </div>
                  <div>
                    <label for="image">
                      Hình ảnh:<div style="height:40px; width: 100px; background-color: #007bff; text-align: center;color: white; padding-top: 10px; border-radius: 5px; margin: 5px "><b>Thay đổi</b></div>
                      <input type="file" id="image" name="slide_image" accept="image/*" onchange="loadFile(event)" style="display: none;" >
                      <img id="output" height="200" src="../'.$img.'" />
                    </label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" value="1" checked>
                    <label class="form-check-label" for="active">Kích hoạt ảnh</label>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit" value="update_slide">Lưu thay đổi</button>
                  <button type="submit" class="btn btn-danger" name="submit" value="cancel">Huỷ thao tác</button>
                </form>';
      return $data;
    }


    function users_list(){
      $data = '';
      $sql = 'select * from users';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      while($row = $rel->fetch_assoc()){
          $data .= '<tr>';

          $data .= '<td>'.$row["id"].'</td>';
          $data .= '<td>'.$row["username"].'</td>';
          $data .= '<td>'.$row["role"].'</td>';
          $data .= '<td>
                      <form action="src/action.php" method="POST" style="margin: 0px">
                        <input type="hidden" name="item_id" value="'.$row["id"].'" >
                        <input type="hidden" name="item_table" value="user" >
                        <button type="submit" name="submit" value="edit" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/edit.png height=40px></button>
                        <button type="submit" name="submit" value="delete" style="border: 0px; margin: 0px; background-color: transparent"><img src=../shared/images/delete.png height=30px></button>
                      </form>
                    </td>';
          $data .= '</tr>';
      }
      return $data;
    }

    function user_form($id){
      $data = '';
      $sql = 'select * from users where id='.$id;
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $row = $rel->fetch_array();
      $data .= '<form action="src/action.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="item_table" value="user">
                  <input type="hidden" name="item_id" value="'.$row["id"].'">
                  <div class="form-group">
                    <label for="username">Tên đăng nhập:</label>';
                    if($id == 0){
                      $data .= '<input type="text" class="form-control" id="username" name="username" value="">';
                    }else{
                      $data .= '<h4>'.$row["username"].'</h4>';
                    }
                   $data .= '</div>
                  <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" value="'.$row["password"].'">
                  </div>
                  <div class="form-group">Chức vụ:</label>
                    <select id="role" class="form-control" name="role">
                      <option selected>'.$row["role"].'</option>
                      <option>manager</option>
                      <option>admin</option>
                      <option>customer</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit" value="update_user">Lưu thay đổi</button>
                  <button type="submit" class="btn btn-danger" name="submit" value="cancel">Huỷ thao tác</button>
                </form>';
      return $data;
    }

    function orders_list(){
      $sql = 'select *, o.id as o_id, date_format(created_at, "%d-%m-%Y") as date from orders o join users u where o.user_id = u.id';
      $rel = mysqli_query($GLOBALS['con'], $sql);
      $data = '<title-name style="font-size: 40px">Quản lý hoá đơn</title-name>
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Người mua</th>
                      <th>Ngày mua</th>
                      <th>Giá trị đơn hàng </th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>';
      while($row = $rel->fetch_assoc()){
        $data .= '<tr>';

        $data .= '<td>'.$row["o_id"].'</td>';
        $data .= '<td>'.$row["username"].'</td>';
        $data .= '<td>'.$row["date"].'</td>';
        $data .= '<td>'.$row["total_price"].'</td>';
        $data .= '<td>
                    <a href="order.php?id='.$row["o_id"].'"><button class="btn btn-outline-primary">Xem chi tiết</button></a>
                  </td>';
        $data .= '</tr>';

      }
      $data .= '</tbody>
              </table>
            </div>';
      echo $data;

    }

    function detail($id){
      echo '<div class="row justify-content-center align-items-center">
              <div class="table-responsive col-sm-10 col-md-10 m-5 mt-1 border border-dark rounded">
                <h1>Thông tin đơn hàng #'.$id.'</h1>
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