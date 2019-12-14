<?php 
    get_header();   
    
    $get_blog=get_Blog();
    // show_array($get_blog);  
    ?>
<?php
    // phân trang
    $number_rows = db_num_rows("SELECT * FROM baiviet where trangthai=1");
    
    $num_per_page = 2;
    $total_row = $number_rows;
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    // echo $start;
     $get_blog = get_Blog_pagging($start, $num_per_page);
    //show_array(get_product($start, $num_per_page));
    ?>
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(imgs/2920banner1.jpg);">
    <h2 class="l-text2 t-center">
        Blog
    </h2>
</section>
<!-- content page -->
<section class="bgwhite p-t-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-75">
                <?php
                    if(!isset($get_blog))
                    {
                    	echo "<p>There are no posts!</p> ";
                    }
                    foreach ($get_blog as $list_blog ) {
                    // show_array($list_blog);						
                    ?> 
                <div class="p-r-50 p-r-0-lg">
                    <!-- item blog -->
                    <div class="item-blog p-b-80">
                        <a href="?mod=blog&act=blog_detail&id=<?php echo $list_blog['id']; ?>" class="item-blog-img pos-relative dis-block hov-img-zoom">
                        <img src="imgs/<?php echo $list_blog['hinhanh']; ?>" alt="IMG-BLOG">
                        <span class="item-blog-date dis-block flex-c-m pos1 size17 bg4 s-text1">
                        <?php echo $list_blog['created']; ?>
                        </span>
                        </a>
                        <div class="item-blog-txt p-t-33">
                            <h4 class="p-b-11">
                                <a href="?mod=blog&act=blog_detail&id=<?php echo $list_blog['id']; ?>" class="m-text24">
                                <?php echo $list_blog['tieude']; ?>
                                </a>
                            </h4>
                            <div class="s-text8 flex-w flex-m p-b-21">
                                <span>
                                By <?php echo $list_blog['nguoiviet']; ?>
                                <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                Cooking, Food
                                <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                8 Comments
                                </span>
                            </div>
                            <p class="p-b-12">
                                <?php echo $list_blog['keyword']; ?>
                            </p>
                            <a href="?mod=blog&act=blog_detail&id=<?php echo $list_blog['id']; ?>" class="s-text20">
                            Continue Reading
                            <i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    }	
                    ?>
                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26" style="margin: auto;     margin-left: 30%;">
                    <?php
                        echo get_pagging_main($num_page, $page, "?mod=blog&act=main");
                        ?>
                </div>
            </div>
            <?php
                get_sidebar_blog();
                ?>
        </div>
    </div>
</section>
<?php 
    get_footer();          
    ?>