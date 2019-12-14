<?php 
    get_header();  
    
    ?>
<?php
    if(isset($_GET['id'])){
    	
    	$id = (int)$_GET['id'];
    	$sql = "select *,sanpham.created_at from sanpham,loaisanpham where maloai = {$id} and sanpham.trangthai =1 and loaisanpham.trangthai =1 and sanpham.maloai=loaisanpham.id_loai";
    	$result = mysqli_query($conn, $sql);
    	$list_product = array();
    	$num_rows = mysqli_num_rows($result);
    	if ($num_rows > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
    			$list_product[] = $row;
    
    		}
    	}
    	 // show_array($list_product);
    }
    
    $default_sorting=get_default();
    $number_rows = count($list_product);
    // echo $number_rows;
    $num_per_page = 6;
    $total_row = $number_rows;
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    
    $list_product1 = get_categoris($start, $num_per_page,$id);
     // show_array($list_product1)
    ?>
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(imgs/SS14ALLSTARLIFESTYLE07KIDSGroup31833.jpg);">
    <h2 class="l-text2 t-center">
        Fashion
    </h2>
    <p class="m-text13 t-center">
        New Arrivals Collection 2019
    </p>
</section>
<!-- Content page -->
<section class="bgwhite p-t-55">
    <div class="container">
        <div class="row">
            <?php
                get_sidebar();
                ?>
            <?php
                foreach ($list_product as $list) {
                
                	$id_loai= $list['maloai'];
                }
                										// echo $id_loai;
                ?>
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 city" name="sorting" id="select">
                                <script  type="text/javascript">
                                    $(document).ready(function() {
                                    	$(".city").change(function() {
                                    		var id = $(".city").val();
                                    		if (id==1) {
                                    			location.replace('?mod=sort&act=popularity&id=<?php echo $id_loai;?>');
                                    		}else if(id==2)
                                    		{	
                                    			location.replace('?mod=sort&act=low_high&id=<?php echo $id_loai;?>');
                                    		}
                                    		else
                                    		{
                                    			location.replace('?mod=sort&act=high_low&id=<?php echo $id_loai;?>');
                                    		}
                                    	});
                                    });
                                </script> 
                                <option>Default Sorting</option>
                                <?php 
                                    foreach ($default_sorting as $list) {
                                    
                                    	
                                    	?>
                                <option value="<?php echo $list['id']?>"><?php echo $list['ten']?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 city1" name="sorting">
                                <option>Price</option>
                                <option value="1">$0.00 - $200.00</option>
                                <option value="2">$200.00 - $600.00</option>
                                <option value="3">$600.00 - $120.00</option>
                                <option value="4">$1200.00 - $2000.00</option>
                                <option value="5">$2000.00+</option>
                            </select>
                            <script  type="text/javascript">
                                    $(document).ready(function() {
                                        $(".city1").change(function() {
                                            var id = $(".city1").val();
                                            if (id==1) {
                                                location.replace('?mod=sort&act=price_0_to_200&id=<?php echo $id_loai;?>');
                                                
                                            }else if(id==2)
                                            {   
                                                location.replace('?mod=sort&act=price_200_to_600&id=<?php echo $id_loai;?>');
                                            }
                                            else if(id==3)
                                            {
                                                location.replace('?mod=sort&act=price_600_to_1200&id=<?php echo $id_loai;?>');
                                            }else if(id==4)
                                            {
                                               location.replace('?mod=sort&act=price_1200_to_2000&id=<?php echo $id_loai;?>');
                                            }else if(id==5)
                                            {
                                                location.replace('?mod=sort&act=price_2000_plus&id=<?php echo $id_loai;?>');
                                            }

                                        });
                                    });
                                </script> 
                        </div>
                    </div>
                    <span class="s-text8 p-t-5 p-b-5">
                    Showing <?php echo $number_rows ?> results
                    </span>
                </div>
                <!-- Product -->
                <div class="row">
                    <?php
                        if(isset($list_product1)){
                        	?>
                    <?php
                        foreach($list_product1 as $product){
                        	$product['url']= "?mod=product&act=product_detail&id={$product['id']}";
                        	?>
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                             <?php
                             // show_array($product);
                              $date = getdate();
                              // echo $date["mday"];
                            $currentDate = $date["year"] . "-". $date["mon"] . "-". $date["mday"];

                             $week = strtotime(date("Y-m-d", strtotime($product['created_at'])) . " +1 week");
                              // $week = strftime("%Y-%m-%d", $week);
                              // echo "A week later is ". $week;
                              // echo $product['created_at'].'<br>';
                              // echo strtotime($product['created_at']).'<br>';
                              // echo strtotime($currentDate).'<br>';
                              // echo $week.'<br>';
                              // echo $week-(strtotime($currentDate)).'<br>';
                               $datediff = $week-(strtotime($currentDate));
                                // echo floor($datediff / (60*60*24));
                                $labelnew="";
                                if(floor($datediff / (60*60*24)) > 0 && floor($datediff / (60*60*24)) <= 7 ){
                                    $labelnew="block2-labelnew";
                                    
                                }
                                
                                ?>
                            <div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo $labelnew; ?>">
                                <img src="imgs/<?php echo $product['hinhanh'] ?>" alt="IMG-PRODUCT">
                                <div class="block2-overlay trans-0-4">
                                    <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a> -->
                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        <!-- <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Add to Cart
                                            </button> -->
                                        <a href="" title="Add to Cart" onclick="cart(<?php echo $product['id']; ?>)" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function cart(id){
                                	$.get("?mod=cart&act=add_to_cart",{"id":id}, function(data){
                                
                                	});
                                
                                }
                                
                            </script>
                            <div class="block2-txt p-t-20">
                                <a href="<?php echo $product['url']?>" class="block2-name dis-block s-text3 p-b-5">
                                <?php echo $product['tensp'] ?>
                                </a>
                                <span class="block2-price m-text6 p-r-5">
                                $<?php echo $product['gia'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        ?>
                    <?php
                        }
                        if(empty($list_product1))
                        {
                        ?>
                    <h1>Product no found</h1>
                    <?php
                        }
                        ?>
                </div>
                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26" style="margin: auto; margin-left: 50%;">
                    <?php
                        if(!empty($list_product1)){
                        $id_loai= $product['maloai'];
                        echo get_pagging($num_page, $page, "?mod=product&act=Categories",$id_loai);
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();    
    ?>