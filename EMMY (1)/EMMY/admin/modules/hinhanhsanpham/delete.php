
<?php 
		$open = "hinhanhsanpham";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('hinhID'));




		$editblog = $db->fetchIDhinhanh("hinhanh", $id);
		if(empty($editblog))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("hinhanhsanpham");
		}

		/**
		*	kiểm tra xem rằng danh mục có sản phẩm chưa
		*/

		$is_product = $db->fetchOne("sanpham"," id = $id ");
		if($is_product == NULL)
		{

			$num =$db->deletehinh("hinhanh",$id);
			if($num > 0)
			{
				$_SESSION['success'] = "Xóa thành công";
				redirectAdmin("hinhanhsanpham");
			}
			else
			{
				$_SESSION['error'] = "Xóa thất bại";
				redirectAdmin("hinhanhsanpham");
			}

		}
		else
		{
			$_SESSION['error'] = "Danh mục có sản phẩm ! bạn không thể xóa";
			redirectAdmin("danhmucbaiviet");
		}




		

 ?>
