    <?php
    function get_header($version='') { // cho 1 biến $version rỗng
        if (!empty($version)) { // $version khác rỗng =>
            $path_header = "inc/header-{$version}.php";
        } else {
            $path_header = "inc/header.php";
        }
        if (file_exists($path_header)) {
            require $path_header;
        } else {
            echo "Không tồn tại đường dẫn {$path_header}";
        }
    }

    function get_footer() {
        $path_footer = "inc/footer.php";
        if (file_exists($path_footer)) {
            require $path_footer;
        } else {
            echo "Không tồn tại đường dẫn {$path_footer}";
        }
    }

    function get_sidebar() {
        $path_sidebar = "inc/sidebar.php";
        if (file_exists($path_sidebar)) {
            require $path_sidebar;
        } else {
            echo "Không tồn tại đường dẫn {$path_sidebar}";
        }
    }
      function get_sidebar_blog() {
        $path_sidebar = "inc/sidebar_blog.php";
        if (file_exists($path_sidebar)) {
            require $path_sidebar;
        } else {
            echo "Không tồn tại đường dẫn {$path_sidebar}";
        }
    }

    ?>