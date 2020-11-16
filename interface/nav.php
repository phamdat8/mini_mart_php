<?php
include('../src/connect.php');
$p = new connect();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../css/nav_style.css">
<meta name="viewport" content="width=divice-width, initial-scale=1">
<link rel="stylesheet" href="../boostrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../boostrap/js/jquery-3.5.1.js">
<link rel="stylesheet" href="../boostrap/js/bootstrap.min.js">
</head>

<body>
<div class="conteiner">


	<div  id="main">
		<div id="main_left">main_left</div>
			<div  id="main_right">

  <?php
      $p->xuatsanpham("select * from products");
  ?>			
			</div>
		</div>	
</div>	

</body>
</html>