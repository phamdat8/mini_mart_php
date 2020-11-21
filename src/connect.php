<?php
class connect{
  function conn(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    mysqli_select_db($conn, 'mini_mart');
    return $conn;
  }
}
?>
