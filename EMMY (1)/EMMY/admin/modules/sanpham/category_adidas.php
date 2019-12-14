
<?php 
$open = "sanpham";
require_once __DIR__. "/../../autoload/autoload.php";


// $product = $db->fetchAll("sanpham");

$category = $db->fetchAll_category("loaisanpham");

if(isset($_GET['id_loai']))
{
	$id_loai=$_GET['id_loai'];
}

if(isset($_GET['page']))
{
	$p = $_GET['page'];
}
else
{
	$p = 1;
}

$sql = "select sanpham.*, loaisanpham.loaisanpham as tenloai from sanpham LEFT JOIN loaisanpham on sanpham.maloai = loaisanpham.id_loai WHERE sanpham.maloai=$id_loai";

// $sql.=" and sanpham.maloai = loaisanpham.id_loai ORDER BY id DESC";
			//print_r($sql); die();
$product = $db->fetchJone_categorySort('sanpham','loaisanpham',$id_loai,$sql,$p,6,true);

if(isset($product['page']))
{
	$sotrang = $product['page'];
	unset($product['page']);
}

?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
<!-- Page Heading  NOI DUNG-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Danh sách sản phẩm
			<a href="add.php" class="btn btn-success">Thêm mới</a>

			<form class="navbar-form" action="search.php" method="POST" style="float: right;" role="search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="tukhoa">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			
			<select class="form-control col-md-8 " id="mySelect" onchange="get_idLoai(this)" style="width: 144px;float: right;top: 14px;" name="" >
				<script  >

					function get_idLoai(sel)
					{
						var x = document.getElementById("mySelect").value;
										// console.log(x)
										// location.replace('id_loai='+x);
										location.replace('category_adidas.php?id_loai='+x);
									}
								</script> 
								<option value="">Loại sản phẩm</option>
								<?php foreach ($category as $item): ?>
									<option value="<?php echo $item['id_loai']?>" ><?php echo $item['loaisanpham'] ?></option>
								<?php endforeach ?>


							</select>
							<div style="clear:both"></div>

						</h1>


						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
							</li>
							<li class="active">
								<i class="fa fa-file"></i>  sản phẩm
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
										<!-- <th><?php echo $id;?></th> -->
										<th>Tên Sản Phẩm</th>
										<th>Danh Mục</th>
										<th>Slug</th>
										<th>Hình Ảnh</th>
										<th>Thông Tin</th>
										<th>Trạng Thái</th>
										<th>Hành Động</th>
									</tr>
								</thead>
								<tbody>
									<?php $stt= 1; foreach ($product as $item ): ?>
									<tr>
										<td><?php echo $stt ?></td>
										<td style="    width: 300px;"><?php echo $item["tensp"] ?></td>
										<td><?php echo $item["tenloai"] ?></td>
										<td><?php echo $item["slug"] ?></td>
										<td>

											<img src="<?php echo uploads() ?><?php  echo $item['hinhanh'] ?>" width="80px" height="80px" alt=""> 
										</td>
										<td>
											<ul>
												<li style="list-style: none;">Giá : $<?php echo $item['gia'] ?></li>
												<li style="list-style: none;">Số lượng : <?php echo $item['soluong'] ?> </li>
											</ul>
										</td>
										<td>
											<?php if ($item['trangthai'] == 0): ?>
												<a href="#" class="btn btn-xs btn-danger"> Ngưng Bán</a>
											<?php else : ?>
												<a href="#" class="btn btn-xs btn-info"> Đang Bán</a>
											<?php endif ?>
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
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}&id_loai=$id_loai\">|<</a></li>";
			    	}
			    	if($p > 1 && $sotrang>1){
			    		$str_prev = $p - 1;
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}&id_loai=$id_loai\"><</a></li>";
			    	}

			    	for($i = 1; $i <= $sotrang; $i++){
			    		
			    		
			    		if($i == $p){
			    			$active = "style='pointer-events: none;
			    			cursor: not-allowed;'";
			    			$str_pagging .= "<li $active><a style='background: white;    border: 1px solid black; color:#222' href = \"?page={$i}&id_loai=$id_loai\">{$i}</a></li>";
			    			
			    		}
			    	}
			    	if($p < $sotrang && $sotrang>1){
			    		$str_next = $p + 1;
			    		$str_pagging .= "<li><a style='    margin-left: 0px;' href = \"?page={$str_next}&id_loai=$id_loai\">></i></a></li>";
			    	}
			    	if($p < $sotrang && $sotrang>1){
			    		$str_prev =  $sotrang;
			    		$str_pagging .= "<li><a href = \"?page={$str_prev}&id_loai=$id_loai\">>|</a></li>";
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