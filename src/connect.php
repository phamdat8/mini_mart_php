<?php 

class connect
{
	function conn()
	{
		$con = new Mysqli("127.0.0.1","develop","123","mini_mart");
		if(!$con)
		{
			echo"không kết nối được";
			exit();
		}
		else
		{
			return $con;
		}
	}

	function xuatsanpham($sql)
	{
		$link = $this->conn();
		$ketqua = Mysqli_query($link,$sql);
		$i = Mysqli_num_rows($ketqua);
		if($i>0)
		{
			while($row = Mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$tensp = $row['name'];
				$gia = $row['price'];
				$hinh = $row['img'];
			
				echo'<div  id="products">
					<div id="products_name">'.$tensp.'</div>
					<div id="products_images"><img src="../images/'.$hinh.'" style="height: 225px; width: 200px;">images</div>
					<div id="products_price">'.'Giá: '.$gia.'</div>
					
				</div>';
					
				
			}
		}
		else
		{
			echo"Đang cập nhật dữ liệu";
		}
	}
}
?>