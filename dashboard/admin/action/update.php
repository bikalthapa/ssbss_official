<?php
	include "../../../script/php_scripts/database.php";
	include "../scripts/php_scripts/header_and_footer.php";
	include "../scripts/php_scripts/logout.php";
	is_login("../../authentication/index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<title></title>
	<style>
		.inner_img{
			max-height: 290px;
			margin-left: 0px;
			position: absolute;
			left: -20px;
		}
		.outer_img_div{
			min-height: 200px;
			border: 1px solid black;
			overflow: hidden;
			position: relative;
		}
		input[type=file]::file-selector-button {

		}
	</style>
</head>
<body>
<?php
if(isset($_GET["news_id"]) || isset($_GET['notice_id'])){
	if(isset($_GET['news_id'])){
		$post_type = "news";
		$id = $_GET['news_id'];
	}else if(isset($_GET['notice_id'])){
		$post_type = "notice";
		$id = $_GET['notice_id'];
	}
	$sql = "SELECT * FROM news WHERE news_id = $id";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)<=0){
		header("location:new_post.php");
	}
	$row = mysqli_fetch_assoc($result);
	// Retriving thumbnail from the database
	$img_sql = "SELECT * FROM news_img WHERE news_id = '$id'";
	$img_result = mysqli_query($conn,$img_sql);
	if($img_result){
		$image_container = " ";
		while($img_row = mysqli_fetch_assoc($img_result)){
			$image_container .= '<div class="col gx-5 outer_img_div">
									<img class="inner_img" src="../../uploads/images/'.$img_row["filename"].'">
								</div>';
		}
	}
	?>
	<form class="border-primary card post_form" id="news_update_form" style=" margin: auto; padding: 15px; margin-top:10px; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
		<label class="form-label">Post Category</label>
		<select id="selection" class="form-select form-select-md border-primary gx-5 mb-3" name="post_type">
			<option value="news">News</option>
			<option value="notice">Notice</option>
		</select>
		<div class="mb-3">
			<label for="title" class="form-label" id="titleHelp">Title</label>
			<input type="text" placeholder="Something..." value="<?php echo $row['title'];?>" describeby="titleHelp" class="form-control form-control-md border-primary post_inputs" id="title" name="title">
		</div>
		<div class="news_section" id="news_section">
			<div class="mb-3">
				<label for="description" id="descriptionHelp" class="form-label">Post Description</label>
				<textarea name="news_content" class="form-control border-primary form-control-sm  post_inputs" id="description" describeby="descriptionHelp">
					<?php echo file_get_contents("../../uploads/news_descr/".$row['src'])?>
				</textarea>
			</div>
			<div class="mb-3">
				<label for="thumbnail" id="thumbnailHelp" class="form-label">Thumbnail (JPEG)</label>
				<input name="thumbnail" class="form-control border-primary form-control-sm  post_inputs" id="thumbnail" describeby="thumbnailHelp" accept="image/*" type="file">
			</div>
			<div id="thumbPreview" class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
				<div class='col gx-5 outer_img_div'>
					<img class='inner_img' src='../../uploads/images/<?php echo $row['thumbnail']?>'>
				</div>
			</div>
			<div class="mb-3">
				<label for="image" id="imageHelp" class="form-label">Related Images (JPEG)</label>
				<input name="image[]" class="form-control border-primary form-control-sm  post_inputs" id="image" multiple describeby="imageHelp" accept="image/*" type="file">
			</div>
			<div id="imgPreview" class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
				<?php echo $image_container; ?>
			</div>
		</div>
		<div class="col" style="padding:5px; display:flex;">
			<input type="submit" name="update_document" value="Update" class="col-sm-6 btn btn-primary gx-5">
			<a href="new_post.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
		</div>
	</form>
	
	<?php
		if(array_key_exists("update_document",$_POST)){
			$target_dir = "../../uploads/";
			$title = $_POST['title'];
			$date = date("y-m-d");
			$news_content = $_POST['news_content'];
			if($post_type == "news" || $post_type=="notice"){
				if(isset($_FILES['thumbnail'])){// Uploading thumbnail only if it set
					$thumb_name = $_FILES['thumbnail']['name'].rand(1,10000)." ".date("y-m-d-h-s");
					$thumb_tmp_name = $_FILES['thumbnail']['tmp_name'];
					$thumb_type = $_FILES['thumbnail']['type'];
					// Uploading only jpg images files
					if($thumb_type=="image/jpeg" || $thumb_type=="image/png"){
						// Updating file
						move_uploaded_file($thumb_tmp_name, $target_dir."images/".$thumb_name);
						$sql = "UPDATE news SET title = '$title', src = '$news_content', thumbnail = '$thumb_name', upload_date = '$date', type = '$post_type' WHERE news_id = $id;";
						$result = mysqli_query($conn, $sql);
						if($result){
							display_message($post_type." successfully Update !");
							header("location:new_post.php");
						}else{
							display_message($post_type." can't update");
						}
					}else{
						display_message("Your thumbnail must be in jpeg or png format");
					}
				}
				
				$related_img = $_FILES['image'];
				if(isset($related_img)){//Uploading related image if only it is set
					foreach ($related_img["tmp_name"] as $key => $value) {
						$file_tmp_name = $value;
						$file_name = rand(1,10000)." rt_img ".date("y-m-d-h-s").$related_img['name'][$key];
						$file_type = $related_img['type'][$key];
						// Uploading only jpg images files
						if($file_type=="image/jpeg" || $file_type=="image/png"){
							move_uploaded_file($file_tmp_name, $target_dir."images/".$file_name);
							$sql = "INSERT INTO news_img (filename, news_id) VALUES ('$file_name','$id');";
							$result = mysqli_query($conn, $sql);
							if($result){
								display_message($post_type." successfully uploaded !");
							}else{
								display_message($post_type." can't upload");
							}
						}else{
							display_message("Your thumbnail must be in jpeg or png format");
						}
					}
				}
			}
		}
}else if(isset($_GET["document_id"])){
	$id = $_GET['document_id'];
	$sql = "SELECT * FROM documents WHERE doc_id = $id";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)<=0){
		header("location:new_post.php");
	}else{
		$row = mysqli_fetch_assoc($result);
		$title = $row['doc_title'];
		$file_name = $row['doc_file'];
		$going_to_delete = $file_name;
		$upload_date = $row['upload_date'];
	}
	?>
	<form class="border-primary card post_form"  style=" margin: auto; padding: 15px; margin-top: 5%; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Title</label>
							<input type="text" value="<?php echo $title;?>" placeholder="Something..." class="form-control form-control-md border-primary" name="title">
						</div>
						<div class="news_section">
								<div class="mb-3">
									<label for="thumbnail" class="form-label">File<br><?php echo $file_name;?></label>
									<iframe src="../../uploads/documents/<?php echo $file_name;?>" style="width:100%; margin-bottom:5px;"></iframe>
									<input name="document_file" class="form-control border-primary form-control-sm" id="thumbnail" accept=".pdf" type="file">
								</div>
						</div>

						<div class="col" style="padding:5px; display:flex;">
							<input type="submit" name="update_document" value="Update" class="col-sm-6 btn btn-primary gx-5">
							<a href="new_post.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
						</div>
	</form>
	<?php
	if (array_key_exists("update_document",$_POST)){
		if(empty($_POST['title'])){
			display_message("Please Enter title");
		}else{
			$title = $_POST['title'];
			$file = $_FILES['document_file'];
			$date = date("y-m-d");
			if(empty($file)){
				$sql = "UPDATE documents SET doc_title = '$title', upload_date = '$date' WHERE doc_id = $id;";
				$result = mysqli_query($conn,$sql);
				if($result){
					header("location:new_post.php");
				}else{
					display_message("An error occur while updating data");
				}
			}else{
				$tmp_name = $_FILES['document_file']['tmp_name'];
				$file_type = $_FILES['document_file']['type'];
				$file_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['document_file']['name'];
				if($file_type=="application/pdf"){
					$target_dir = "../../uploads/documents/";
					move_uploaded_file($tmp_name, $target_dir.$file_name);
					$sql = "UPDATE documents SET doc_title = '$title', doc_file = '$file_name', upload_date = '$date' WHERE doc_id = $id";
					$result = mysqli_query($conn, $sql);
					unlink($target_dir.$going_to_delete);
					if($result){
						header("location:new_post.php");
					}else{
						display_message("An error Occur while updating data");
					}
				}else{
					display_message("Your File must be in PDF format");
				}
			}
		}
	}
}else if(isset($_GET["rst_id"])){
	?>
    	<form method="post" action="" id="result_form" enctype="multipart/form-data">
    		<!-- First Row -->
    		<div class="row">
    			<div class="col-sm-6 g-3">
    				<label class="form-label">Exam Title</label>
    				<div class="row">
    					<div class="col col-sm-9">
	    					<select class="form-select border-primary col-sm-9" name="exam_title">
	    						<option value="1">First Terminal Examination </option>
	    						<option value="2">Second Terminal Examination </option>
	    						<option value="3">Third Terminal Examination </option>
	    						<option value="4">Final Terminal Examination </option>
	    					</select>
    					</div>
    					<div class="col col-sm-3">
    						<input type="number" id="year" class="form-control border-primary" name="year" value="<?php echo date("y")+2057;?>">
    					</div>
    				</div>
					<div class="row">
						<div class="col g-3">
							<label class="form-label">Update File</label>
							<input type="file" name="csv_file[]" accept=".csv" class="form-control form-control-md border-primary" id="csv_file" multiple><br>
						</div>
						<div class="col g-3">
							<label class="form-label">Update Class</label>
							<select class="form-select border-primary">
							<?php
								$sql = "SELECT * FROM class;";
								$result = mysqli_query($conn, $sql);
								$classes = "<option value='0'>Choose Class</option>";
								if($result){
									while($row = mysqli_fetch_assoc($result)){
										$classname = $row['class_name'];
										$id = $row['class_id'];
										echo "<option value=\"$id\">$classname</option>";
									}
								}
							?>
							</select>
						</div>
					</div>
					<div class="row">
						<input class="btn btn-primary w-100 col col-sm-6" type="submit" id="publish_result" name="publish_result" value="Publish Result">
						<input class="btn btn-primary w-100 col col-sm-6" type="submit" id="publish_result" name="publish_result" value="Publish Result">
					</div>
    			</div>
    		</div><br>
    		<!-- Second Row //  Class Name and section choosing section-->

    	</form>
	<?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>