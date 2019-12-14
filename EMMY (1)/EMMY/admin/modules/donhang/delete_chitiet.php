

<?php 
		$open = "donhang";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));

		$data = 
		[
			'status' => 0
		];


		$editproduct = $db->fetchID_macthoadon("cthoadon", $id);
		
		if(empty($editproduct))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("donhang");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/
		
			$num =$db->delete("cthoadon",$id);
			//print_r($num);die();
			if($num > 0)
			{
				$_SESSION['success'] = "Xóa thành công";
				redirectAdmin("donhang");
			}
			else
			{
				$_SESSION['error'] = "Xóa thất bại";
				redirectAdmin("donhang");
			}
		
		

 ?>
