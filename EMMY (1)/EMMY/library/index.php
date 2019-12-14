<?php 
function get_Slideshows()
{
	$sql = "SELECT * FROM slideshows where trangthai = 1 ORDER BY stt ASC";
	$result = db_fetch_array($sql);
	return $result;
}
function get_Categories_Adidas()
{
	$sql = "SELECT * FROM loaisanpham where id_loai=1 and trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
function get_Categories_Air()
{
	$sql = "SELECT * FROM loaisanpham where id_loai=2 and trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
function get_Categories_Balenciaga()
{
	$sql = "SELECT * FROM loaisanpham where id_loai=3 and trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
function get_Categories_Converse()
{
	$sql = "SELECT * FROM loaisanpham where id_loai=4 and trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
function get_Categories_Vans()
{
	$sql = "SELECT * FROM loaisanpham where id_loai=5 and trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
function get_Featured_Products()
{
	$sql = "SELECT sanpham.id,sanpham.hinhanh,sanpham.created_at,sanpham.tensp,sanpham.gia,cthoadon.ma_SP,SUM(cthoadon.soluong) as sl from cthoadon, sanpham WHERE sanpham.trangthai = 1 and cthoadon.ma_SP = sanpham.id and sanpham.trangthai = 1 GROUP by cthoadon.ma_SP ORDER by sl DESC limit 0,10";
	$result = db_fetch_array($sql);
	return $result;
}

function get_Blog_index()
{
	$sql = "SELECT * FROM `baiviet` where trangthai = 1 ORDER by baiviet.id ASC limit 1,3 ";
	$result = db_fetch_array($sql);
	return $result;
}



?>