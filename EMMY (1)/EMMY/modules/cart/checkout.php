<?php 
    get_header();   
    ?>
<?php $list = get_list_by_cart(); 
    $list_user_checkout = $_SESSION['user_login'];
    $list_user = get_list_user($list_user_checkout);
    // show_array($list_user);
    ?>
<?php
    function displayResultsAsTable($resultsArray) {
    // argument must be an array
        $val = '<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor="#ffcccc" style="text-align:center;margin: 20px 0px;">
      <tr>
        <th>Tên sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th> 
        <th>Size </th>
        <th>Thành tiền</th> 
      </tr>';
        if (is_array($resultsArray)) {
            foreach ($resultsArray as $key => $value) {
                $val .= '<tr>';
                foreach ($value as $f_key => $f_val) {
                  if($f_key == 'gia')
                  {
                    $val .= '<td>$' . $f_val . '</td>';
                  }else if($f_key == 'tongtien')
                  {
                     $val .= '<td>$' . $f_val . '</td>';
                   }else if($f_key == 'size')
                  {
                     $val .= '<td>$' . $f_val . '</td>';
                   }
                   else
                   {
                    $val .= '<td>' . $f_val . '</td>';
                   }
                  
                }
                $val .= '</tr>';
            }
            $val .= '</table>';
            return $val;
        }
    }
    ?>
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30">
                <div class="order-summary">
                    <div class="section-title left-aligned with-border">
                        <h4 class="m-text26 p-b-36 p-t-15">Shopping cart</h4>
                    </div>
                    <?php
                        //Kiểm tra SESSION giỏ hàng có không, nếu có thì hiển thị form thanh toán,không thì thông báo giỏ hàng không có span
                        if(isset($_SESSION["cart"])){

                              //Kiểm tra thông tin thanh toán được post lên không? (nếu có thì lưu giỏ hàng, ngược lại hiển thị form thanh toán)
                        if(isset($_POST["fullname"]) && isset($_POST["company"]) && isset($_POST["emailaddress"]) && isset($_POST["address"]) && isset($_POST["city"]) && isset($_POST["province"]) && isset($_POST["country"]) && isset($_POST["telephone"])) {
                                    //Lưu giở hàng ==> hóa đơn
                                    //Lưu vào bảng hoadon
                             // echo "vao roi";
                        $fullname = $_POST["fullname"];
                         // echo  $fullname;
                        $company = $_POST["company"];
                        $emailaddress = $_POST["emailaddress"];
                        $address = $_POST["address"];
                        $city = $_POST["city"];
                        $province = $_POST["province"];
                        $country = $_POST["country"];
                        $telephone = $_POST["telephone"];
                        $id_user = $list_user['id'];
                       $currentDate = getdate();
                        $day1 = $currentDate["year"] . "-". $currentDate["mon"] . "-". $currentDate["mday"];
                        $sql = "INSERT INTO hoadon( company, address, city, province, country, telephone,ngaylap,id_user) VALUES('$company','$address','$city','$province','$country','$telephone','$day1','$id_user')";
                        if($conn->query($sql)){
                        $ma_HD = $conn->insert_id;
                                          //Lưu chi tiết hóa đơn
                                          //$cart = $_SESSION["cart"];
                        foreach ($list as $sp) {
                                              # code...
                        $ma_SP = $sp["id"];
                        $sluong = $sp["soluong"];
                        $dgia = $sp["gia"];
                        $ten = $sp["tensp"];
                        $size = $sp["size"];
                        $sql = "INSERT INTO cthoadon(ma_HD, ma_SP, soluong, dongia, size) VALUES($ma_HD, $ma_SP ,$sluong, $dgia, $size)";
                        $conn->query($sql);
                                                //Cập nhật lại số lượng của sản phẩm trong bảng sản phẩm
                                                // $sql = "UPDATE sanpham SET soluong = soluong - $sluong WHERE id = $ma_SP";
                                                // $conn->query($sql);
                        }
                                          //Thêm thành công
                                          //Xóa giỏ hàng
                        unset($_SESSION["cart"]);
                        echo "<script>alert('Congratulations on your successful order.');location.href='?mod=home&act=main'</script>";
                        $get_order = get_order( $ma_HD);
                        
                        // $message = '
                        // <p >Chào <b>'. $fullname.'</b>,<br>Cám ơn bạn đã mua hàng tại EMMY SHOP. Mong rằng bạn đã có trải nghiệm tuyệt vời tại cửa hàng của chúng tôi. Mã đơn hàng của bạn là: <b '.displayResultsAsTable($get_order).'
                        // Mọi thông tin phản hồi, bạn có thể liên lạc trực tiếp với hotline <a href="tel:0962011240">0962011240</a>, hoặc điền phiếu đánh giá tại của hàng.<br>
                        // Xin cám ơn,<br>
                        // EMMY SHOP.';
                        $message = '
                        <h1 style="color:red;">Thông báo đơn hàng hoàn tất</h1>
                        <p>Chào <b>' . $fullname . '</b></p>'
                        . '<p>Đơn hàng #<b style="color: #ef4a33;">'.$ma_HD.'</b> của bạn đã hoàn tất.</p>'
                        . 'Cảm ơn bạn đã mua hàng tại EMMY SHOP.<br> Thông tin đơn hàng của bạn: <b> ' . displayResultsAsTable($get_order) . '</b>
                        <p>Rất mong được phục vụ bạn trong những lần mua tiếp theo.Mọi thông tin phản hồi, bạn có thể liên lạc trực tiếp với hotline <a href="tel:0764656477">0764656477</a>, hoặc điền phiếu đánh giá tại của hàng.</p>';
                        
                        echo send_mail($emailaddress,$fullname,'Cám ơn bạn đã mua hàng tại EMMY SHOP!',$message);
                        ?>
                    <!-- <p>Chúc mừng bạn đã đặt đơn hàng thành công.</p>
                        <p>Mã hóa đơn #<?=$ma_HD?></p> -->
                    <?php
                        } else {
                          ?> 
                    echo "<script>alert(' Order payment is unsuccessful.');location.href='?mod=cart&act=checkout'</script>";
                    <!-- <p>Thanh toán đặt đơn hàng không thành công.</p> -->
                    <?php
                        }
                        
                        } else {
                        
                        ?>
                    <form action="?mod=cart&act=checkout" method="POST" class="leave-comment">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <!-- <td>Image</td> -->
                                    <td>Product Name</td>
                                    <td>Quantity</td>
                                    <td>Size</td>
                                    <td>Unit Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // $tongtien=0;
                                    // $cart = $_SESSION["cart"];
                                                              foreach($list as $sp){
                                        // $tien=$sp["gia"]*$sp["soluong"];
                                        // $tongtien +=$tien;
                                                                ?> 
                                <tr>
                                    <!-- <td>
                                        <a href="single-product.php?id=<?=$sp["id"]?>"><img src="imgs/<?=$sp["hinhanh"]?>" alt="Cart Product Image" title="Cas Meque Metus" class="img-thumbnail"></a>
                                        </td> -->
                                    <td>
                                        <a href="single-product.php?id=<?=$sp["id"]?>"><?php echo  $sp['tensp'] ?></a>
                                    </td>
                                    <td type="text"><?php echo  $sp['soluong'] ?></td>
                                    <td type="text"><?php echo  $sp['size'] ?></td>
                                    <td type="text"><?php echo  $sp['gia'] ?></td>
                                </tr>
                                <?php
                                    }
                                    ?> 
                            </tbody>
                        </table>
                </div>
                <div class="order-summary">
                <table class="table table-bordered" style="text-align: center">
                <tbody>
                <tr class="cart-subtotal">
                <th>Subtotal</th>
                <td class="text-center">  $ <?php echo get_total_cart(); ?></td>
                </tr>            
                <tr class="order-total">
                <th>Total</th>
                <td class="text-center"><strong><span class="primary-color">  $ <?php echo get_total_cart(); ?></span></strong></td>
                </tr>
                </tbody>
                </table>
                </div>
                <div class="w-size25">
                <!-- Button -->
                <!-- <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                    Thanh Toán
                    </button> -->
                <input type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" style="cursor: pointer" value="PLACE ORDER">
                </div>
            </div>
            <div class="col-md-6 p-b-30">
            <h4 class="m-text26 p-b-36 p-t-15">
            Billing Details
            </h4>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="fullname" placeholder="<?php echo $list_user['name']?>" value="<?php echo $list_user['name']?>" class="form-control">
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="company" placeholder="Company" class="form-control" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="emailaddress" placeholder="<?php echo $list_user['email']?>" class="form-control" value="<?php echo $list_user['email']?>" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="address" placeholder="Address"  class="form-control" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="city" placeholder="City" class="form-control" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="province" placeholder="Province" class="form-control" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="country" placeholder=" Country" class="form-control" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" pattern="[0-9]{10}" name="telephone" placeholder="Phone" class="form-control"  required>
            </div>
            </form>
            <?php
                }
                
                }
                else 
                {
                
                ?>
            <p> Cart has no product. Please <a href="?mod=product&act=main" style="color: red">return</a> to the shopping page.</p>
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