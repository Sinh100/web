<?php
    require 'db/connect.php';
    $sql = "select * from loaisanpham where trangthai = 1";
    $result = mysqli_query($conn, $sql);
    $list_cat = array();
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
    		$list_cat[] = $row;
    
    	}
    }
    
    if(isset($_GET['id'])){
    	
    	$id = (int)$_GET['id'];
    	$sql = "select * from sanpham where maloai = {$id} and trangthai=1";
    	$result = mysqli_query($conn, $sql);
    	$list_product = array();
    	$num_rows = mysqli_num_rows($result);
    	if ($num_rows > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
    			$list_product[] = $row;
    
    		}
    
    	}
    
    }
    
    ?>
<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
    <div class="leftbar p-r-20 p-r-0-sm">
        <!--  -->
        <h4 class="m-text14 p-b-7">
            Categories
        </h4>
        <ul class="p-b-54">
            <?php
                $sql = "SELECT *,COUNT(maloai)as tongsp FROM `loaisanpham` LEFT JOIN `sanpham` on `loaisanpham`.`id_loai` = `sanpham`.`maloai` WHERE `loaisanpham`.`trangthai`= 1 and sanpham.trangthai = 1 GROUP BY maloai";
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
                <a href="?mod=product&act=Categories&id=<?= $row['id_loai'] ?>" class="s-text13 active1"><?= $row['loaisanpham'] ?></a>(<?= $row['tongsp'] ?>)
            </li>
            <?php
                $i++;
                }
                }
                ?>
        </ul>
        <!-- filter -->
        <form action="?mod=product&act=search" method="post">
            <div class="search-product pos-relative bo4 of-hidden">
                <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="tukhoa" placeholder="Search Products...">
                <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" type="submit">
                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
</div>