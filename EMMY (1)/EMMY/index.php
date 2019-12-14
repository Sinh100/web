<?php

session_start();
ob_start();

if (isset($_COOKIE['is_login'])) { // ktra dữ liệu
   echo "{$_COOKIE['user_login']}"; // lấy ra cookie
//    echo "Cookie:{$_COOKIE['user_login']}"; // lấy ra cookie
}

require 'db/connect.php';
require 'db/database.php';
require 'db/email.php';
//Function: thư viện hàm
require 'library/validation.php';
require 'library/data.php';
require 'library/index.php';
require 'library/blog.php';
require 'library/template.php';
require 'library/email.php';

require 'library/users.php';
require 'library/pagging.php';
require 'library/product.php';
require 'library/cart.php';

?>

<?php

$mod = !empty($_GET['mod']) ? $_GET['mod'] : 'home';
$act = !empty($_GET['act']) ? $_GET['act'] : 'main'; // action: hanh` dong
$path = "modules/{$mod}/{$act}.php";

//Kiểm tra login
//if (!is_login() && $mod != 'login' && $act != 'login') {
//    // nếu is_login chưa login & page khác với login 
//    // ex:họ chưa mua vé mà họ đã đi vào trong rap phim
//    // tôi là người soát vé, tôi bảo họ là ra ngoài cổng mua vé mới đc vào
//
//    redirect_to("?mod=users&act=login"); // => tôi dẫn họ đến chỗ mua vé ~~ login
//}



if (file_exists($path)) {
	require $path;
} else {
	require './inc/404.php';
}
?>