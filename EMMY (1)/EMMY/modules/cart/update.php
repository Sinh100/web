<?php

if (isset($_POST['btn_update_cart'])) {
	update_cart($_POST['soluong']);
   header("Location:?mod=cart&act=show");// chuyển hướng
}

?>

