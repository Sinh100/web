<?php 
    get_header();    
    ?>
<?php
    if (isset($_POST['reg_user'])) {
        $error = array();
        $name = "";
        $email    = "";
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        // $errors = array();
        // Ki?m tra fullname
        if (empty($_POST['name'])) {
            $error['name'] = "Name is required";
        } else {
            $name = $_POST['name'];
        }
    
        // Ki?m tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Password is required";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "At least eight characters, at least one uppercase, a lowercase letter and a number";
            } // kh?p ð?nh d?ng
    
            if($password !== $password2)
            {
              $error['password2']= "Please make sure your passwords match.";
          }
          else
          {
            $password = md5($_POST['password']); // xu?t ra password
        }
    }
    
        // Ki?m tra email
    if (empty($_POST['email'])) {
        $error['email'] = "Email is required";
    } else {
        if (!is_email($_POST['email'])) {
            $error['email'] = "Please enter a valid email address. For example johndoe@domain.com.";
            } else { // kh?p ð?nh d?ng
                $email = $_POST['email'];
            }
        }
    
        $user_check_query = "SELECT * FROM users WHERE email='$email' and status = 1 LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
      if ($user) { // if user exists
       
      if ($user['email'] === $email) {
          $error['email']= "Email already exists";
      }
    }
    
        // Bý?c 3: K?t lu?n
    if (empty($error)) {
        $sql = "INSERT INTO `users` (`name`,`password`,`email`)"
        . "VALUES('{$name}', '{$password}', '{$email}')";
        if (mysqli_query($conn, $sql)) {
           header("Location: ?mod=users&act=login");       
       }
    } else {
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
    Register
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
                <form class="leave-comment" action="" method="POST">
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Register
                    </h4>
                    <?php
                        if (!empty($error['name'])) {
                            ?>
                    <p class="error"><?php echo $error['name']; ?></p>
                    <?php
                        }
                        
                        ?>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" id="name" type="text" name="name"  placeholder="Name">
                    </div>
                    <?php
                        if (!empty($error['email'])) {
                           ?>
                    <p class="error"><?php echo $error['email']; ?></p>
                    <?php
                        }
                        ?>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" id="email" type="email" name="email"  placeholder="Email">
                    </div>
                    <?php
                        if (!empty($error['password'])) {
                           ?>
                    <p class="error"><?php echo $error['password']; ?></p>
                    <?php
                        }
                        ?>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22"  type="password" name="password" placeholder="Password">
                    </div>
                    <?php
                        if (!empty($error['password2'])) {
                           ?>
                    <p class="error"><?php echo $error['password2']; ?></p>
                    <?php
                        }
                        ?>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password2" placeholder="Re-Enter Password">
                    </div>
                    <div class="w-size25">
                        <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" name="reg_user" style="font-size: 13px;">
                        Create account
                        </button>   
                    </div>
                </form>
                <div class="p-t-10 p-l-50">
                    <a href="?mod=users&act=login" class="active1 sale-noti "><i class=""></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();    
    ?>