<?php
	include "../../connection.php";
	include "header_and_footer/header_and_footer.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<title></title>
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
	?>
	<form class="border-primary card post_form"  style=" margin: auto; padding: 15px; margin-top: 5%; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Title</label>
							<input type="text" value="<?php echo $row['title'];?>" placeholder="Something..." class="form-control form-control-md border-primary" name="title" required>
						</div>
						<div class="news_section" id="news_section">
								<div class="mb-3">
									<label for="formFileSm" class="form-label">Post Description</label>
									<textarea name="news_content" class="form-control border-primary form-control-sm"  id="formFileSm" required><?php echo $row['src'];?></textarea>
								</div>
								<div class="mb-3">
									<label for="thumbnail" class="form-label">Thumbnail (JPEG)</label>
									<img src="../../uploads/images/<?php echo $row['thumbnail']?>" style="width:100%; margin-bottom:5px;">
									<input name="thumbnail" class="form-control border-primary form-control-sm" id="thumbnail" accept="image/*" type="file" required>
								</div>
						</div>

						<div class="col" style="padding:5px; display:flex;">
							<input type="submit" name="create_post" value="Post" class="col-sm-6 btn btn-primary gx-5">
							<a href="new_post.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
						</div>
	</form>
	<?php
		if(array_key_exists("create_post",$_POST)){
			$target_dir = "../../uploads/";
			$title = $_POST['title'];
			$date = date("y-m-d");
			$news_content = $_POST['news_content'];
			if($post_type == "news" || $post_type=="notice"){
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
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>