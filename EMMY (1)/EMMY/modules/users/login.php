<?php 

get_header();  

?>

<?php

if (isset($_POST['btn_login'])) {

    $error = array();
    //ktra username
    if (empty($_POST['email'])) {

        $error['email'] = "This is a required field.";

    } else {

        $email = $_POST['email'];
        
    }
    // ktra password
    if (empty($_POST['password'])) {

        $error['password'] = "This is a required field.";
    } else {

        if (!is_password($_POST['password'])) {

            $error['password'] = "Invalid password";

        } else {

            $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        }

    }
    // Kết luận
    if (empty($error)) {
//        $password = md5($password);
        $sql = "SELECT `email`,`password` FROM `users` where `email` ='{$email}' and `password` ='{$password}' and status = 1 ";

        $result = mysqli_query($conn, $sql);

        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {
            //Lưu trữ phiên đăng nhập vào SESSION
            $_SESSION['is_login'] = true; 

            $_SESSION['user_login'] = $email; 
            //Nếu SESSION khác rỗng thì sẽ đến trang cart ngược lại thì trang home.
            if(!empty($_SESSION['cart']['buy'])){

               header("Location: ?mod=cart&act=show");

           }

           else{

            header("Location: ?");

        }
    } else {

        $error['acount'] = "Username or password does not exist";

    }

}

}

?>  

<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="?" class="s-text16">
    Home
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
    Login
    </span>
</div>
<!-- content page -->
<section class="bgwhite p-t-10 p-b-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 border-r">
                <div class="p-r-20 p-r-0-lg">
                    <!-- <div class="contact-map size21" id="google_map" data-map-x="40.614439" data-map-y="-73.926781" data-pin="images/icons/icon-position-map.png" data-scrollwhell="0" data-draggable="1"></div> -->
                    <img src="https://images.wallpaperscraft.com/image/shoes_legs_jeans_autumn_118062_800x600.jpg" width="100%" alt="IMG-BLOG">
                </div>
            </div>
            <div class="col-md-6 p-b-30" style="border-left: 1px solid #f5f5f5;">
                <form class="leave-comment" action="" method="post">
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Login
                    </h4>
                    <?php
                        if (!empty($error['email'])) {
                        
                            ?>
                    <p class="error"><?php echo $error['email']; ?></p>
                    <?php
                        }
                        
                        ?>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" id="email" type="email" name="email" placeholder="Email">
                    </div>
                    <?php
                        if (!empty($error['password'])) {
                        
                            ?>
                    <p class="error"><?php echo $error['password']; ?></p>
                    <?php
                        }
                        
                        ?>  
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" id="password" type="password" name="password" placeholder="Password">
                    </div>
                    <!-- <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
                        </div>
                        
                        <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea> -->
                    <!-- <div class="w-size25"> -->
                    <div>
                        <div style="width: 25%">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4"style="float: left"  name="btn_login" id="btn_login">
                            Sign in
                            </button>
                        </div>
                        <div style="width: 75%">
                            <a href="?mod=users&act=forgot_password">Forgot password?</a>
                            <br>
                            or <a href="?mod=users&act=register" style="color: #e65540">Register</a>
                        </div>
                    </div>
                    <?php
                        if (!empty($error['acount'])) {
                        
                            ?>
                    <p class="error"><?php echo $error['acount']; ?></p>
                    <?php
                        }
                        
                        ?>
                </form>
                
                <!-- NÚT ĐĂNG NHẬP -->
                <br />
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();    
    
    ?>