<?php
// Xóa sản phẩm nào
$id = (int) $_GET['id'];
delete_cart($id);
header("Location:?mod=cart&act=show") // chuyển hướng
?>
