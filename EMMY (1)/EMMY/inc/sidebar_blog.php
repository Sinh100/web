<?php
    require 'db/connect.php';
     $get_Featured_products=get_Featured_Products();
     	 //show_array($get_Featured_products);
    ?>
<div class="col-md-4 col-lg-3 p-b-75">
    <div class="rightbar">
        <!-- Search -->
        <!-- <div class="pos-relative bo11 of-hidden">
            <input class="s-text7 size16 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search">
            <button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
            <i class="fs-13 fa fa-search" aria-hidden="true"></i>
            </button>
        </div> -->
        <!-- Categories -->
        <h4 class="m-text23 p-b-34">
            Categories
        </h4>
        <ul>
            <?php
                $sql = "SELECT *,COUNT(iddm)as tongbaiviet FROM `dmbaiviet` LEFT JOIN `baiviet` on `dmbaiviet`.`id_dm` = `baiviet`.`iddm` WHERE `dmbaiviet`.`trangthai`= 1 GROUP BY id_dm";
                
                $result = mysqli_query($conn, $sql);
                // echo $result;
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
            <li class="p-t-6 p-b-8 bo6">
                <a href="?mod=blog&act=categories_blog&id=<?= $row['id_dm'] ?>" class="s-text13 p-t-5 p-b-5">
                <?= $row['tendm'] ?>
                (<?= $row['tongbaiviet'] ?>)
                </a>
            </li>
            <?php
                $i++;
                }
                }
                ?>
        </ul>
        <!-- Featured Products -->
        <h4 class="m-text23 p-t-65 p-b-34">
            Featured Products
        </h4>
        <ul class="bgwhite">
            <?php
                foreach ( $get_Featured_products as  $Featured_products)
                {
                
                
                ?>
            <li class="flex-w p-b-20">
                <a href="?mod=product&act=product_detail&id=<?php echo $Featured_products["id"]?>" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                <img src="imgs/<?php echo $Featured_products["hinhanh"]?>" alt="IMG-PRODUCT">
                </a>
                <div class="w-size23 p-t-5">
                    <a href="?mod=product&act=product_detail&id=<?php echo $Featured_products["id"]?>" class="s-text20">
                    <?php echo $Featured_products["tensp"]?>
                    </a>
                    <span class="dis-block s-text17 p-t-6">
                    $<?php echo $Featured_products["gia"]?>
                    </span>
                </div>
            </li>
            <?php
                }
                ?>
        </ul>
        <!-- Archive -->
       <!--  <h4 class="m-text23 p-t-50 p-b-16">
            Archive
        </h4>
        <ul>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                July 2018
                </a>
                <span class="s-text13">
                (9)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                June 2018
                </a>
                <span class="s-text13">
                (39)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                May 2018
                </a>
                <span class="s-text13">
                (29)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                April  2018
                </a>
                <span class="s-text13">
                (35)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                March 2018
                </a>
                <span class="s-text13">
                (22)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                February 2018
                </a>
                <span class="s-text13">
                (32)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                January 2018
                </a>
                <span class="s-text13">
                (21)
                </span>
            </li>
            <li class="flex-sb-m">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                December 2017
                </a>
                <span class="s-text13">
                (26)
                </span>
            </li>
        </ul> -->
        <!-- Tags -->
        <!-- <h4 class="m-text23 p-t-50 p-b-25">
            Tags
        </h4>
        <div class="wrap-tags flex-w">
            <a href="#" class="tag-item">
            Fashion
            </a>
            <a href="#" class="tag-item">
            Lifestyle
            </a>
            <a href="#" class="tag-item">
            Denim
            </a>
            <a href="#" class="tag-item">
            Streetstyle
            </a>
            <a href="#" class="tag-item">
            Crafts
            </a>
        </div> -->
    </div>
</div>