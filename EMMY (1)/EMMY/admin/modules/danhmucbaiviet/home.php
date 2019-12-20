
<?php 

	$open = "danhmucbaiviet";
	require_once __DIR__. "/../../autoload/autoload.php";


	$id = intval(getInput('id_dm'));

	$editcategory = $db->fetchIDblog("dmbaiviet", $id);
	if(empty($editcategory))
	{
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirectAdmin("danhmucbaiviet");
	}

	$status = $editcategory['trangthai'] == 0 ? 1 : 0;

	$update = $db->update("dmbaiviet",array("trangthai" => $status) , array("id_dm" => $id));
	if($update > 0 )
	{
		$_SESSION['success'] = "Cập nhật thành công";
		redirectAdmin("danhmucbaiviet");
	}
	else
	{
		// thêm thất bại
		$_SESSION['error'] = "Dữ liệu không thay đổi";
		redirectAdmin("danhmucbaiviet");
	}


?>