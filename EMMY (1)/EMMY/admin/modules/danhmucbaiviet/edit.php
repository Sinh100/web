
<?php 
		$open = "danhmucbaiviet";
		require_once __DIR__. "/../../autoload/autoload.php";


		$id = intval(getInput('id_dm'));




		$editblog = $db->fetchIDblog("dmbaiviet", $id);
		if(empty($editblog))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("danhmucbaiviet");
		}


		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			# code...
			$data = 
			[
				"tendm" => postInput('tendm'),
				"slug" => to_slug(postInput('tendm'))
			];


			$error = [];

			if(postInput('tendm') == '')
			{
				$error['tendm'] = "Mời bạn nhập đầy đủ tên danh mục";
			}

			// error trống có nghĩa là  không có lỗi
			if(empty($error))
			{
				// kiểm tra
				if($editblog['tendm'] != $data['tendm']) //name
				{
					$isset = $db->fetchOne("dmbaiviet"," tendm = '".$data['tendm']."'  ");
					if(count($isset) > 0)
					{
						$_SESSION['error'] = "Tên Loại sản phẩm đã tồn tại";
					}
					else
					{
						$id_update = $db->update("dmbaiviet", $data,array("id_dm"=>$id));
						if($id_update > 0 )
						{
							$_SESSION['success'] = "Cập nhật thành công";
							redirectAdmin("danhmucbaiviet");
						}
						else
						{
							// thêm thất bại
							$_SESSION['error'] = "Dữ liệu không thay đổi";
							redirectAdmin("danhmucbaiviet");
						}
					}
				}
				else
				{
					$id_update = $db->update("dmbaiviet", $data,array("id_dm"=>$id));
					if($id_update > 0 )
					{
						$_SESSION['success'] = "Cập nhật thành công";
						redirectAdmin("danhmucbaiviet");
					}
					else
					{
						// thêm thất bại
						$_SESSION['error'] = "Dữ liệu không thay đổi";
						redirectAdmin("danhmucbaiviet");
					}
				}
				
				
			}

		}

		

 ?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
	<!-- Page Heading  NOI DUNG-->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Sửa loại sản phẩm
	        </h1>
	        <ol class="breadcrumb">
	            <li>
	                <i class="fa fa-dashboard"></i>  <a href="">Bảng điều khiển</a>
	            </li>
	            <li>
	                <i></i>  <a href="">Danh mục</a>
	            </li>
	            <li class="active">
	                <i class="fa fa-file"></i> Sửa
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
			<form class="form-horizontal" action="" method="POST">
			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Tên danh mục</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="tendm" value="<?php echo $editblog['tendm'] ?>">
			        <?php if(isset($error['tendm'])): ?>
			        	<p class="text-danger"> <?php echo $error['tendm'] ?> </p>	
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