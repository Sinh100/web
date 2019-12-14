
<?php 
		$open = "user";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id'));




		$deleteUser = $db->fetchID("users", $id);
		if(empty($deleteUser))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("users");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$num =$db->delete("users",$id);
		if($num > 0)
		{
			$_SESSION['success'] = "Xóa thành công";
			redirectAdmin("users");
		}
		else
		{
			$_SESSION['error'] = "Xóa thất bại";
			redirectAdmin("users");
		}

		

 ?>
