<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="/EMMY/admin/public/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/EMMY/admin/public/admin/css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/EMMY/admin/public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    

    <script src="admin/modules/baiviet/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <!--  <a class="navbar-brand" href="index.php">Xin chào <?php echo $_SESSION['admin_name'] ?></a> -->
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin_name'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <sqan onclick="logout()" style="cursor: pointer;    padding-left: 21px;"><i class="fa fa-fw fa-power-off"></i> Log Out</sqan>
                        </li>
                          <script>
                                                function logout()
                                                {
                                                    if(confirm("Are you sure?")==true)
                                                    {
                                                        window.location="/EMMY/admin/thoat.php";
                                                    }
                                                    else
                                                    {

                                                    }
                                                }
                                            </script>
                    </ul> -->
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="<?php echo base_url() ?>admin"><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'loaisanpham' ? 'active' : '' ?>">
                        <a href="<?php echo modules("loaisanpham")?>"><i class="fa fa-list"></i>  Danh mục sản phẩm</a>
                    </li>


                    <li class="<?php echo isset($open) && $open == 'sanpham' ? 'active' : '' ?>">
                        <a href="<?php echo modules("sanpham")?>"> <i class="fa fa-database"> </i>  Sản phẩm</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'hinhanhsanpham' ? 'active' : '' ?>">
                        <a href="<?php echo modules("hinhanhsanpham")?>"> <i class="fa fa-picture-o"> </i> Hình ảnh  Sản phẩm</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'danhmucbaiviet' ? 'active' : '' ?>">
                        <a href="<?php echo modules("danhmucbaiviet")?>"> <i class="fa fa-book"> </i> Danh mục  Bài viết</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'baiviet' ? 'active' : '' ?>">
                        <a href="<?php echo modules("baiviet")?>"> <i class="fa fa-bookmark"> </i>    Bài viết</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'thanhvien' ? 'active' : '' ?>">
                        <a href="<?php echo modules("thanhvien")?>"> <i class="fa fa-user"> </i>  Admin</a>
                    </li>

                    <li class="<?php echo isset($open) && $open == 'user' ? 'active' : '' ?>">
                        <a href="<?php echo modules("user")?>"> <i class="fa fa-users"> </i>  Người dùng</a>
                    </li>


                    <li class="<?php echo isset($open) && $open == 'donhang' ? 'active' : '' ?>">
                        <a href="<?php echo modules("donhang")?>"> <i class="fa fa-shopping-cart"> </i>  Quản lý Hóa Đơn</a>
                    </li>


                    <li class="<?php echo isset($open) && $open == 'danhsachhoadon' ? 'active' : '' ?>">
                        <a href="<?php echo modules("danhsachhoadon")?>"> <i class="fa fa-calendar-o"> </i>  Danh sách đơn hàng</a>
                    </li>

                     <li class="<?php echo isset($open) && $open == 'banner' ? 'active' : '' ?>">
                        <a href="<?php echo modules("banner")?>"> <i class="fa fa-list-alt"> </i>  Danh sách slider</a>
                    </li>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">