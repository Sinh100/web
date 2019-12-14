<?php 
    get_header();   
    ?>
<?php
    $list_buy = get_list_by_cart();
     // show_array($list_buy);
    
    
    // if(isset($_GET['id']) && isset($_GET['sl']))
    // {
    //  echo $_GET['id']."<>".$_GET['sl'];
    //  die("Staop");
    // }
    ?>
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(imgs/men-sneaker.jpg);">
    <h2 class="l-text2 t-center">
        Cart
    </h2>
</section>
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-b-30">
                <!-- Cart item -->
                <div class="container-table-cart pos-relative">
                    <form method="post" action="?mod=cart&act=update">
                        <div class="wrap-table-shopping-cart bgwhite">
                            <?php
                                if(!empty($list_buy)){
                                    ?>
                            <table class="table-shopping-cart">
                                <tr class="table-head">
                                    <th class="column-1"></th>
                                    <th class="column-2">Product</th>
                                    <th class="column-3">Price</th>
                                        <th class="column-5">Size</th>
                                    <th class="column-4 p-l-70">Quantity</th>
                                
                                    <th class="column-6">Total</th>
                                </tr>
                                <?php
                                    foreach($list_buy as $item){
                                        ?>
                                <tr class="table-row">
                                    <td class="column-1">
                                        <div class="cart-img-product1 b-rad-4 o-f-hidden">
                                            <a href="?mod=product&act=product_detail&id=<?php echo $item['id']?>"></a><img src="imgs/<?php echo $item['hinhanh']?>" alt="IMG-PRODUCT">
                                            <!--  <span style="display: flex;justify-content: center;align-items: center;width: 16px;height: 16px;border-radius: 50%;background-color: #111111;color: white;font-family: Montserrat-Medium;font-size: 11px;position: absolute;top: 0;right: 0px;cursor: pointer;" onclick="logout()" >X</span> -->
                                            <a href="<?php echo $item['url_delete_cart']?>" class="ask"><i class="fa fa-trash-o" aria-hidden="true" style="display: flex;justify-content: center;align-items: center;width: 16px;height: 16px;font-size: 14px;position: absolute;top: 0;right: 0px;cursor: pointer;"></i></a>
                                        </div>
                                        
                                    </td>
                                    <td class="column-2" ><?php echo $item['tensp']?></td>
                                    <td class="column-3 " id="gia_<?php echo $item['id']; ?>" value="<?php echo $item['gia']?>">$<?php echo $item['gia']?></td>
                                    <td class="column-5" id="gia_<?php echo $item['id']; ?>" value="<?php echo $item['size']?>"><?php echo $item['size']?></td>
                                    <td class="column-4">
                                        <!--  <div class="input-group btn-block">
                                            <span class="input-group-btn">
                                                 <input type="text" name="soluong[]" value="<?=$sp["soluong"]?>" size="1" class="form-control">
                                                <button type="submit" data-toggle="tooltip" data-direction="top" class="btn btn-primary" value="Update"><i class="fa fa-refresh"></i></button>
                                                <button type="button" data-toggle="tooltip" data-direction="top" class="btn btn-danger pull-right" data-original-title="Remove"><a href="cart.php?thaotac=xoa&id=<?=$sp["id"]?>">Remove</a><i class="fa fa-times-circle"></i></button>
                                            </span>
                                            </div> -->
                                        <div class="flex-w bo5 of-hidden w-size17">
                                            <button min="1" max="10" onclick="updateItem1(<?php echo $item['id']?>)" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" type="submit" value="btn_update_cart">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true" ></i>
                                            </button>
                                            <input type="number" min="1" max="10" name="soluong[<?php echo $item['id']; ?>]" id="sl_<?php echo $item['id']; ?>" value="<?php echo $item['soluong']; ?>" class="size8 m-text18 t-center num-product">
                                            <button min="1" max="10" class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" type="submit" value="btn_update_cart" onclick="updateItem(<?php echo $item['id']?>)">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <script>
                                            function updateItem(id)
                                            {
                                                sl = $("#sl_"+id).val();
                                            sl ++;
                                            // alert(sl);
                                            gia = $("#gia_"+id).html();
                                            total = sl * gia.slice(1, 10);
                                            $('#total_'+id).html('$'+total);
                                            console.log(total)
                                            }
                                            
                                            function updateItem1(id)
                                            {
                                                sl = $("#sl_"+id).val();
                                            sl --;
                                            gia = $("#gia_"+id).html();
                                            total = sl * gia.slice(1, 10);
                                            $('#total_'+id).html('$'+total);
                                            }
                                        </script>
                                    </td>
                                
                                    <td class="column-6" id="total_<?php echo $item['id']; ?>">$<?php echo $item['sub_total']?> </td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </table>
                            <?php
                                }
                                ?>
                            <?php
                                if(!empty($list_buy)){
                                    ?>
                        </div>
                        <!-- <p id="total-price" class="fl-right">Tổng giá: <span><?php echo get_total_cart(); ?></span></p> -->
                        <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" name="btn_update_cart" value="Update" style="width: 126px;
                            height: 44px;
                            margin-top: 20px;
                            float: right;">Update
                        </button>
                        <p  style="    width: 325px;height: 44px; margin-top: 29px;float: right;">Click here to update the shopping cart<i class="fa fa-hand-o-right" style="    padding-left: 10px;font-size: 20px;font-weight: bold;" aria-hidden="true"></i></p>
                        <a href="?mod=cart&act=delete_all&id=''" class="ask_all" style="float: left"><i class="fa fa-trash-o" aria-hidden="true" style="    FONT-SIZE: 30PX;MARGIN-LEFT: 71px;margin-top: 25px;"></i></a>
                         <script type="text/javascript">
                           $(document).ready(function(){
                           $(".ask_all").click(function(event){
                            var loc = $(this).attr('href');
                                 alertify.confirm('Are you sure to delete all this products?', function(e){ 
                                    if (e) {
                                    document.location.href = loc;
                                }  });return false;
                                });
                             
                        })
                    </script>
                        <p  style=" width: 325px;height: 44px;margin-top: 29px;float: left;"><i class="fa fa-hand-o-left" style="padding-right: 10px;padding-left: 5px;font-size: 20px;font-weight: bold;" aria-hidden="true"></i>Click here to delete cart</p>
                        <div style="clear: both"></div>
                    </form>
                </div>
                <?php
                    }
                    ?>
                <?php
                    if(empty($list_buy))
                    {
                        echo "<h1 style='text-align: center;'>Your Cart is empty</h1><b>You have no items in your shopping cart.
                    
                    <a href='?mod=product&act=main' >Click here</a> to continue shopping.</b>";
                    
                    }
                    ?>
                <!-- <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                    <div class="size10 trans-0-4 m-t-10 m-b-10">-->
                <!-- Button -->
                <!--    </div>
                    </div> 
                    -->
                <!-- Total -->
                <?php
                    if(!empty($list_buy))
                    {
                        ?>
                <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                    <h5 class="m-text20 p-b-24">
                        Cart Totals
                    </h5>
                    <!--  -->
                    <div class="flex-w flex-sb-m p-b-12">
                        <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                        </span>
                        <span class="m-text21 w-size20 w-full-sm">
                        $ <?php echo get_total_cart(); ?>
                        </span>
                    </div>
                    <!--  -->
                    <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                        <span class="s-text18 w-size19 w-full-sm">
                        Shipping:
                        </span>
                        <div class="w-size20 w-full-sm">
                            <p class="s-text8 p-b-23">
                                There are no shipping methods available. Please double check your address, or contact us if you need any help.
                            </p>
                            <!-- span class="s-text19">
                                Calculate Shipping
                                </span>
                                
                                <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
                                <select class="selection-2" name="country">
                                    <option>Select a country...</option>
                                    <option>US</option>
                                    <option>UK</option>
                                    <option>Japan</option>
                                </select>
                                </div>
                                
                                <div class="size13 bo4 m-b-12">
                                <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
                                </div>
                                
                                <div class="size13 bo4 m-b-22">
                                <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                </div>
                                
                                <div class="size14 trans-0-4 m-b-10">
                                                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Update Totals
                                </button>
                                </div> -->
                        </div>
                    </div>
                    <!--  -->
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
                        <span class="m-text22 w-size19 w-full-sm">
                        Total:
                        </span>
                        <span class="m-text21 w-size20 w-full-sm">
                        $ <?php echo get_total_cart(); ?>
                        </span>
                    </div>
                    <?php
                        if(isset($_SESSION['is_login'])){
                            ?>
                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" style="">
                        <a href="?mod=cart&act=checkout" style="color: white">Proceed to Checkout</a>
                        </button>
                    </div>
                    <?php
                        }else
                        {
                            ?>
                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" style="">
                        <a href="?mod=users&act=login" style="color: white">Login to checkout</a>
                        </button>
                    </div>
                    <?php
                        }
                        ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php 
    get_footer();   
    ?>