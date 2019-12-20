
<?php 
		$open = "baiviet";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));




		$editproduct = $db->fetchID("baiviet", $id);
		if(empty($editproduct))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("baiviet");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$num =$db->delete("baiviet",$id);
		if($num > 0)
		{
			$_SESSION['success'] = "Xóa thành công";
			redirectAdmin("baiviet");
		}
		else
		{
			$_SESSION['error'] = "Xóa thất bại";
			redirectAdmin("baiviet");
		}

		

 ?>
