ewfefwfwfrwffwrf


<?php

    session_start();
    require_once __DIR__. "/../libraries/Database.php";
    require_once __DIR__. "/../libraries/Function.php";

    $db = new Database ;
    $error = [];


    $data = 
    [
        'email'    => postInput("email"),
        'password' => postInput("password")
    ];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($data['email'] == '')
        {
            $error['email'] = 'Email không được để trống '; 
        }

        if($data['password'] == '')
        {
            $error['password'] = 'Password không được để trống '; 
        }

        if(empty($error))
        {
            $is_check = $db->fetchOne("thanhvien","email = '".$data['email']."' AND password = '".md5($data['password'])."' ");

            if($is_check != NULL)
            {
                $_SESSION['admin_name'] = $is_check['name'];
                $_SESSION['admin_id'] = $is_check['id'];
                $_SESSION['admin_level'] = $is_check['level'];
                echo "<script>alert(' Đăng Nhập Thành Công');location.href='/EMMY/admin'</script>";
            }
            else
            {
                $_SESSION['error'] = 'Đăng nhập thất bại';
            }
        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    body
    {

        background-image: url(website-login-background.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;   
    }
</style>
</head>
<body >
<div class="login-form">
    <form action="" method="POST">
        <h2 class="text-center">EMMY</h2>       
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
            <button type="submit" class="btn btn-primary btn-block">Log in</button>       
    </form>
</div>
</body>
</html>                                