
<?php 
		$open = "loaisanpham";
		require_once __DIR__. "/../../autoload/autoload.php";


		/**
		* danh sách loại sản phẩm 
		*/

		


		$id = intval(getInput('id'));

		$category = $db->fetchAll("loaisanpham");
		//print_r($category);die();
		$editproduct = $db->fetchID("sanpham", $id);
		if(empty($editproduct))
		{
			$_SESSION['error'] = "Dữ liệu không tồn tại";
			redirectAdmin("sanpham");
		}


		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			# code...
			$data = 
			[
				
				"tensp" => postInput('tensp'),
				"maloai" => postInput('maloai'),
				"slug" => to_slug(postInput('tensp')),
				"gia" => postInput('gia'),
				"soluong" => postInput('soluong'),
				"motangan" => postInput('motangan'),
				"motadai" => postInput('motadai'),
				"trangthai" => postInput('trangthai'),
				// "hinhanh" => postInput('hinhanh')


			];



			$error = [];

			if(postInput('tensp') == '')
			{
				$error['tensp'] = "Mời bạn nhập tên sản phẩm";
			}

			if(postInput('maloai') == '')
			{
				$error['maloai'] = "Mời bạn chọn tên danh mục";
			}

			if(postInput('gia') == '')
			{
				$error['gia'] = "Mời bạn nhập giá sản phẩm";
			}

			if(postInput('soluong') == '')
			{
				$error['soluong'] = "Mời bạn nhập số lượng";
			}

			if(postInput('motangan') == '')
			{
				$error['motangan'] = "Mời bạn nhập nội dung";
			}

			if(postInput('motadai') == '')
			{
				$error['motadai'] = "Mời bạn nhập nội dung";
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

				$update = $db->update("sanpham", $data,array("id"=>$id));
				if($update > 0 )
				{
					move_uploaded_file($file_tmp,$part.$file_name);
					$_SESSION['success'] = "Cập nhật thành công ";
					redirectAdmin("sanpham");
				}
				else
				{
					$_SESSION['error'] = "Cập nhật thất bại ";
					redirectAdmin("sanpham");
				}
			}

		}

		

 ?>

<?php require_once __DIR__. "/../../layouts/header.php";?>
	<!-- Page Heading  NOI DUNG-->
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            Thêm mới sản phẩm
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
				<div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Loại sản phẩm</label>
			        <select class="form-control col-md-8" name="maloai" id="">
			        	<!-- <?php
			        		if( $editproduct['maloai'] == 1) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">ADIDAS</option>
			        	<?php } ?>
			        	<?php
			        		if( $editproduct['maloai'] == 2) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">AIR JORDANS</option>
			        	<?php } ?>
			        	<?php
			        		if( $editproduct['maloai'] == 3) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">BALENCIAGA </option>
			        	<?php } ?>
			        	<?php
			        		if( $editproduct['maloai'] == 4) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">CONVERSE </option>
			        	<?php } ?>
			        	<?php
			        		if( $editproduct['maloai'] == 5) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">VANS </option>
			        	<?php } ?>
			        	<?php
			        		if( $editproduct['maloai'] == 23) {
			        	?>
			        	<option value="<?php echo $editproduct['maloai'] ?>">NEW BALANCE</option>
			        	<?php } ?> -->
						<?php foreach ($category as $cat ): 
							# code...
							if($editproduct['maloai'] == $cat['id_loai']): 
						?>
						<option value="<?php echo $editproduct['maloai'] ?>"><?php echo $cat['loaisanpham'] ?></option>
						<?php endif ; endforeach ?>

			        	<?php foreach ($category as $item): ?>
			        		<option value="<?php echo $item['id_loai'] ?>" <?php echo $editproduct['id'] == $item['id_loai'] ? "selected = 'selected' "  : ''  ?>>  <?php echo $item['loaisanpham'] ?> </option>
			        	<?php endforeach ?>
			        </select>
			        <?php if(isset($error['maloai'])): ?>
			        	<p class="text-danger"> <?php echo $error['maloai'] ?> </p>	
			        <?php endif?>
			        
			    </div>


			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Tên sản phẩm</label>
			        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" name="tensp" value="<?php echo $editproduct['tensp'] ?>">
			        <?php if(isset($error['tensp'])): ?>
			        	<p class="text-danger"> <?php echo $error['tensp'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">

			    	<label for="exampleInputEmail1">Hình ảnh</label>
			        <input type="file" class="form-control" id="exampleInputEmail1" name="hinhanh">
			        <?php if(isset($error['hinhanh'])): ?>
			        	<p class="text-danger"> <?php echo $error['hinhanh'] ?> </p>	
			        <?php endif?>
					<img src="<?php echo uploads() ?><?php echo $editproduct['hinhanh'] ?>" width="50px" height="50px">
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Giá</label>
			        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="9.000.000" name="gia" value="<?php echo $editproduct['gia'] ?>">
			        <?php if(isset($error['gia'])): ?>
			        	<p class="text-danger"> <?php echo $error['gia'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Số lượng</label>
			        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="0" name="soluong" value="<?php echo $editproduct['soluong'] ?>">
			        <?php if(isset($error['soluong'])): ?>
			        	<p class="text-danger"> <?php echo $error['soluong'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Mô tả ngắn</label>
			        <textarea class="form-control" name="motangan" id="" rows="4" ><?php echo $editproduct['motangan'] ?></textarea>
			        <?php if(isset($error['motangan'])): ?>
			        	<p class="text-danger"> <?php echo $error['motangan'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Mô tả dài</label>
			        <textarea class="form-control" name="motadai" id="" rows="4" ><?php echo $editproduct['motadai'] ?></textarea>
			        <?php if(isset($error['motadai'])): ?>
			        	<p class="text-danger"> <?php echo $error['motadai'] ?> </p>	
			        <?php endif?>
			        
			    </div>

			    <div class="form-group col-sm-8">
			        <label for="exampleInputEmail1">Trạng thái</label>
			        <select class="form-control col-md-8" name="trangthai" id="">
			        	<?php if($editproduct['trangthai'] == 1) 
			        	{
			        	?>
			        		<option value="0">Ngưng Bán</option>
			        		<option value="1" selected="">Đang Bán</option>
			        	<?php }else{
			        		?>
							<option value="0" selected="">Ngưng Bán</option>
			        		<option value="1" >Đang Bán</option>
			        		<?php
			        	} ?>

			        	
			        	
			        </select>
			        <?php if(isset($error['trangthai'])): ?>
			        	<p class="text-danger"> <?php echo $error['trangthai'] ?> </p>	
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