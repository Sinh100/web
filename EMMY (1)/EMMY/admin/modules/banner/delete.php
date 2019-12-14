
<?php 
		$open = "banner";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));




		$editbanner = $db->fetchID("slideshows", $id);
		if(empty($editbanner))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("banner");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/
			$num =$db->delete("slideshows",$id);
			if($num > 0)
			{
				$_SESSION['success'] = "Xóa thành công";
				redirectAdmin("banner");
			}
			else
			{
				$_SESSION['error'] = "Xóa thất bại";
				redirectAdmin("banner");
			}



		

 ?>
