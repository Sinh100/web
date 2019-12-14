<?php
function get_Blog()
{
	$sql = "SELECT * FROM `baiviet` where trangthai = 1";
	$result = db_fetch_array($sql);
	return $result;
}
//phân trang
function get_Blog_pagging($start, $num_per_page) {
    $result = db_fetch_array("SELECT * FROM baiviet where trangthai = 1 LIMIT {$start}, {$num_per_page}");
    return $result;
}

// chi tiết blog
function get_Listblogdetail($id_blog)
{
	$sql = "SELECT * FROM baiviet,dmbaiviet WHERE baiviet.iddm = dmbaiviet.id_dm and id = $id_blog and baiviet.trangthai = 1";
	$result = db_fetch_row($sql);
	return $result;
}
//phân trang theo categories
function get_Blog_categoris($start, $num_per_page,$id_dm) {
    $result = db_fetch_array("SELECT * FROM baiviet,dmbaiviet where baiviet.iddm = dmbaiviet.id_dm and iddm=$id_dm and baiviet.trangthai = 1  LIMIT {$start}, {$num_per_page}");
    return $result;
}