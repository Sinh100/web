<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">

    <script src="alertifyjs/jquery-3.2.1.min.js"></script>
    <script src="alertifyjs/alertify.js"></script>
</head>
<body class="animsition">
    <!-- Header -->
    <header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="topbar">
                <div class="topbar-social">
                    <a href="https://www.facebook.com/profile.php?=75816879" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
                    <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                    <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                    <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                </div>
                <span class="topbar-child1">
                    Free shipping for every order
                </span>
                <div class="topbar-child2">
                   
                    
                </div>
            </div>
            <div class="wrap_header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <img src="imgs/logo/logo.png" style=" max-height: 65px;" alt="IMG-LOGO">
                </a>
                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="?mod=home&act=main">Home</a>
                            </li>
                            <li>
                                <a href="?mod=product&act=main">Shop</a>
                            </li>
                            <!--  <li class="sale-noti">
                                <a href="?mod=product&act=main">Sale</a>
                            </li> -->
                            <li class="sale-noti">
                                <a href="?mod=cart&act=show">Cart</a>
                            </li>
                            <li>
                                <a href="?mod=blog&act=main">Blog</a>
                            </li>
                            <li>
                                <a href="?mod=about&act=main">About</a>
                            </li>
                            <li>
                                <a href="?mod=contact&act=main">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Header Icon -->
                <div class="header-icons">
                    <?php
                    if(isset($_SESSION['is_login'])){

                        ?>
                        <div id="user-login">
                            <p>
                                Hello <strong><?php if(is_login()) echo info_user('name'); ?></strong>
                                <!-- <span style="display: flex;justify-content: center;align-items: center;width: 16px;height: 16px;border-radius: 50%;background-color: #111111;color: white;font-family: Montserrat-Medium;font-size: 11px;position: absolute;top: 0;right: 50px;cursor: pointer;" onclick="logout()" >X</span> -->
                            </p>
                        </div>
                        <a href="?mod=users&act=login" class="ask"><i class="fa fa-sign-out" aria-hidden="true" title="logout" style="font-size: 20px; padding-left: 8px;cursor: pointer;"></i></a>
                        <script type="text/javascript">
                           $(document).ready(function(){
                           $(".ask").click(function(event){
                            var loc = $(this).attr('href');
                                 alertify.confirm('You definitely want to log out?', function(e){ 
                                    if (e) {
                                    document.location.href = loc;
                                }  });return false;
                                });
                             
                        })
                    </script>
                     
                    <?php
                }else{
                 ?>
                 <a href="?mod=users&act=login" class="header-wrapicon1 dis-block">
                    <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a> 
                <?php
            }
            ?>
            <!-- <input id="btb" type="button" value="ĐĂNG NHẬP" onclick="RequestLoginFB()" style="display:none" /> -->
            <!-- <p id="lbl" style="display:none">BẠN ĐÃ ĐĂNG NHẬP THÀNH CÔNG!</p> -->
            <?php
            if(isset($_SESSION['cart']['buy']))
            {
               $sum_cart = count($_SESSION['cart']['buy']);

           }
           else
           {
             $sum_cart=0;
         }
                         // echo $sum_cart;
         ?> 
         <span class="linedivide1"></span>
         <div class="header-wrapicon2" >
            <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti"><?php echo $sum_cart?></span>
            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
                <ul class="header-cart-wrapitem">
                    <?php
                    if(isset($_SESSION['cart']['buy']))
                    {
                        $list_buy = get_list_by_cart();
                                        // show_array($list_buy);

                        foreach($list_buy as $item){
                            ?>
                            <li class="header-cart-item">
                                <div class="header-cart-item-img" >
                                    <img src="imgs/<?php echo $item['hinhanh']?>"  alt="IMG" >
                                    <a href="<?php echo $item['url_delete_cart']?>" class="header-icons-noti ask">x</a>
                                </div>
                                <script type="text/javascript">
                           $(document).ready(function(){
                           $(".ask").click(function(event){
                            var loc = $(this).attr('href');
                                 alertify.confirm('Are you sure to delete this product?', function(e){ 
                                    if (e) {
                                    document.location.href = loc;
                                }  });return false;
                                });
                             
                        })
                    </script>
                                <div class="header-cart-item-txt">
                                    <a href="?mod=product&act=product_detail&id=<?php echo $item['id']?>" class="header-cart-item-name">
                                        <?php echo $item['tensp']?>
                                    </a>
                                    <span class="header-cart-item-info">
                                        <?php echo $item['soluong']; ?> x $<?php echo $item['gia']?>
                                    </span>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    if(empty($list_buy))
                    {
                        echo "<h5 style='text-align: center;overflow:hidden;'>Your Cart is empty</h5>";
                    }
                    ?>
                </ul>
                <div class="header-cart-total">
                    Total: $ <?php echo get_total_cart(); ?>
                </div>
                <div class="header-cart-buttons">
                    <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="?mod=cart&act=show" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            View Cart
                        </a>
                    </div>
                    <?php
                    if(isset($_SESSION['is_login'])&&!empty($_SESSION['cart']['buy'])){
                       ?>
                       <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="?mod=cart&act=checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            Check Out
                        </a>
                        <?php
                    }else  if(isset($_SESSION['is_login'])&&empty($_SESSION['cart']['buy']))
                    {
                       ?>
                       <div class="header-cart-wrapbtn">
                        <!-- Button -->
                        <a href="?mod=cart&act=checkout" style="display: none" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                            Check Out
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Header Mobile -->
<div class="wrap_header_mobile">
    <!-- Logo moblie -->
    <a href="index.php" class="logo-mobile">
        <img src="imgs/logo/logo.png" style="    max-height: 64px;" alt="IMG-LOGO">
    </a>
    <!-- Button show menu -->
    <div class="btn-show-menu">
        <!-- Header Icon mobile -->
        <div class="header-icons-mobile" style="position: relative">
            <?php
            if(isset($_SESSION['is_login'])){

                ?>
                <div id="user-login">
                    <p>
                        Hello <strong><?php if(is_login()) echo info_user('name'); ?></strong>
                        <!-- <span style="display: flex;justify-content: center;align-items: center;width: 16px;height: 16px;border-radius: 50%;background-color: #111111;color: white;font-family: Montserrat-Medium;font-size: 11px;position: absolute;top: 0;right: 50px;cursor: pointer;" onclick="logout()" >X</span> -->
                    </p>
                </div>
                <a href="?mod=users&act=logout"><i class="fa fa-sign-out" aria-hidden="true" title="logout" onclick="return logout()" style="font-size: 20px; padding-left: 8px;cursor: pointer;"></i></a>
                <script>
                    function logout()
                    {
                        return confirm("Are you sure?");
                    }
                </script>
                <?php
            }else{
             ?>
             <a href="?mod=users&act=login" class="header-wrapicon1 dis-block">
                <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
            </a> 
            <?php
        }
        ?>
        <span class="linedivide2"></span>
        <div class="header-wrapicon2">
            <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
            <span class="header-icons-noti"><?php echo $sum_cart?></span>
            <!-- Header cart noti -->
            <div class="header-cart header-dropdown">
                <ul class="header-cart-wrapitem">
                    <?php
                    if(isset($_SESSION['cart']['buy']))
                    {
                        $list_buy = get_list_by_cart();
                                                                            // show_array($list_buy);

                        foreach($list_buy as $item){
                            ?>
                            <li class="header-cart-item">
                                <div class="header-cart-item-img" >
                                    <img src="imgs/<?php echo $item['hinhanh']?>"  alt="IMG" >
                                    <a href="<?php echo $item['url_delete_cart']?>" class="header-icons-noti">x</a>
                                </div>
                                <div class="header-cart-item-txt">
                                    <a href="?mod=product&act=product_detail&id=<?php echo $item['id']?>" class="header-cart-item-name">
                                        <?php echo $item['tensp']?>
                                    </a>
                                    <span class="header-cart-item-info">
                                        <?php echo $item['soluong']; ?> x $<?php echo $item['gia']?>
                                    </span>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    if(empty($list_buy))
                    {
                      echo "<h5 style='text-align: center;overflow:hidden;'>Your Cart is empty</h5>";
                  }
                  ?>
              </ul>
              <div class="header-cart-total">
                Total: $ <?php echo get_total_cart(); ?>
            </div>
            <div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="?mod=cart&act=show" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        View Cart
                    </a>
                </div>
                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="?mod=cart&act=checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
    <span class="hamburger-box">
        <span class="hamburger-inner"></span>
    </span>
</div>
</div>
</div>
<!-- Menu Mobile -->
<div class="wrap-side-menu" >
    <nav class="side-menu">
        <ul class="main-menu">
            <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                <span class="topbar-child1">
                    Free shipping for every order
                </span>
            </li>
            <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                <div class="topbar-child2-mobile">
                    <span class="topbar-email">
                      <a href="mailto:nguyenloi211098@gmail.com">nguyenloi211098@gmail.com</a>
                  </span>
                                <<!-- div class="topbar-language rs1-select2">
                                    <select class="selection-1" name="time">
                                        <option>USD</option>
                                        <option>EUR</option>
                                    </select>
                                </div> -->
                            </div>
                        </li>
                        <li class="item-topbar-mobile p-l-10">
                            <div class="topbar-social-mobile">
                                <a href="https://www.facebook.com/profile.php?=75816879" class="topbar-social-item fa fa-facebook"></a>
                                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                            </div>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="?mod=home&act=main">Home</a>
                            <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="?mod=product&act=main">Shop</a>
                        </li>
                        <!-- <li class="item-menu-mobile">
                            <a href="?mod=product&act=main">Sale</a>
                        </li> -->
                        <li class="item-menu-mobile" class="sale-noti">
                            <a href="?mod=cart&act=show">Cart</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="?mod=blog&act=main">Blog</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="?mod=about&act=main">About</a>
                        </li>
                        <li class="item-menu-mobile">
                            <a href="?mod=contact&act=main">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>