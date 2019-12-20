
<?php 
		$open = "thanhvien";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));




		$deleteadmin = $db->fetchID("thanhvien", $id);
		if(empty($deleteadmin))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("thanhvien");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$num =$db->delete("thanhvien",$id);
		if($num > 0)
		{
			$_SESSION['success'] = "Xóa thành công";
			redirectAdmin("thanhvien");
		}
		else
		{
			$_SESSION['error'] = "Xóa thất bại";
			redirectAdmin("thanhvien");
		}

		

 ?>
