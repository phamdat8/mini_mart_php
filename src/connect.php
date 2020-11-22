<?php
class connect{
  function conn(){
    $servername = "127.0.0.1";
    $username = "develop";
    $password = "";
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
      echo "Khong the ket noi";
      die("Connection failed: " . $conn->connect_error);
    }
    echo "ket noi thanh cong";
    mysqli_select_db($conn, 'mini_mart');
    return $conn;
  }
}
?>
