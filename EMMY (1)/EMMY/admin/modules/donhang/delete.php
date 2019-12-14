

<?php 
		$open = "donhang";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));

		$data = 
		[
			'status' => 0
		];


		$editproduct = $db->fetchID_hoadon("hoadon", $id);
		
		if(empty($editproduct))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("donhang");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/
		// $is_cthoadon = $db->fetchOne("cthoadon"," ma_HD = $id and status=1 ");
		// if($is_cthoadon == NULL)
		// {
			$num =$db->update("hoadon",$data,array("maHD"=>$id));
			$num_ct =$db->update("cthoadon",$data,array("ma_HD"=>$id));
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
		// }
		// else
		// {
		// 	$_SESSION['error'] = "Hóa đơn có sản phẩm ! bạn không thể xóa";
		// 	redirectAdmin("donhang");
		// }
		

 ?>
