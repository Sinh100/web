
<?php 
		$open = "danhmucbaiviet";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id_dm'));




		$editblog = $db->fetchIDblog("dmbaiviet", $id);
		if(empty($editblog))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("danhmucbaiviet");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$is_product = $db->fetchOne("baiviet"," iddm = $id ");
		if($is_product == NULL)
		{

			$num =$db->deleteblog("dmbaiviet",$id);
			if($num > 0)
			{
				$_SESSION['success'] = "Xóa thành công";
				redirectAdmin("danhmucbaiviet");
			}
			else
			{
				$_SESSION['error'] = "Xóa thất bại";
				redirectAdmin("danhmucbaiviet");
			}

		}
		else
		{
			$_SESSION['error'] = "Danh mục có bài viết ! bạn không thể xóa";
			redirectAdmin("danhmucbaiviet");
		}




		

 ?>
