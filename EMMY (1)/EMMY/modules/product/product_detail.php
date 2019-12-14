<?php 
    get_header();  
    
    ?>
<?php
    $id_sp = $_GET['id'];
    $Listproductdetail = get_Listproductdetail($id_sp);
     	  // show_array($Listproductdetail);
    ?>
<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="index.php" class="s-text16">
    Home
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="?mod=product&act=Categories&id=<?php echo $Listproductdetail['id_loai'] ?>" class="s-text16">
    <?php echo $Listproductdetail['loaisanpham']?>
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
    <?php echo $Listproductdetail['tensp']?>
    </span>
</div>
<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>
                <div class="slick3">
                    <?php
                        if(isset($_GET["id"])){
                        	$id = $_GET["id"];
                        	$sql = "SELECT * FROM sanpham, hinhanh WHERE sanpham.id = hinhanh.hinhspID and sanpham.id = $id and hinhanh.status = 1";
                        	$result = $conn->query($sql);
                        	if($result->num_rows > 0)
                        		while($rows = $result->fetch_assoc()){
                        			?>
                    <div class="item-slick3" data-thumb="imgs/<?=$rows["duongdan"]?>">
                        <div class="wrap-pic-w">
                            <img src="imgs/<?=$rows["duongdan"]?>" alt="IMG-PRODUCT">
                        </div>
                    </div>
                    <?php
                        }
                        
                        }
                        ?>
                </div>
            </div>
        </div>
        <div class="w-size14 p-t-30 respon5">
            <?php
                if(empty($Listproductdetail))
                {
                	echo "No see products!";
                }
                else
                {
                
                	?>
            <h4 class="product-detail-name m-text16 p-b-13">
                <?php echo $Listproductdetail['tensp'] ?>
            </h4>
            <span class="m-text17">
            $<?php echo $Listproductdetail['gia'] ?>
            </span>
            <p class="s-text8 p-t-10">
                <?php echo $Listproductdetail['motangan'] ?>
            </p>
            <!--  -->
            <div class="p-t-33 p-b-60">
             
                   
                <div class="flex-r-m flex-w p-t-10">
                    <div class="w-size16 flex-m flex-w">
                        <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                            <button min="1" max="10" onclick="updateItem1(<?php echo $Listproductdetail['id']?>)" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" type="submit" value="btn_update_cart">
                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                            </button>
                            <input class="size8 m-text18 t-center num-product" min="1" max="10" type="number" id="sl_<?php echo $Listproductdetail['id']; ?>" name="soluong" value="1">
                            <button min="1" max="10" class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" type="submit" value="btn_update_cart" onclick="updateItem(<?php echo $Listproductdetail['id'] ?>)">
                            <i class="fs-12 fa fa-plus" aria-hidden="true" ></i>
                            </button>
                            <script>
                                function updateItem(id)
                                {
                                	sl = $("#sl_"+id).val();
                                	sl ++;
                                	// alert(sl);
                                // gia = $("#gia_"+id).html();
                                // total = sl * gia.slice(1, 10);
                                // $('#total_'+id).html('$'+total);
                                // console.log(total)
                                }
                                function updateItem1(id)
                                {
                                sl = $("#sl_"+id).val();
                                sl --;
                                	// alert(sl);
                                
                                }
                                function updateItem2(id)
                                {
                                	sl = $("#sl_"+id).val();
                                    size = $("#size").val();
                                	$.get("?mod=cart&act=add_to_cart&maloai=<?php echo $Listproductdetail['maloai']; ?>&id=<?php echo $Listproductdetail['id']; ?>&size=39",{'sl':sl, 'size':size},{'size':size})
                                	// alert(sl);
                                
                                }
                                function updateItem3(id)
                                {
                                	
                                	alert('Available: 0 products so can not buy');
                                
                                }
                                
                            </script>
                        </div>

                        <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                            <!-- Button -->
                            <!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Add to Cart
                                </button> -->
                            <?php
                                if ($Listproductdetail['soluong']>0) {
                                ?>
                            <a href="?mod=cart&act=show" onclick="updateItem2(<?php echo $Listproductdetail['id'] ?>)" title="Add to cart" id="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>
                            <?php
                                }else
                                {
                                ?>
                            <a href="#" onclick="updateItem3(<?php echo $Listproductdetail['id'] ?>)" title="Add to cart" id="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if ($Listproductdetail['soluong']>0) {
                	$Listproductdetail['soluong']=$Listproductdetail['soluong'];
                }
                else
                {
                	$Listproductdetail['soluong'] = 0;
                		// echo '<p>Available: 0 products so can not buy</p>';
                }
                ?>
                 
            <div class="p-b-45">
                <span class="s-text8 m-r-35">Chọn Size: <input class=" size8 m-text18 t-center " type="number" min="26" max="50" type="number" id="size" name="size" value="32">  </span> 
                
            </div>
            <div class="p-b-45">
                <span class="s-text8 m-r-35">Available: <?php echo $Listproductdetail['soluong'];?> products</span> 
                <span class="s-text8">Categories: <?php echo $Listproductdetail['loaisanpham'] ?></span>
            </div>
            <!--  -->
            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Description
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        <?php echo $Listproductdetail['motadai'] ?>
                    </p>
                </div>
            </div>
           <!--  <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Additional information
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                    </p>
                </div>
            </div>
            <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Reviews (0)
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                    </p>
                </div>
            </div> -->
            <?php
                }
                ?>
        </div>
    </div>
</div>
<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-20">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Related Products
            </h3>
        </div>
        <?php
            $get_related = get_Related($Listproductdetail['maloai']);
            	  		// show_array($get_related);
            ?>
        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php
                    foreach ($get_related as $list) {
                    		# code...
                    	// echo $list['id'];
                    	?>
                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                         <?php
                             // show_array($product);
                              $date = getdate();
                              // echo $date["mday"];
                            $currentDate = $date["year"] . "-". $date["mon"] . "-". $date["mday"];

                             $week = strtotime(date("Y-m-d", strtotime($list['created_at'])) . " +1 week");
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
                            <img src="imgs/<?php echo $list['hinhanh'] ?>" alt="IMG-PRODUCT">
                            <div class="block2-overlay trans-0-4">
                                <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a> -->
                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <!-- Button -->
                                    <a href="" title="Thêm giỏ hàng" onclick="cart(<?php echo $list['id']; ?>)" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        <script>
                            function cart(id){
                                $sz = $("#size").val();
                            	$.get("?mod=cart&act=add_to_cart",{"id":id},{"size":sz}, function(data){
                            
                            	});
                            
                            }
                            
                        </script>
                        <div class="block2-txt p-t-20">
                            <a href="?mod=product&act=product_detail&id=<?php echo $list['id'] ?>" class="block2-name dis-block s-text3 p-b-5">
                            <?php echo $list['tensp'] ?>
                            </a>
                            <span class="block2-price m-text6 p-r-5">
                            $<?php echo $list['gia'] ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();  
    
    ?>