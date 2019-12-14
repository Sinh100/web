<?php 
    get_header();  
    
    
    $Listproduct=get_Listproduct();
    
    
    // phân trang
    $number_rows = db_num_rows("SELECT *,sanpham.created_at FROM sanpham,loaisanpham WHERE sanpham.trangthai =1 and loaisanpham.trangthai =1 and sanpham.maloai=loaisanpham.id_loai");
    
    $num_per_page = 6;
    $total_row = $number_rows;
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    
    $Listproduct = get_product($start, $num_per_page);
    // show_array(get_product($start, $num_per_page));
    $default_sorting=get_default();
    // show_array($default_sorting);
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
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <!--<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 city" name="sorting" id="select">
                            	 <script  type="text/javascript">
                            
                            		$(document).ready(function() {
                            			$(".city").change(function() {
                            				var id = $(".city").val();
                            				if (id==1) {
                            					location.replace('?mod=sort&act=popularity');
                            				}else if(id==2)
                            				{
                            					location.replace('?mod=sort&act=low_high');
                            				}
                            				else
                            				{
                            					location.replace('?mod=sort&act=high_low');
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
                            <p class="tinh"></p>
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                            	<option>Price</option>
                            	<option>$0.00 - $50.00</option>
                            	<option>$50.00 - $100.00</option>
                            	<option>$100.00 - $150.00</option>
                            	<option>$150.00 - $200.00</option>
                            	<option>$200.00+</option>
                            
                            </select>
                            </div>-->
                    </div>
                    <span class="s-text8 p-t-5 p-b-5">
                    Showing <?php echo $number_rows ?> results
                    </span>
                </div>
                <!-- Product -->
                <div class="row data">
                    <?php
                        if(empty($Listproduct))
                        {
                        	echo "No see products!";
                        }
                        else
                        {	
                        	foreach ($Listproduct as $product ) {
                        
                        		$product['url']= "?mod=product&act=product_detail&id={$product['id']}";
                        		?>
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <?php
                             
                              $date = getdate();
                            // show_array($date);
                            $currentDate = $date["year"] . "-". $date["mon"] . "-". $date["mday"];

                             $week = strtotime(date("Y-m-d", strtotime($product['created_at'])) . " +1 week");
                              
                               $datediff = $week-(strtotime($currentDate));
                               
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
                                            </button -->
                                        <?php
                                            if ($product['soluong']>0) {
                                            ?>
                                        <a href="" title="Add to Cart" onclick="cart(<?php echo $product['id']; ?>)" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                        <?php
                                            }else
                                            {
                                            ?>
                                        <a href="#" onclick="updateItem3()" title="Add to cart" id="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function cart(id){
                                	$.get("?mod=cart&act=add_to_cart",{"id":id}, function(data){
                                
                                	});
                                
                                }
                                function updateItem3(){
                                	alert('Available: 0 products so can not buy');
                                
                                }
                                rea
                                
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
                        }
                        
                        ?>
                    <!-- Pagination -->	
                </div>
                <div class="pagination flex-m flex-w p-t-26" style="margin: auto;     margin-left: 50%;">
                    <?php
                        echo get_pagging_main($num_page, $page, "?mod=product&act=main");
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();    
    ?>