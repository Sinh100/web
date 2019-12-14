
<?php 
$open = "donhang";
require_once __DIR__. "/../../autoload/autoload.php";

if(isset($_POST['day1']))
{
	$day1 =  ($_POST['day1']);
		// print_r($day1);die();
}
else
{
	$currentDate = getdate();
	$day1 = $currentDate["year"] . "-". $currentDate["mon"] . "-". $currentDate["mday"];
	 // print_r(date("d-m-Y ", strtotime($day1)));die();
}




if(isset($_GET['page']))
{
	$p = $_GET['page'];
}
else
{
	$p = 1;
}
$sqlday = "SELECT sum(cthoadon.soluong*cthoadon.dongia)as tongtien, cthoadon.ma_HD, users.name as fullname , users.email as emailaddress,hoadon.address,hoadon.ngaylap, hoadon.telephone, cthoadon.status ,cthoadon.id from cthoadon, hoadon, sanpham,users WHERE users.id= hoadon.id_user and cthoadon.ma_HD = hoadon.maHD and sanpham.id = cthoadon.ma_SP and hoadon.status = 1 and hoadon.ngaylap= '$day1 00:00:00' GROUP by hoadon.maHD ";
// printf($sqlday);die();
$cthoadon = $db->fetchJone_hoadonngay('hoadon',$sqlday,$day1,$p,10,true);


	// $cthoadon = $db->fetchJone_hoadonngay('hoadon',$sql,$p,10,true);

if(isset($cthoadon['page']))
{
	$sotrang = $cthoadon['page'];
	unset($cthoadon['page']);
}

?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
<!-- Page Heading  NOI DUNG-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Danh sách Hóa Đơn Theo Ngày
		</h1>
		<form action="#" method="post" style=" position: absolute;top: 50px;right: 18px;"> 
			<input type="date" name="day1" >
			<button type="submit" class="btn btn-xs btn-danger">Tìm</button>
		</form>		
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
			</li>
			<li class="active">
				<i class="fa fa-file"></i> Quản lý hóa đơn
			</li>


		</ol>

		<div class="clearfix"></div>
		<?php if(isset($_SESSION['success'])) : ?>
			<div class="alert alert-success">
				<?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
			</div>
		<?php endif ; ?>

		<?php if(isset($_SESSION['error'])) : ?>
			<div class="alert alert-danger">
				<?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
			</div>
		<?php endif ; ?>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<?php 
				if(!empty($cthoadon))
				{


					?>
					<thead>
						<tr>
							<th>STT</th>
							<th>Mã Hóa đơn</th>
							<th>Tên</th>
							<th>Email</th>
							<th>Địa Chỉ</th>
							<th>Số Điện Thoại</th>
							<th>Ngày Lập</th>
		                <!-- <th>Trạng Thái</th>
		                	<th>Hành Động</th> -->
		                	<th>Tổng Tiền</th> 
		                </tr>
		            </thead>

		            <tbody>
		            	<?php $stt= 1; foreach ($cthoadon as $item ): ?>
		            	<tr>
		            		<td><?php echo $stt ?></td>
		            		<td><?php echo $item["ma_HD"] ?></td>
		            		<td><?php echo $item["fullname"] ?></td>
		            		<td><?php echo $item["emailaddress"] ?></td>
		            		<td><?php echo $item["address"] ?></td>
		            		<td><?php echo $item["telephone"] ?></td>
		            		<td><?php echo date("d-m-Y", strtotime($item["ngaylap"])) ?></td>
		            		<td>$<?php echo $item["tongtien"] ?></td>
		            	</tr>
		            	<?php $stt++ ; endforeach ?>

		            </tbody>
		        <?php }else{
		        	?><h1 style="text-align: center;">Không có hóa đơn</h1> <?php 

		        } ?>
		    </table>
		    <?php
		    if(!empty($cthoadon))
		    {

		    	?>
		    	<div class="pull-right">

		    		<nav aria-label="Page navigation example" pull-right>
		    			<ul class="pagination">
		    				<li class="page-item">
		    					<a class="page-link" href="#" aria-label="Previous">
		    						<span aria-hidden="true">&laquo;</span>
		    					</a>
		    				</li>
		    				<?php for($i = 1 ;$i <= $sotrang; $i++) : ?>
		    					<?php
		    					if(isset($_GET['page']))
		    					{
		    						$p = $_GET['page'];
		    					}
		    					else
		    					{
		    						$p = 1;
		    					}
		    					?>
		    					<li class="<?php echo ($i == $p) ? 'active' : '' ?>">
		    						<a href="?page=<?php echo $i ; ?>"><?php echo $i; ?></a>
		    					</li>
		    				<?php endfor; ?>
		    				<li class="page-item">
		    					<a class="page-link" href="#" aria-label="Next">
		    						<span aria-hidden="true">&raquo;</span>
		    					</a>
		    				</li>
		    			</ul>
		    		</nav>
		    	</div>
		    	<?php 
		    } 
		    ?>
		</div>
	</div>
</div>
<!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php";?>