
<?php 
		$open = "user";
		require_once __DIR__. "/../../autoload/autoload.php";


		$users = $db->fetchAll("users");



		if(isset($_GET['page']))
		{
			$p = $_GET['page'];
		}
		else
		{
			$p = 1;
		}

		$sql = "SELECT users.* FROM users ORDER BY id DESC";
		$thanhvien = $db->fetchJone('users',$sql,$p,5,true);

		if(isset($thanhvien['page']))
		{
			$sotrang = $thanhvien['page'];
			unset($thanhvien['page']);
		}

 ?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
	<!-- Page Heading  NOI DUNG-->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Danh sách người dùng
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="index.php">Bảng điều khiển</a>
	            </li>
	            <li class="active">
	                <i class="fa fa-file"></i> Người dùng
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
		                <th>Họ Và Tên</th>
		                <th>Email</th>
		                 <?php if( $_SESSION['admin_level'] == 2 ){
	            	?>
		                <th>Hành Động</th>
		                <?php } ?>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php $stt= 1; foreach ($thanhvien as $item ): ?>
			        	<tr>
			                <td><?php echo $stt ?></td>
			                <td><?php echo $item["name"] ?></td>
			                <td><?php echo $item["email"] ?></td>
			                 <?php if( $_SESSION['admin_level'] == 2 ){
	            			?>	
			                <td>
			                	<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
			                </td>
			                <?php } ?>
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