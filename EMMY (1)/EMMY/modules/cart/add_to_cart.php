<?php

$id = (int) $_GET['id'];
$sl = $_GET['sl'];
$size = $_GET['size'];
$sql = "SELECT * FROM `sanpham` WHERE `id` = '{$id}' and trangthai = 1"; // lấy dữ liệu sp
$result = mysqli_query($conn, $sql);
$item = array(); // tạo 1 mảng $item
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    $row = $result->fetch_assoc();
    $item = $row; // gán $item vào
}
// show_array($item);
# Lấy đc thông tin SP cần thêm vào giỏ hàng
//
$_SESSION['cart']['buy'][$id] = add_cart($id, $item,$sl,$size);
 // show_array($_SESSION['cart']['buy'][$id]);
$_SESSION['cart']['info'] = update_info_cart();

header("Location:?mod=cart&act=show")
?>

