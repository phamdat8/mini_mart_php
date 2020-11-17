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
        $sql = 'delete from '.$item_table.'s where id='.$item_id;
        $rel = mysqli_query($GLOBALS['con'], $sql);
        if($rel){
          $_SESSION['notification'] = 'Xoá thành công !';
        }else{
          $_SESSION['notification'] = 'Xoá thất bại !';
        }
        echo '<script>window.location = "../'.$item_table.'.php";</script>';
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
        $active = ($_POST['active']==1) ? 1 : 0;
        $local = $_FILES['slide_image']['tmp_name'];
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
        break;
      default:
      echo $_POST['submit'];
      break;
    }

?>
