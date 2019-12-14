
<?php 
		$open = "baiviet";
		require_once __DIR__. "/../../autoload/autoload.php";


		/**
		* danh sách loại sản phẩm 
		*/

		$blog = $db->fetchAll("dmbaiviet");


		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			# code...
			$data = 
			[
				
				"tieude" => postInput('tieude'),
				"iddm" => postInput('iddm'),
				"keyword" => postInput('keyword'),
				"noidung" => postInput('noidung'),
				"nguoiviet" => postInput('nguoiviet'),
				// "hinhanh" => postInput('hinhanh')


			];


			$error = [];

			if(postInput('tieude') == '')
			{
				$error['tieude'] = "Mời bạn nhập tiêu đề";
			}

			if(postInput('iddm') == '')
			{
				$error['iddm'] = "Mời bạn chọn tên danh mục";
			}

			if(postInput('keyword') == '')
			{
				$error['keyword'] = "Mời bạn nhập mô tả";
			}

			if(postInput('noidung') == '')
			{
				$error['noidung'] = "Mời bạn nhập nội dung";
			}

			if(postInput('nguoiviet') == '')
			{
				$error['nguoiviet'] = "Mời bạn nhập nội dung";
			}



			if(!isset($_FILES['hinhanh']))
			{
				$error['hinhanh'] = "Mời bạn nhập hình ảnh";
			}
			// error trống có nghĩa là  không có lỗi
			if(empty($error))
			{
				if (isset($_FILES['hinhanh']))
				{
					$file_name = $_FILES['hinhanh']['name'];
					$file_tmp  = $_FILES['hinhanh']['tmp_name'];
					$file_type = $_FILES['hinhanh']['type'];
					$file_erro = $_FILES['hinhanh']['error'];

					if ($file_erro == 0)
					{
						$part = ROOT ."";
						$data['hinhanh'] = $file_name;
					}
				}
				
				$id_insert = $db->insert("baiviet",$data);
				if($id_insert)
				{
					move_uploaded_file($file_tmp,$part.$file_name);
					$_SESSION['success'] = "Thêm mới thành công ";
					redirectAdmin("baiviet");
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
	            Thêm mới tin tức
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="">Bảng điều khiển</a>
	            </li>
	            <li>
	                <i></i>  <a href="">Tin tức</a>
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
			        <label for="exampleInputEmail1">Tiêu đề</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tiêu đề" name="tieude">
			        <?php if(isset($error['tieude'])): ?>
			        	<p class="text-danger"> <?php echo $error['tieude'] ?> </p>	
			        <?php endif?>
			        
			    </div>

				<div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">danh mục tin tức</label>
			        <select class="form-control col-md-8" name="iddm" id="">
			        	<option value="">Mời bạn chọn danh mục tin tức</option>
			        	<?php foreach ($blog as $item): ?>
			        		<option value="<?php echo $item['id_dm'] ?>"><?php echo $item['tendm'] ?></option>
			        	<?php endforeach ?>
			        </select>
			        <?php if(isset($error['iddm'])): ?>
			        	<p class="text-danger"> <?php echo $error['iddm'] ?> </p>	
			        <?php endif?>
			        
			    </div>
			    
			    <div class="form-group col-sm-8">

			    	<label for="exampleInputEmail1">Hình ảnh</label>
			        <input type="file" class="form-control" id="exampleInputEmail1" name="hinhanh">
			        <?php if(isset($error['hinhanh'])): ?>
			        	<p class="text-danger"> <?php echo $error['hinhanh'] ?> </p>	
			        <?php endif?>

			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Người viết</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Người viết" name="nguoiviet">
			        <?php if(isset($error['nguoiviet'])): ?>
			        	<p class="text-danger"> <?php echo $error['nguoiviet'] ?> </p>	
			        <?php endif?>
			        
			    </div>


			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Mô tả</label>
			        <textarea class="form-control" name="keyword" id="" rows="4" ></textarea>
			        <?php if(isset($error['keyword'])): ?>
			        	<p class="text-danger"> <?php echo $error['keyword'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Nội dung</label>
			        <textarea class="form-control ckeditor" name="noidung" rows="4" ></textarea>
			        <?php if(isset($error['noidung'])): ?>
			        	<p class="text-danger"> <?php echo $error['noidung'] ?> </p>	
			        <?php endif?>
			        
			    </div>




			        <div class="form-group col-sm-8">
			        	<button type="submit" class="btn btn-primary">Lưu</button>
			        </div>
			    
			</form>
		</div>
	</div>



<?php require_once __DIR__. "/../../layouts/footer.php";?>