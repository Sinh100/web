<?php

# Hủy cookie

# Xử lý logout
unset($_SESSION['is_login']);

unset($_SESSION['user_login']);

unset($_SESSION['cart']['buy']);

header("Location: ?mod=users&act=login");

?>