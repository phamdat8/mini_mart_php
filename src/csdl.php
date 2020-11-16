<?php
class csdl
{
	function connect()
	{
		$con = new Mysqli("localhost","root","","congtyabc");
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
		$link = $this->connect();
		$ketqua = Mysqli_query($link,$sql);
		$i = Mysqli_num_rows($ketqua);
		if($i>0)
		{
			while($row = Mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$tensp = $row['tensp'];
				$gia = $row['gia'];
				$hinh = $row['hinh'];
			
				echo'<div  id="products">
					<div id="products_name">'.$tensp.'</div>
					<div id="products_images"><img src="../images/seed/'.$hinh.'" style="height: 225px; width: 200px;">images</div>
					<div id="products_price">'.$gia.'</div>
					
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