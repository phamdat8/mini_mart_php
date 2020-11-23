<?php
  if(!isset($_SESSION)) {
     session_start();
  }
  include('../../src/connect.php');
  $p = new connect();
  $GLOBALS['con'] = $p -> conn();
    switch ($_POST['submit']) {
      case 'delete':
        $item_id = $_POST['item_id'];
        $item_table = $_POST['item_table'];
        switch($item_table){
          case 'category':
            $sql = 'update categories set deleted = true where id='.$item_id;
            $rel = mysqli_query($GLOBALS['con'], $sql);
            if($rel){
              $_SESSION['notification'] = 'Xoá thành công !';
            }else{
              $_SESSION['notification'] = 'Xoá thất bại !';
            }
            header("location: ../category.php");
            break;
          default:
            $sql = 'update '.$item_table.'s set deleted = true where id='.$item_id;
            $rel = mysqli_query($GLOBALS['con'], $sql);
            if($rel){
              $_SESSION['notification'] = 'Xoá thành công !';
            }else{
              $_SESSION['notification'] = 'Xoá thất bại !';
            }
            header("location: ../".$item_table.".php");
            break;
        }

        break;
      case 'edit':
        $item_id = $_POST['item_id'];
        $item_table = $_POST['item_table'];
        echo '<script>window.location = "../edit.php?type='.$item_table.'&id='.$item_id.'";</script>';
        break;
      case 'cancel':
        $table_name = $_POST['item_table'];
        echo '<script>window.location = "../'.$table_name.'.php";</script>';
        break;
      case 'update_slide':
        $item_id = $_POST['item_id'];
        $name = $_POST['slide_name'];
        $local = $_FILES['slide_image']['tmp_name'];
        if($item_id == 0){
          $sql = 'insert into slides(name) values ("'.$name.'")';
          $rel = mysqli_query($GLOBALS['con'], $sql);
          $sql = 'select * from slides order by id desc limit 1';
          $rel = mysqli_query($GLOBALS['con'], $sql);
          $row = $rel->fetch_array();
          $item_id = $row['id'];
          $sql = 'update slides set img_link="db/images/slides/'.$item_id.'" where id='.$item_id;
          $rel = mysqli_query($GLOBALS['con'], $sql);
          move_uploaded_file($local, '../../db/images/slides/'.$item_id);
          $_SESSION['notification'] = 'Thêm ảnh nền thành công';
          echo '<script>window.location = "../slide.php";</script>';
        }else{
          $sql = 'update slides set name="'.$name.'",active='.$active.' where id='.$item_id;
          $rel = mysqli_query($GLOBALS['con'], $sql);
          if($rel){
            if($local != ''){
              move_uploaded_file($local, '../../db/images/slides/'.$item_id);
              $sql = 'update slides set img_link="db/images/slides/'.$item_id.'" where id='.$item_id;
              $rel = mysqli_query($GLOBALS['con'], $sql);
              $_SESSION['notification'] = 'Cập nhật ảnh nền thành công';
              echo '<script>window.location = "../slide.php";</script>';
            }else{
              $_SESSION['notification'] = 'Cập nhật ảnh nền thành công';
              echo '<script>window.location = "../slide.php";</script>';
            }
          }else{
            echo 'update failed';
            // $_SESSION['notification'] = 'Cập nhật ảnh thất bại';
            // echo '<script>window.location = "../slide.php";</script>';
          }
        }
        break;
      case 'update_product':
        $item_id = $_POST['item_id'];
        $user_id = $_SESSION['user_id'];
        $name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $unit_type = $_POST['unit_type'];
        $category_id = ($_POST['category'] == 'Trái cây') ? 1 : 2 ;
        $local = $_FILES['image']['tmp_name'];
        if($item_id == 0){
          $sql = 'insert into products(name, description, price, user_id, category_id, unit_type) values ("'.$name.'","'.$description.'",'.$price.','.$user_id.','.$category_id.',"'.$unit_type.'")';
          $rel = mysqli_query($GLOBALS['con'], $sql);
          $sql = 'select * from products order by id desc limit 1';
          $rel = mysqli_query($GLOBALS['con'], $sql);
          $row = $rel->fetch_array();
          $item_id = $row['id'];
          $sql = 'update products set img_link="db/images/products/'.$item_id.'" where id='.$item_id;
          $rel = mysqli_query($GLOBALS['con'], $sql);
          move_uploaded_file($local, '../../db/images/products/'.$item_id);
          $_SESSION['notification'] = 'Thêm sản phẩm thành công';
          echo '<script>window.location = "../product.php";</script>';
        }else{
          echo $sql = 'update products set name="'.$name.'",description="'.$description.'",price='.$price.',category_id='.$category_id.',unit_type="'.$unit_type.'"  where id='.$item_id;
          $rel = mysqli_query($GLOBALS['con'], $sql);
          if(isset($local)){
            move_uploaded_file($local, '../../db/images/products/'.$item_id);
          }
          $_SESSION['notification'] = 'Chỉnh sửa sản phẩm thành công';
          echo '<script>window.location = "../product.php";</script>';
        }
        break;
      case 'update_user':
        $item_id = $_POST['item_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if($item_id == 0){
          $sql = 'insert into users(username, password, role) values ("'.$username.'","'.$password.'","'.$role.'")';
          $rel = mysqli_query($GLOBALS['con'], $sql);
          if($rel){
            $_SESSION['notification'] = 'Thêm người dùng thành công';
            echo '<script>window.location = "../user.php";</script>';
          }else{
            $_SESSION['notification'] = 'Có lỗi xảy ra';
            echo '<script>window.location = "../user.php";</script>';
          }
        }else{
        $sql = 'update users set password="'.$password.'", role="'.$role.'" where id='.$item_id;
        $rel = mysqli_query($GLOBALS['con'], $sql);
        $_SESSION['notification'] = 'Chỉnh sửa người dùng thành công';
        echo '<script>window.location = "../user.php";</script>';
        }
        break;
        case 'update_category':
          $item_id = $_POST['item_id'];
          $name = $_POST['name'];
          if($item_id == 0){
            $sql = 'insert into categories(name) values ("'.$name.'")';
            $rel = mysqli_query($GLOBALS['con'], $sql);
            if($rel){
              $_SESSION['notification'] = 'Thêm doanh mục thành công';
              echo '<script>window.location = "../category.php";</script>';
            }else{
              $_SESSION['notification'] = 'Có lỗi xảy ra';
              echo '<script>window.location = "../category.php";</script>';
            }
          }else{
          $sql = 'update categories set name="'.$name.'" where id='.$item_id;
          $rel = mysqli_query($GLOBALS['con'], $sql);
          $_SESSION['notification'] = 'Chỉnh sửa doanh mục thành công';
          echo '<script>window.location = "../category.php";</script>';
          }
        break;
      default:
      echo $_POST['submit'];
      break;

    }

?>
