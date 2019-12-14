<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                GET IN TOUCH
            </h4>
            <div>
                <p class="s-text7 w-size27">
                    Any questions? Let us know in store at 459, 768 St, Đồng Nai, call us on <a href="tel:0764656477">0764656477</a>
                </p>
                <div class="flex-m p-t-30">
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                    <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                </div>
            </div>
        </div>
        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Categories
            </h4>
            <ul>
                <?php
                    require 'db/connect.php';
                    $sql = "SELECT *,COUNT(maloai)as tongsp FROM `loaisanpham` LEFT JOIN `sanpham` on `loaisanpham`.`id_loai` = `sanpham`.`maloai` WHERE `loaisanpham`.`trangthai`= 1 GROUP BY maloai";
                    $result = mysqli_query($conn, $sql);
                    $num_rows = mysqli_num_rows($result);
                    if ($num_rows > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                <li <?php
                    if ($i == 1) {
                    	echo "class='first'";
                    } else {
                    	if ($i == $num_rows) {
                    		echo "class='last'";
                    	}
                    }
                    ?>>
                    <a href="?mod=product&act=Categories&id=<?= $row['id_loai'] ?>" class="s-text7 active1" ><?= $row['loaisanpham'] ?></a>
                </li>
                <?php
                    $i++;
                    }
                    }
                    ?>
            </ul>
        </div>
        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Links
            </h4>
            <ul>
                <li class="p-b-9">
                    <a href="?mod=home&act=main" class="s-text7">
                    Home
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="?mod=product&act=main" class="s-text7">
                    Products
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="?mod=contact&act=main" class="s-text7">
                    Contact Us
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="?mod=about&act=main" class="s-text7">
                     About Us
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                Help
            </h4>
            <ul>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                    Track Order
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                    Returns
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                    Shipping
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="#" class="s-text7">
                    FAQs
                    </a>
                </li>
            </ul>
        </div>
        <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                Newsletter
            </h4>
            <form>
                <div class="effect1 w-size9">
                    <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                    <span class="effect1-line"></span>
                </div>
                <div class="w-size2 p-t-20">
                    <!-- Button -->
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                    Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="t-center p-l-15 p-r-15">
        <a href="#">
        <img class="h-size2" src="images/icons/paypal.png" alt="IMG-PAYPAL">
        </a>
        <a href="#">
        <img class="h-size2" src="images/icons/visa.png" alt="IMG-VISA">
        </a>
        <a href="#">
        <img class="h-size2" src="images/icons/mastercard.png" alt="IMG-MASTERCARD">
        </a>
        <a href="#">
        <img class="h-size2" src="images/icons/express.png" alt="IMG-EXPRESS">
        </a>
        <a href="#">
        <img class="h-size2" src="images/icons/discover.png" alt="IMG-DISCOVER">
        </a>
       <!--  <div class="t-center s-text8 p-t-20">
            Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        </div> -->
    </div>
</footer>
<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
    	minimumResultsForSearch: 20,
    	dropdownParent: $('#dropDownSelect1')
    });
    $(".selection-2").select2({
    	minimumResultsForSearch: 20,
    	dropdownParent: $('#dropDownSelect2')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function(){
    	var nameProduct = $(this).parent().parent().parent().find('.block2-name').php();
    	$(this).on('click', function(){
    		swal(nameProduct, "is added to cart !", "success");
    	});
    });
    
    $('.block2-btn-addwishlist').each(function(){
    	var nameProduct = $(this).parent().parent().parent().find('.block2-name').php();
    	$(this).on('click', function(){
    		swal(nameProduct, "is added to wishlist !", "success");
    	});
    });
</script>
<!--===============================================================================================
    -->
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
<script type="text/javascript">
    /*[ No ui ]
       ===========================================================*/
       var filterBar = document.getElementById('filter-bar');
    
       noUiSlider.create(filterBar, {
           start: [ 50, 200 ],
           connect: true,
           range: {
               'min': 50,
               'max': 200
           }
       });
    
       var skipValues = [
       document.getElementById('value-lower'),
       document.getElementById('value-upper')
       ];
    
       filterBar.noUiSlider.on('update', function( values, handle ) {
           skipValues[handle].innerHTML = Math.round(values[handle]) ;
       });

</script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>