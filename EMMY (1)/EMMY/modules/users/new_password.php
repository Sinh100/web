<?php 
get_header();    
?>
<!-- <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

   show_array($_POST);
}
?> -->
<?php

$reset_token = $_GET['reset_token'];

if(check_reset_token($reset_token)){

	if (isset($_POST['btn_login'])) {

		$error = array();
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
			 $data = array(

                'password' => $password
            );

            update_pass($data,$reset_token);

            header("Location: ?mod=users&act=login");

		} else {

			$error['acount'] = "Invalid login or password";
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
    <!-- <a href="blog.php" class="s-text16">
        Blog
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a> -->
    <span class="s-text17">
    New Password
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
                        New Password
                    </h4>
                    <?php
                        if (!empty($error['password'])) {
                            ?>
                    <p style="color: #ef4a33;"><?php echo $error['password']; ?></p>
                    <?php
                        }
                        ?>  
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" id="password" type="password" name="password" placeholder="Password">
                    </div>
                    <div>
                        <div style="width: 25%">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4"style="float: left"  name="btn_login" id="btn_login">
                            Submit
                            </button>
                        </div>
                    </div>
                    <?php
                        if (!empty($error['acount'])) {
                            ?>
                    <p style="color: #222222;"><?php echo $error['acount']; ?></p>
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