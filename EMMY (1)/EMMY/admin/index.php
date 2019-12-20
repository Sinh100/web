
<?php 

require_once __DIR__. "/autoload/autoload.php";
// $allproduct = intval($db->fetchsql('SELECT COUNT(*) as SL FROM `sanpham`'));

?>

<?php require_once __DIR__. "/layouts/header.php";?>
<!-- Page Heading  NOI DUNG-->


<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Xin chào bạn đến với trang quản trị của admin
		</h1>
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-dashboard"></i>  <a href="index.php">Điều khiển</a>
			</li>
			<li class="active">
				<i class="fa fa-file"></i> Thông tin
			</li>
		</ol>
	</div>
</div>
<!-- /.row -->
<div class="row">
		<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php require '../db/connect.php';
						$sql = "SELECT COUNT(*)as tongsanpham FROM `sanpham` WHERE 1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								echo $rows['tongsanpham'];
						} ?></div>
						<div>Tổng sản phẩm</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/sanpham/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php require '../db/connect.php';
						$sql = "SELECT COUNT(*)as tongbaiviet FROM `baiviet` WHERE 1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								echo $rows['tongbaiviet'];
						} ?></div>
						<div>Tổng bài viết</div>

					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/baiviet/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>


	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php require '../db/connect.php';
						$sql = "SELECT COUNT(*)as tonghoadon FROM `hoadon` WHERE status = 1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								echo $rows['tonghoadon'];
						} ?></div>
						<div>Tổng hóa đơn</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/donhang/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>


	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">$<?php require '../db/connect.php';
						$sql = "SELECT SUM(soluong*dongia)as tongtien FROM `cthoadon` where status=1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								if($rows['tongtien']==NULL)
								{
									echo '0';
								}
								else
								{
									echo $rows['tongtien'];
								}
						} ?></div>
						<div>Tổng Tiền Hóa Đơn</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/donhang/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

		<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">$<?php require '../db/connect.php';
						 $date = getdate();
						 $day = $date['mday'];
						 // echo $day;
						$sql = "SELECT SUM(soluong*dongia)as tongtien FROM `cthoadon` WHERE DAY (created_at)=$day and status=1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								if($rows['tongtien']==NULL)
								{
									echo '0';
								}
								else
								{
									echo $rows['tongtien'];
								}
								
						} ?></div>
						<div> Hóa Đơn Theo Ngày</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/donhang/hoadonngay.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">$<?php require '../db/connect.php';
						 $date = getdate();
						 $mon = $date['mon'];
						$sql = "SELECT SUM(soluong*dongia)as tongtien FROM `cthoadon` WHERE MONTH (created_at)=$mon  and status=1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								if($rows['tongtien']==NULL)
								{
									echo '0';
								}
								else
								{
									echo $rows['tongtien'];
								}
						} ?></div>
						<div> Hóa Đơn Theo Tháng</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/donhang/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">$<?php require '../db/connect.php';
						 $date = getdate();
						 $year = $date['year'];
						$sql = "SELECT SUM(soluong*dongia)as tongtien FROM `cthoadon` WHERE YEAR (created_at)=$year  and status=1";
						$result = $conn->query($sql);
						if($result->num_rows > 0)
							while($rows = $result->fetch_assoc()){	
								if($rows['tongtien']==NULL)
								{
									echo '0';
								}
								else
								{
									echo $rows['tongtien'];
								}
						} ?></div>
						<div> Hóa Đơn Theo Năm</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url() ?>admin/modules/donhang/index.php">
				<div class="panel-footer">
					<span class="pull-left">Xem Chi Tiết</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>



</div>
<?php require_once __DIR__. "/layouts/footer.php";?>