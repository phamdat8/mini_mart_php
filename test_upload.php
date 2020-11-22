
<html>
  <?php
  error_reporting(E_ALL); ini_set('display_errors', '1');
  if($_POST["submit"] == "UP"){
    echo $_FILES["file"]["tmp_name"];
    move_uploaded_file($_FILES["file"]["tmp_name"], "db/tmp_up");
  }
  ?>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit" value="UP"> UP </button>
  </form>
</html>