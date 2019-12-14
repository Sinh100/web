
<?php 
		$open = "loaisanpham";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id_loai'));




		$editcategory = $db->fetchIDloai("loaisanpham", $id);
		if(empty($editcategory))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("loaisanpham");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$is_product = $db->fetchOne("sanpham"," maloai = $id ");
		if($is_product == NULL)
		{

			$num =$db->deletecategory("loaisanpham",$id);
			if($num > 0)
			{
				$_SESSION['success'] = "Xóa thành công";
				redirectAdmin("loaisanpham");
			}
			else
			{
				$_SESSION['error'] = "Xóa thất bại";
				redirectAdmin("loaisanpham");
			}

		}
		else
		{
			$_SESSION['error'] = "Danh mục có sản phẩm ! bạn không thể xóa";
			redirectAdmin("loaisanpham");
		}




		

 ?>
