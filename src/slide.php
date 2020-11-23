<?php
if(!isset($_SESSION)) {
 session_start();
}
include_once('connect.php');
$p = new connect();
$GLOBALS['con'] = $p -> conn();
class slide{
  function show_slide(){
    $data = '<div class="container col-md-10 bg-light mt-5" style="height:400px">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner mt-5"  style="margin-top: 86px" >';
    $sql = 'select * from slides where deleted = false';
    $rel = mysqli_query($GLOBALS['con'], $sql);
    $count = 1;
    while($row = $rel->fetch_assoc()){
      $data .= '<div class="carousel-item ' ;
      $data .= $count == 1 ? 'active' : '';
      $data .= '">
                    <img src="'.$row["img_link"].'" class="h-100 img-fluid" alt="...">
                </div>';

      $count = 2;
    }
    $data .= '</div></div></div>';
    echo $data;
  }

}
?>