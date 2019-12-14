<?php 
get_header();  


?>
	<!-- <script  type="text/javascript">

										$(document).ready(function() {
											$(".city").change(function() {
												var id = $(".city").val();
												$.post('?mod=product&act=data', {id: id}, function(data) {
													$(".data").html(data)
													alert(data);
													// location.replace('?mod=product&act=data');
												});
											});
										});
									</script>  -->
									<?php
									$Listproduct=get_Listproduct();


									?>
									<?php
// phân trang
									$number_rows = db_num_rows("SELECT * FROM sanpham");

									$num_per_page = 9;
									$total_row = $number_rows;
									$num_page = ceil($total_row / $num_per_page);
									$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
									$start = ($page - 1) * $num_per_page;

									$Listproduct = get_product($start, $num_per_page);
//show_array(get_product($start, $num_per_page));
									$default_sorting=get_default();
// show_array($default_sorting);
									?>

									<!-- Title Page -->
									<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
										<h2 class="l-text2 t-center">
											Women
										</h2>
										<p class="m-text13 t-center">
											New Arrivals Women Collection 2018
										</p>
									</section>


									<!-- Content page -->
									<section class="bgwhite p-t-55 p-b-65">
										<div class="container">
											<div class="row">
												
												<?php
												get_sidebar();
												?>

												<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
													<!--  -->
													<div class="flex-sb-m flex-w p-b-35">
														<div class="flex-w">
															<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
																<select class="selection-2 city" name="sorting" id="select">
								<!-- <script  type="text/javascript">

									$(document).ready(function() {
										$(".city").change(function() {
											var id = $(".city").val();
											$.post('?mod=product&act=main', {id: id}, function(data) {
												$(".aaa").html(data);
												 alert(id);
											});
										});
									});
								</script> -->
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
						</div>
					</div>

					<span class="s-text8 p-t-5 p-b-5">
						Showing <?php echo count($Listproduct)?> results
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
									$labelnew="";
									if($product['id']%2!==0){
										$labelnew="block2-labelnew";
									}

									?>
									<div class="block2-img wrap-pic-w of-hidden pos-relative <?php echo $labelnew?> ">
										<img src="imgs/<?php echo $product['hinhanh'] ?>" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													Add to Cart
												</button>
											</div>
										</div>
									</div>

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
