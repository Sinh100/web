
<?php 
		$open = "donhang";
		require_once __DIR__. "/../../autoload/autoload.php";


		$cthoadon = $db->fetchAll("cthoadon");

   	
		$ma_HD = $_GET['ma_HD'];
							
		if(isset($_GET['page']))
		{
			$p = $_GET['page'];
		}
		else
		{
			$p = 1;
		}

		// $sql = "SELECT cthoadon.ma_HD, hoadon.fullname, hoadon.telephone, sanpham.tensp as tensp, cthoadon.soluong as sl, cthoadon.dongia as dongia , cthoadon.status ,cthoadon.id  from cthoadon, hoadon, sanpham WHERE cthoadon.ma_HD = hoadon.maHD and sanpham.id = cthoadon.ma_SP and cthoadon.status >= 1";
		$sql = "SELECT cthoadon.ma_HD,sanpham.tensp as tensp,cthoadon.soluong as sl, cthoadon.dongia as dongia , cthoadon.status ,cthoadon.id,(cthoadon.soluong*cthoadon.dongia)as tongtien from cthoadon, hoadon, sanpham WHERE cthoadon.ma_HD = hoadon.maHD and sanpham.id = cthoadon.ma_SP and cthoadon.status >= 1 and ma_HD=$ma_HD";
		$cthoadon = $db->fetchJone_chitiet('cthoadon',$ma_HD,$sql,$p,5,true);

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
	            Danh sách Đơn hàng
	            <!-- <a href="add.php" class="btn btn-success">Thêm mới</a> -->
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
	            </li>
	            <li class="active">
	                <i class="fa fa-file"></i> Thành viên
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
		        <thead>
		            <tr>
		                <th>STT</th>
		                <th>Mã Hóa đơn</th>
		                <th>Tên Sản Phẩm</th>
		                <th>Số Lượng</th>
		                <th>Đơn Giá</th>
		                <th>Tổng Tiền</th>
		                <th>Trạng Thái</th>
		                <?php foreach ($cthoadon as $item ){
		                	$trangthai = $item['status'];
		                }
		                	if($trangthai ==2)
		                	{
		                ?>
		                <th>Hành Động</th>
		                <?php } ?>
		            	
		            </tr>
		        </thead>
		        <tbody>
		        	<?php $stt= 1; foreach ($cthoadon as $item ): ?>
			        	<tr>
			                <td><?php echo $stt ?></td>
			                <td><?php echo $item["ma_HD"] ?></td>
			                <td><?php echo $item["tensp"] ?></td>
			                <td><?php echo $item["sl"] ?></td>
			                <td>$<?php echo $item["dongia"] ?></td>
			                <td>$<?php echo $item["tongtien"] ?></td>
			                
			                <td>
			                	<?php if ($item['status'] == 2): ?>

			                		<a style="pointer-events: none;" href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-danger"> Chưa xử lý</a>
			                		
			                	<?php else : ?>
			                		
			                		<a style="pointer-events: none;" href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-info"> Đã xử lý</a>
			                		
			                	<?php endif ?>
			                	<!-- <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status'] == 0 ? 'btn-danger' : 'btn-info' ?>"> <?php echo $item['status'] == 0 ? 'chưa xử lý'  : 'đã xử lý' ?></a> -->
			                </td>
			                
			                <?php

			                 if ($item['status'] == 2){ ?>
			                <td>
			                	<a class="btn btn-xs btn-danger" href="delete_chitiet.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
			                </td>
			                <?php } ?>
			            </tr>
		        	<?php $stt++ ; endforeach ?>
		           
		        </tbody>
		    </table>
		    <a class="btn btn-xs btn-primary" href="index.php"><i class="fa fa-undo"></i> Trở về</a>
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
		</div>
		</div>
	</div>
	<!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php";?>