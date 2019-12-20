
<?php 

	$open = "banner";
	require_once __DIR__. "/../../autoload/autoload.php";


	$id = intval(getInput('id'));

	$editbannner = $db->fetchID("slideshows", $id);
	if(empty($editbannner))
	{
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirectAdmin("slideshows");
	}

	$status = $editbannner['trangthai'] == 0 ? 1 : 0;

	$update = $db->update("slideshows",array("trangthai" => $status) , array("id" => $id));
	if($update > 0 )
	{
		$_SESSION['success'] = "Cập nhật thành công";
		redirectAdmin("banner");
	}
	else
	{
		// thêm thất bại
		$_SESSION['error'] = "Dữ liệu không thay đổi";
		redirectAdmin("banner");
	}


?>