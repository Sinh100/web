
<?php 
		$open = "sanpham";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));

		$data = 
		[
			'trangthai' => 0
		];


		$editproduct = $db->fetchID("sanpham", $id);
		if(empty($editproduct))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("sanpham");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$num =$db->update("sanpham",$data,array("id"=>$id));
		if($num > 0)
		{
			$_SESSION['success'] = "Xóa thành công";
			redirectAdmin("sanpham");
		}
		else
		{
			$_SESSION['error'] = "Xóa thất bại";
			redirectAdmin("sanpham");
		}

		

 ?>
