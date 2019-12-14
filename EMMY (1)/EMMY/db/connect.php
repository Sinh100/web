<?php
// Kết nối databases
$conn = mysqli_connect('localhost', 'root', '', 'emmy');
mysqli_set_charset($conn, 'UTF8');
if (!$conn) {
    echo "Kết nối thất bại." . mysqli_connect_error();
    die();
}
// } else {
//    echo "Kết nối thành công";
// }
?>