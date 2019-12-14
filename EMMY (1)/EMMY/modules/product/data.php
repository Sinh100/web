<?php


// phân trang
$number_rows = db_num_rows("SELECT * FROM sanpham");

$num_per_page = 9;
$total_row = $number_rows;
$num_page = ceil($total_row / $num_per_page);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
$list[] = array();
if($_POST['id']==2)
{
	$Lowhigh = get_lowhigh_paging($start, $num_per_page);
	
}
else
{
	
}

?>

