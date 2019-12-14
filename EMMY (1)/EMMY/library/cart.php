<?php

function add_cart($id, $item,$sl, $sz) {
   
    if(!empty($sl))
    {
        $soluong = $sl;
    }
	else
    {
        $soluong=1;
    }
    if(!empty($sz))
    {
        $size = $sz;
    }
    else{
        $size = 32;
    }
	if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        //$soluong = số lg bên trong giỏ hàng + 1
		$soluong = $_SESSION['cart']['buy'][$id]['soluong'] + 1;
	}
    return $_SESSION['cart']['buy'][$id] = array(// lưu thông tin mua sản phẩm:buy
    	'id' => $item['id'],
    	'tensp' => $item['tensp'],
    	'gia' => $item['gia'],
    	'hinhanh' => $item['hinhanh'],
    	'maloai' => $item['maloai'],
    	'soluong' => $soluong,
        'size' => $size,
        'sub_total' => $item['gia'] * $soluong // tổng
    );
    // Cập nhật hóa đơn
    update_info_cart();
}

function add_detail_cart($id, $item)
{
    return $_SESSION['cart']['buy'][$id] = array(
        'ma_HD'   => $item['ma_HD'],
        'ma_SP'   => $item['ma_SP'],
        'soluong' => $item['soluong'],
        'size'    => $item['size'],
        'gia'     => $item['gia']
    );
    update_info_cart();
}

function update_info_cart() {
	if (isset($_SESSION['cart'])) {
		$num_order = 0;
		$total = 0;
		foreach ($_SESSION['cart']['buy'] as $item) {
			$num_order += $item['soluong'];
			$total += $item['sub_total'];
		}
        return $_SESSION['cart']['info'] = array(// lưu thông tin hóa đơn: info
            'num_order' => $num_order, // tổng số lg
            'total' => $total
        );
    }
}
//Lấy thông tin sản phẩm 
function get_list_by_cart() {
	if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) { // & là tham trị ; $ là tham chiếu
        	$item['url_delete_cart'] = "?mod=cart&act=delete&id={$item['id']}";
        }
        return $_SESSION['cart']['buy']; // chỉ xuất ra sản phẩm muốn mua
    }
    return FALSE;
}

function get_num_order_cart() { // lấy số lg
	if (isset($_SESSION['cart'])) {
		return $_SESSION['cart']['info']['num_order'];
	}
	return FALSE;
    // có thế ghi 1 dòng duy nhất => return $_SESSION['cart']['info']['num_order'];
}

function get_total_cart() { // lấy tổng tiền
	if (isset($_SESSION['cart'])) {
		return $_SESSION['cart']['info']['total'];
	}
	return FALSE;
}

function delete_cart($id) {
    # xóa sản phẩm có $id trong giỏ hàng
	if (isset($_SESSION['cart'])) {
        if (!empty($id)) { // $id không rỗng
            unset($_SESSION['cart']['buy'][$id]); // chỉ xóa có $id
            update_info_cart(); // cập nhật lại nguyên cái giỏ cmn hàng
        } else {
            unset($_SESSION['cart']); // xóa tất cả ( dùng để delete-all)
        }
    }
}

function update_cart($soluong) {
	foreach ($soluong as $id => $new_soluong) {
		$_SESSION['cart']['buy'][$id]['soluong'] = $new_soluong;
		$_SESSION['cart']['buy'][$id]['sub_total'] = $new_soluong * $_SESSION['cart']['buy'][$id]['gia'];
	}
	update_info_cart();
}
function get_list_user($user_login) {
    $sql = "SELECT * FROM users where email like '$user_login'";
    $result = db_fetch_row($sql);
    return $result;
}
function get_order($ma_hd) {
    $sql = "SELECT tensp,gia,cthoadon.soluong,(gia*cthoadon.soluong)as tongtien FROM cthoadon, sanpham WHERE cthoadon.ma_HD = $ma_hd AND sanpham.id = cthoadon.ma_SP";
    $result = db_fetch_array($sql);
    return $result;
}
?>