<?php
function is_login() {
    if (isset($_SESSION['is_login']))
        return TRUE;
    return FALSE;
}

//Trả về username của người đã login
function user_login() {
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return FALSE;
}
function info_user($field = 'user_id') { //$field:trường
    $list_users = db_fetch_array("SELECT * FROM users");
    if (isset($_SESSION['is_login'])) { // Nếu tồn tại is_login
        foreach ($list_users as $email) {
            if ($_SESSION['user_login'] == $email['email']) {
                if (array_key_exists($field, $email)) {
//Nếu tồn tại id trong mảng $user =>
// array_key_exists: ktra 1 key có tồn tại trong mảng hay k
                    return $email[$field];
                }
            }
        }
    }
    return FALSE;
}

function update_reset_token($data,$email)
{
    return db_update('users',$data,"`email`='{$email}'");
}
function update_pass($data,$token)
{
    return db_update('users',$data,"`reset_token`='{$token}'");
}
function check_reset_token($token)
{
    $sql = db_num_rows("SELECT * FROM users WHERE reset_token = '$token'");
    if($sql>0)
     return true;
 return FALSE;
}
?>