
<?php 
		$open = "hinhanhsanpham";
		require_once __DIR__. "/../../autoload/autoload.php";


		/**
		* danh sách loại sản phẩm 
		*/

		$picture = $db->fetchAll_sp("sanpham");

		// $sql = "SELECT id, FROM `sanpham` ORDER BY `id`  DESC LIMIT 1";
		// $sql->fetchID("sanpham");

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			# code...
			$data = 
			[
				
				"hinhspID" => postInput('hinhspID'),

				// "hinhanh" => postInput('hinhanh')


			];


			$error = [];

			if(postInput('hinhspID') == '')
			{
				$error['hinhspID'] = "Mời bạn nhập tên sản phẩm";
			}


			// _debug($_FILES['duongdan']['name']);die;
			if($_FILES['duongdan']['name'] =='')
			{
				$error['duongdan'] = "Mời bạn chọn hình ảnh";
			}
			// error trống có nghĩa là  không có lỗi
			if(empty($error))
			{
				
					$file_name = $_FILES['duongdan']['name'];
					$file_tmp  = $_FILES['duongdan']['tmp_name'];
					$file_type = $_FILES['duongdan']['type'];
					$file_erro = $_FILES['duongdan']['error'];

					if ($file_erro == 0)
					{
						$part = ROOT ."";
						$data['duongdan'] = $file_name;
						
					}
				
				
				$id_insert = $db->insert("hinhanh",$data);
				if($id_insert)
				{
					move_uploaded_file($file_tmp,$part.$file_name);
					$_SESSION['success'] = "Thêm mới thành công ";
					redirectAdmin("hinhanhsanpham");
				}
				else
				{
					$_SESSION['error'] = "Thêm thất bại ";
				}
			}

		}

		

 ?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
	<!-- Page Heading  NOI DUNG-->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Thêm hình ảnh cho sản phẩm
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="">Bảng điều khiển</a>
	            </li>
	            <li>
	                <i></i>  <a href="">Sản phẩm</a>
	            </li>
	            <li class="active">
	                <i class="fa fa-file"></i> Thêm mới
	            </li>
	        </ol>
	        <div class="clearfix"></div>
		        <?php if(isset($_SESSION['error'])) : ?>
		        	<div class="alert alert-danger">
		                 <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
		            </div>
		        <?php endif ; ?>
	    </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

				<!-- <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Mã sản phẩm</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" name="id">
			        <?php if(isset($error['tensp'])): ?>
			        	<p class="text-danger"> <?php echo $error['id'] ?> </p>	
			        <?php endif?>
			        
			    </div> -->
				<div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Loại sản phẩm</label>
			        <select class="form-control col-md-8" name="hinhspID" id="">
			        	<option value="">Mời bạn chọn danh mục sản phẩm</option>
			        	<?php foreach ($picture as $item): ?>
			        		<option value="<?php echo $item['id'] ?>"> # <?php echo $item['id'] ?> - <?php echo $item['tensp'] ?></option>
			        	<?php endforeach ?>
			        </select>
			        <?php if(isset($error['hinhspID'])): ?>
			        	<p class="text-danger"> <?php echo $error['hinhspID'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">

			    	<label for="exampleInputEmail1">Hình ảnh</label>
			        <input type="file" class="form-control" id="exampleInputEmail1" name="duongdan">
			        <?php if(isset($error['duongdan'])): ?>
			        	<p class="text-danger"> <?php echo $error['duongdan'] ?> </p>	
			        <?php endif?>


			    </div>


			    


			        <div class="form-group col-sm-8">
			        	<button type="submit" class="btn btn-primary">Lưu</button>
			        </div>
			    
			</form>
		</div>
	</div>
	<!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php";?>