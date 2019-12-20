
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

	$status = $editcategory['trangthai'] == 0 ? 1 : 0;

	$update = $db->update("loaisanpham",array("trangthai" => $status) , array("id_loai" => $id));
	$update = $db->update("sanpham",array("trangthai" => $status) , array("maloai" => $id));
	if($update > 0 )
	{
		$_SESSION['success'] = "Cập nhật thành công";
		redirectAdmin("loaisanpham");
	}
	else
	{
		// thêm thất bại
		$_SESSION['error'] = "Dữ liệu không thay đổi";
		redirectAdmin("loaisanpham");
	}


?>