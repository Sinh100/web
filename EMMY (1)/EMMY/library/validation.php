<?php

function is_username($username) {
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $username, $matchs))
        return FALSE;
    return TRUE;
}

function is_password($password) {
    $partten = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
    if (!preg_match($partten, $password, $matchs))
        return FALSE;
    return TRUE;
}
function is_email($email) {
    $partten = "/^[A-Za-z0-9_.]{2,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($partten, $email, $matchs))
        return FALSE;
    return TRUE;
}
?>