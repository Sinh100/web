
<?php 
		$open = "banner";
		require_once __DIR__. "/../../autoload/autoload.php";

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$data = 
			[

				"ten" => postInput('ten'),
				
			];


			$error = [];
			if(postInput('ten') == '')
			{
				$error['ten'] = "Mời bạn nhập tên ";
			}

			// error trống có nghĩa là  không có lỗi
			if($_FILES['hinh']['name'] =='')
			{
				$error['hinh'] = "Mời bạn chọn hình ảnh";
			}
			// error trống có nghĩa là  không có lỗi
			if(empty($error))
			{
				
					$file_name = $_FILES['hinh']['name'];
					$file_tmp  = $_FILES['hinh']['tmp_name'];
					$file_type = $_FILES['hinh']['type'];
					$file_erro = $_FILES['hinh']['error'];

					if ($file_erro == 0)
					{
						$part = ROOT ."";
						$data['hinh'] = $file_name;
					}
				
				
				$id_insert = $db->insert("slideshows",$data);
				if($id_insert)
				{
					move_uploaded_file($file_tmp,$part.$file_name);
					$_SESSION['success'] = "Thêm mới thành công ";
					redirectAdmin("banner");
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
	            Thêm mới banner
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="">Bảng điều khiển</a>
	            </li>
	            <li>
	                <i></i>  <a href="">Banner</a>
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

				<div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Tên banner</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên banner" name="ten">
			        <?php if(isset($error['ten'])): ?>
			        	<p class="text-danger"> <?php echo $error['ten'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">

			    	<label for="exampleInputEmail1">Hình ảnh</label>
			        <input type="file" class="form-control" id="exampleInputEmail1" name="hinh">
			        <?php if(isset($error['hinh'])): ?>
			        	<p class="text-danger"> <?php echo $error['hinh'] ?> </p>	
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