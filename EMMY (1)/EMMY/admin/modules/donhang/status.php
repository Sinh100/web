<?php 

	require_once __DIR__. "/../../autoload/autoload.php";


	$id = intval(getInput('id'));




	$edittransaction = $db->fetchID_mahoadon("cthoadon", $id);
	if(empty($edittransaction))
	{
		$_SESSION['error'] = "Dữ liệu không tồn tại";
		redirectAdmin("donhang");
	}


	if($edittransaction["status"] == 1)
	{
		$_SESSION['error'] = "Đơn hàng đã được xử lý";
		redirectAdmin("donhang");
	}


	$status = 1;

	$update = $db->update("cthoadon",array("status" => $status) , array("ma_HD" => $id));
	if($update > 0 )
	{
		$_SESSION['success'] = "Cập nhật thành công";

		$sql = " SELECT ma_SP,soluong FROM  cthoadon WHERE ma_HD = $id" ;
		$order = $db->fetchsql($sql);
		foreach ($order as $item ) 
		{
			$idproduct = intval($item['ma_SP']);

			$product = $db->fetchID("sanpham",$idproduct);

			$number = $product["soluong"] -  $item['soluong'];

			$update_pro = $db->update("sanpham",array("soluong"=>$number), array("id" =>$idproduct));

		}

		redirectAdmin("donhang");
	}
	else
	{
		// thêm thất bại
		$_SESSION['error'] = "Dữ liệu không thay đổi";
		redirectAdmin("donhang");
	}




 ?>