
<?php 
$open = "banner";
require_once __DIR__. "/../../autoload/autoload.php";




if(isset($_GET['page']))
{
	$p = $_GET['page'];
}
else
{
	$p = 1;
}

$sql = "SELECT * FROM `slideshows` ";

			//print_r($sql); die();
$banner = $db->fetchJone('slideshows',$sql,$p,4,true);

if(isset($banner['page']))
{
	$sotrang = $banner['page'];
	unset($banner['page']);
}
// print_r($banner); die();
?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
<!-- Page Heading  NOI DUNG-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Danh sách Banner
			<a href="add.php" class="btn btn-success">Thêm mới</a>

<!-- 			<form class="navbar-form" action="search.php" method="POST" style="float: right;" role="search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="tukhoa">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			
			<select class="form-control col-md-8 " id="mySelect" onchange="aaa(this)" style="width: 144px;float: right;top: 14px;" name="" >
				<script  >

									function aaa(sel)
									{
										var x = document.getElementById("mySelect").value;
										console.log(x)
										location.replace('category_adidas.php?id_loai='+x);
									}
								</script> 
				<option value="">Loại sản phẩm</option>
				<?php foreach ($category as $item): ?>
					<option value="<?php echo $item['id_loai']?>" ><?php echo $item['loaisanpham'] ?></option>
				<?php endforeach ?>

				
			</select> -->
			<div style="clear:both"></div>

		</h1>


		<ol class="breadcrumb">
			<li>
				<i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
			</li>
			<li class="active">
				<i class="fa fa-file"></i>  Banner
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
						<th>Tên Banner</th>
						<th style="width: 300px">Hình Ảnh</th>
						
						<th>Trạng Thái</th>
						<th>Hành Động</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt= 1; foreach ($banner as $item ): ?>
					<tr>
						<td><?php echo $stt ?></td>
						<td><?php echo $item["ten"] ?></td>
						<td>

							<img src="<?php echo uploads() ?><?php  echo $item['hinh'] ?>" width="190px" height="80px" alt=""> 
						</td>
						<td>
							<a href="home.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['trangthai'] == 1 ? 'btn-info' : 'btn-default' ?>">
								<?php echo $item['trangthai'] == 1 ? 'Hiển thị' : 'Không' ?>
							</a>
						</td>
						<td>
							<a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit"></i> Sửa</a>
							<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
						</td>
					</tr>
					<?php $stt++ ; endforeach ?>

				</tbody>
			</table>
			<div class="pull-right">

				<nav aria-label="Page navigation example" pull-right>
					<ul class="pagination">
				    <!-- <li class="page-item">
				      <a class="page-link" href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				  </li> -->
			    <!-- <?php for($i = 1 ;$i <= $sotrang; $i++) : ?>
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
			    	<?php endfor; ?> -->
			    	<?php
			    	
			    	if(isset($_GET['page']))
			    	{
			    		$p = $_GET['page'];
			    	}
			    	else
			    	{
			    		$p = 1;
			    	}
			    	
			    	$str_pagging ="";

			    	if($p > 1 && $sotrang>1){
			    		$str_prev =  1;
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}\">|<</a></li>";
			    	}
			    	if($p > 1 && $sotrang>1){
			    		$str_prev = $p - 1;
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}\"><</a></li>";
			    	}

			    	for($i = 1; $i <= $sotrang; $i++){
			    		
			    		
			    		if($i == $p){
			    			$active = "style='pointer-events: none;
			    			cursor: not-allowed;'";
			    			$str_pagging .= "<li $active><a style='background: white;    border: 1px solid black; color:#222' href = \"?page={$i}\">{$i}</a></li>";
			    			
			    		}
			    	}
			    	if($p < $sotrang && $sotrang>1){
			    		$str_next = $p + 1;
			    		$str_pagging .= "<li><a style='    margin-left: 0px;' href = \"?page={$str_next}\">></i></a></li>";
			    	}
			    	if($p < $sotrang && $sotrang>1){
			    		$str_prev =  $sotrang;
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}\">>|</a></li>";
			    	}
			    	echo $str_pagging;
			    	?>
			    <!-- <li class="page-item">
			      <a class="page-link" href="#" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			  </li> -->
			</ul>
		</nav>
	</div>
</div>
</div>
</div>
<!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php";?>