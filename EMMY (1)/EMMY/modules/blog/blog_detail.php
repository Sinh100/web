<?php 
    get_header(); 
    
       //lấy blog chi tiết
    $id_blog = $_GET['id'];
    $Listblogdetail = get_Listblogdetail($id_blog);
    // show_array($Listblogdetail);
    ?>
<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="index.php" class="s-text16">
    Home
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="?mod=blog&act=main" class="s-text16">
    Blog
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="?mod=blog&act=categories_blog&id=<?php echo $Listblogdetail['iddm'] ?>" class="s-text16">
    <?php echo $Listblogdetail['tendm']?>
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a> 
    <span class="s-text17">
    <?php echo $Listblogdetail['tieude']?>
    </span>
</div>
<!-- content page -->
<section class="bgwhite p-t-60 p-b-25">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-50 p-r-0-lg">
                    <div class="p-b-40">
                        <div class="blog-detail-img wrap-pic-w">
                            <img src="imgs/<?php echo $Listblogdetail['hinhanh']?>" alt="IMG-BLOG">
                        </div>
                        <div class="blog-detail-txt p-t-33">
                            <h4 class="p-b-11 m-text24">
                                <?php echo $Listblogdetail['tieude']?>
                            </h4>
                            <div class="s-text8 flex-w flex-m p-b-21">
                                <span>
                                By <?php echo $Listblogdetail['nguoiviet']?>
                                <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                <?php echo $Listblogdetail['created']?>
                                <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                <?php echo $Listblogdetail['tendm']?>
                                <!-- <span class="m-l-3 m-r-6">|</span> -->
                                </span>
                                <!-- <span>
                                8 Comments
                                </span> -->
                            </div>
                            <p class="p-b-25">
                                <?php echo $Listblogdetail['noidung']?>
                            </p>
                        </div>
                        <div class="flex-m flex-w p-t-20">
                            <span class="s-text20 p-r-20">
                            <?php echo $Listblogdetail['tendm']?>
                            </span>

                            <div class="wrap-tags flex-w">
                            	<?php  $sql                    = "SELECT *,COUNT(iddm)as tongbaiviet FROM `dmbaiviet` LEFT JOIN `baiviet` on `dmbaiviet`.`id_dm` = `baiviet`.`iddm` WHERE `dmbaiviet`.`trangthai`= 1 GROUP BY id_dm";

                            	$result                = mysqli_query($conn, $sql);
						                // echo $result;
                            	$num_rows              = mysqli_num_rows($result);
                            	if ($num_rows > 0) {

                            		while ($row        = mysqli_fetch_assoc($result)) { ?>
                            			<a href="?mod=blog&act=categories_blog&id=<?= $row['id_dm'] ?>" class="tag-item">
                            				<?= $row['tendm'] ?>
                            			</a>

                            		<?php }} ?>

                            </div>
                        </div>
                    </div>
                    <!-- Leave a comment -->
                  <!--   <form class="leave-comment">
                      <h4 class="m-text25 p-b-14">
                          Leave a Comment
                      </h4>
                      <p class="s-text8 p-b-40">
                          Your email address will not be published. Required fields are marked *
                      </p>
                      <textarea class="dis-block s-text7 size18 bo12 p-l-18 p-r-18 p-t-13 m-b-20" name="comment" placeholder="Comment..."></textarea>
                      <div class="fb-comments" data-href="http://localhost/fashe-colorlib-vs3" data-width="" data-numposts="5"></div>
                      <div class="bo12 of-hidden size19 m-b-20">
                          <input class="sizefull s-text7 p-l-18 p-r-18" type="text" name="name" placeholder="Name *">
                          </div>
                          
                          <div class="bo12 of-hidden size19 m-b-20">
                          <input class="sizefull s-text7 p-l-18 p-r-18" type="text" name="email" placeholder="Email *">
                          </div>
                          
                          <div class="bo12 of-hidden size19 m-b-30">
                          <input class="sizefull s-text7 p-l-18 p-r-18" type="text" name="website" placeholder="Website">
                          </div>
                          
                          <div class="w-size24">
                      Button
                      <button class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                          Post Comment
                          </button>
                          </div>
                  </form> -->
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