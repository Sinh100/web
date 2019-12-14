<?php 
function get_Listproduct()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 order by id DESC";
	$result = db_fetch_array($sql);
	return $result;
}
function get_Listproductdetail($id_sp)
{
	$sql = "SELECT * FROM sanpham,loaisanpham, hinhanh WHERE sanpham.trangthai =1 and sanpham.id = hinhanh.hinhspid and loaisanpham.id_loai=sanpham.maloai and id = $id_sp";
	$result = db_fetch_row($sql);
	return $result;
}

function get_product($start, $num_per_page) {
	$result = db_fetch_array("SELECT *,sanpham.created_at FROM sanpham,loaisanpham WHERE sanpham.trangthai =1 and loaisanpham.trangthai =1 and sanpham.maloai=loaisanpham.id_loai order by sanpham.created_at DESC LIMIT {$start}, {$num_per_page} ");
	return $result;
}
function get_categoris($start, $num_per_page,$id_loai) {
	$result = db_fetch_array("SELECT *,sanpham.created_at FROM sanpham,loaisanpham where sanpham.trangthai =1 and loaisanpham.trangthai =1 and sanpham.maloai=loaisanpham.id_loai and maloai=$id_loai ORDER BY sanpham.created_at DESC LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_Related($id_loai) {
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai ORDER BY id DESC LIMIT 0, 8");
	return $result;
}
function get_Search_paging($start, $num_per_page,$tuKhoa) {
	$result = db_fetch_array("SELECT *,sanpham.created_at FROM `sanpham`,loaisanpham WHERE sanpham.trangthai = 1 and sanpham.maloai = loaisanpham.id_loai and loaisanpham.trangthai = 1 and tensp like N'%$tuKhoa%' group BY id DESC LIMIT {$start}, {$num_per_page}");
	// printf($result);die();
	return $result;
}
function get_Search($tuKhoa)
{
	$sql = "SELECT gia,hinhanh,tensp,motangan,motadai,id,sanpham.created_at FROM sanpham,loaisanpham where sanpham.trangthai =1 and loaisanpham.trangthai =1 and sanpham.maloai=loaisanpham.id_loai and tensp like N'%$tuKhoa%' GROUP by id";
	$result = db_fetch_array($sql);
	return $result;
}
function get_default()
{
	$sql = "SELECT * FROM default_sorting";
	$result = db_fetch_array($sql);
	return $result;
	  
}

function get_lowhigh()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 ORDER BY gia ASC";
	$result = db_fetch_array($sql);
	return $result;
}

function get_0_200()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 and gia between 0 and 200 ";
	$result = db_fetch_array($sql);
	return $result;
}
function get_200_600()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 and gia between 200 and 600 ";
	$result = db_fetch_array($sql);
	return $result;
}
function get_600_1200()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 and gia between 600 and 1200 ";
	$result = db_fetch_array($sql);
	return $result;
}
function get_1200_2000()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 and gia between 1200 and 2000 ";
	$result = db_fetch_array($sql);
	return $result;
}
function get_2000_plus()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 and gia > 2000 ";
	$result = db_fetch_array($sql);
	return $result;
}
// function get_lowhigh_paging($start, $num_per_page) {
// 	$result = db_fetch_array("SELECT * FROM sanpham ORDER BY gia ASC LIMIT {$start}, {$num_per_page}");
// 	return $result;
// }
function get_product_lowhigh_cate($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai  ORDER BY gia ASC LIMIT {$start}, {$num_per_page}");
	return $result;
}

function get_product_0_200($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai and gia between 0 and 200 LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_product_200_600($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai and gia between 200 and 600 LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_product_600_1200($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai and gia between 600 and 1200 LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_product_1200_2000($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai and gia between 1200 and 2000 LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_product_2000_plus($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai and gia > 2000 LIMIT {$start}, {$num_per_page}");
	return $result;
}

function get_product_lowhigh($start, $num_per_page) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and ORDER BY gia ASC LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_highlow()
{
	$sql = "SELECT * FROM sanpham where trangthai =1 ORDER BY gia DESC";
	$result = db_fetch_array($sql);
	return $result;
}

function get_product_highlow_cate($start, $num_per_page,$id_loai) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and maloai=$id_loai  ORDER BY gia DESC LIMIT {$start}, {$num_per_page}");
	return $result;
}

function get_product_highlow($start, $num_per_page) {
	
	$result = db_fetch_array("SELECT * FROM sanpham where trangthai =1 and ORDER BY gia DESC LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_Popularity()
{
	$sql = "SELECT * FROM `sanpham` WHERE trangthai =1 and (id % 2) !=0";
	$result = db_fetch_array($sql);
	return $result;
}

function get_Popularity_pagging($start, $num_per_page) {
	$result = db_fetch_array("SELECT * FROM sanpham WHERE trangthai =1 and (id % 2) !=0 LIMIT {$start}, {$num_per_page}");
	return $result;
}
function get_Popularity_pagging_cate($start, $num_per_page,$id_loai) {
	$result = db_fetch_array("SELECT * FROM sanpham WHERE trangthai =1 and maloai=$id_loai ORDER BY sanpham.created_at DESC LIMIT {$start}, {$num_per_page}");
	$listnew = array();
foreach ($result as $product ) {
	  $date = getdate();
                            // show_array($date);
    $currentDate = $date["year"] . "-". $date["mon"] . "-". $date["mday"];

     $week = strtotime(date("Y-m-d", strtotime($product['created_at'])) . " +1 week");
      
       $datediff = $week-(strtotime($currentDate));
       
      
        if(floor($datediff / (60*60*24)) > 0 && floor($datediff / (60*60*24)) <= 7 ){
            $listnew[] = $product;
        }
}
	return $listnew;
}
?>