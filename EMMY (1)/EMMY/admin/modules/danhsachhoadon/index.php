
<?php 
		$open = "danhsachhoadon";
		require_once __DIR__. "/../../autoload/autoload.php";


		

   

							
		if(isset($_GET['page']))
		{
			$p = $_GET['page'];
		}
		else
		{
			$p = 1;
		}

		// $sql = "SELECT cthoadon.ma_HD, hoadon.fullname, hoadon.telephone, sanpham.tensp as tensp, cthoadon.soluong as sl, cthoadon.dongia as dongia , cthoadon.status ,cthoadon.id  from cthoadon, hoadon, sanpham WHERE cthoadon.ma_HD = hoadon.maHD and sanpham.id = cthoadon.ma_SP and cthoadon.status >= 1";
		$sql = "SELECT cthoadon.ma_HD, sanpham.tensp as tensanpham,cthoadon.soluong as sl,sanpham.gia as gia, users.name AS fullname,users.email AS emailaddress,hoadon.address,hoadon.ngaylap, hoadon.telephone, cthoadon.status ,cthoadon.id from cthoadon, hoadon,users, sanpham WHERE users.id=hoadon.id_user AND cthoadon.ma_HD = hoadon.maHD and sanpham.id = cthoadon.ma_SP and cthoadon.status =1 order by cthoadon.id DESC";
		$cthoadon = $db->fetchJone_danhsach_hoadon('cthoadon',$sql,$p,10,true);

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
	           <!--  <a href="add.php" class="btn btn-success">Thêm mới</a> -->
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
		                <th style="width: 151px;">Tên sản phẩm</th>
		                <th>Số Lượng</th>
		                <th>Đơn Giá</th>
		                <th>Tên Khách hàng</th>
		                <th>Email</th>
		                <th>Địa Chỉ</th>
		                <th>Số Điện Thoại</th>
		                <th>Ngày Lập</th>
		                <!-- <th>Trạng Thái</th> -->
		                <!-- <th>Hành Động</th> -->
		                <!-- <th>Xem Chi Tiết</th> -->
		            </tr>
		        </thead>
		        <tbody>
		        	<?php $stt= 1; foreach ($cthoadon as $item ): ?>
			        	<tr>
			                <td><?php echo $stt ?></td>
			                <td><?php echo $item["ma_HD"] ?></td>
			                <td><?php echo $item["tensanpham"] ?></td>
			                <td><?php echo $item["sl"] ?></td>
			                <td>$<?php echo $item["gia"] ?></td>
			                <td><?php echo $item["fullname"] ?></td>
			                <td><?php echo $item["emailaddress"] ?></td>
			                <td><?php echo $item["address"] ?></td>
			                <td><?php echo $item["telephone"] ?></td>
			                 <td><?php echo date("d-m-Y", strtotime($item["ngaylap"])) ?></td>
			                <!-- <td>
			                	<?php if ($item['status'] == 2): ?>
			                		<a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-danger"> Chưa xử lý</a>
			                	<?php else : ?>
			                		<a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-info"> Đã xử lý</a>
			                	<?php endif ?>
			                	
			                </td> -->

			                <!-- <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status'] == 0 ? 'btn-danger' : 'btn-info' ?>"> <?php echo $item['status'] == 0 ? 'chưa xử lý'  : 'đã xử lý' ?></a> -->


			                <!-- <td>
			                	<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
			                </td> -->

			                <!-- <td>
			                	<a class="btn btn-xs btn-warning" href="detail.php?ma_HD=<?php echo $item['ma_HD'] ?>"><i class="fa fa-ellipsis-v"> Chi Tiết</i></a>
			                </td> -->
			            </tr>
		        	<?php $stt++ ; endforeach ?>
		           
		        </tbody>
		    </table>
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