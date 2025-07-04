<?php
	include "../../../script/php_scripts/database.php";
	include "../scripts/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<title>Delete Records</title>
	<style>
		th, td{
			border: 1px solid black;
		}
	</style>
</head>
<body>
<?php
if(isset($_GET["news_id"]) || isset($_GET["notice_id"])){
	if(isset($_GET['news_id'])){
		$id = $_GET['news_id'];
	}else if(isset($_GET['notice_id'])){
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
		<p class="display-6">Are you Sure you want to delete this record ?</p>
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td>News_id</td>
				<td>Title</td>
				<td>Description</td>
				<td>Upload Date</td>
			</tr>
			<tr>
				<td><?php echo $id?></td>
				<td><?php echo $row['title']?></td>
				<td><?php echo file_get_contents("../../../uploads/news_descr/".$row['src'])?></td>
				<td><?php echo $row['upload_date']?></td>
			</tr>
		</table>
						<div class="col" style="padding:5px; display:flex;">
							<input type="submit" name="delete_post" value="Delete" class="col-sm-6 btn btn-danger gx-5">
							<a href="new_post.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
						</div>
	</form>
	<?php
		if(array_key_exists("delete_post",$_POST)){
			unlink("../../../uploads/images/".$row['thumbnail']);
			unlink("../../../uploads/news_descr/".$row['src']);
			$sql = "DELETE FROM news WHERE news_id = $id";
			$result = mysqli_query($conn, $sql);
			if($result){
				header("location:new_post.php");
			}else{
				display_message("Can't Delete this record");
			}	
		}
}else if(isset($_GET["document_id"])){
	$id = $_GET["document_id"];
	$sql = "SELECT * FROM documents WHERE doc_id = $id";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)<=0){
		header("location:new_post.php");
	}else{
		$row = mysqli_fetch_assoc($result);
		$title = $row['doc_title'];
		$file_name = $row['doc_file'];
		$upload_date = $row['upload_date'];
		?>
		<form class="border-primary card post_form"  style=" margin: auto; padding: 15px; margin-top: 5%; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
			<p class="display-6">Are you Sure you want to delete this record ?</p>
			<table cellspacing="0" cellpadding="5">
				<tr>
					<td>Id</td>
					<td>Title</td>
					<td>Filename</td>
					<td>Upload Date</td>
				</tr>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $title; ?></td>
					<td><?php echo $file_name?></td>
					<td><?php echo $upload_date?></td>
				</tr>
			</table>
			<div class="col" style="padding:5px; display:flex;">
				<input type="submit" name="delete_document" value="Delete" class="col-sm-6 btn btn-danger gx-5">
				<a href="new_post.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
			</div>
		</form>
		<?php
		if(array_key_exists('delete_document', $_POST)){
			$sql = "DELETE FROM documents WHERE doc_id = $id";
			$result = mysqli_query($conn, $sql);
			unlink("../../uploads/documents/".$file_name);
			if($result){
				header("location:new_post.php");
			}else{
				display_message("Can't Delete this document");
			}
		}
	}
}else if(isset($_GET["rst_id"])){
	$id = $_GET["rst_id"];
	$sql = "SELECT * FROM class RIGHT JOIN result_files ON class.class_id = result_files.class_id WHERE result_files.rst_id = $id";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)<=0){
		header("location:publish_result.php");
	}
	$row = mysqli_fetch_assoc($result);
	?>
	<form class="border-primary card post_form"  style=" margin: auto; padding: 15px; margin-top: 5%; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
		<p class="display-6">Are you Sure you want to delete this record ?</p>
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td>rst_id</td>
				<td>Class</td>
				<td>Date</td>
			</tr>
			<tr>
				<td><?php echo $row['rst_id']?></td>
				<td><?php echo $row['class_name']?></td>
				<td><?php echo $row['published_date']?></td>
			</tr>
		</table>
						<div class="col" style="padding:5px; display:flex;">
							<input type="submit" name="delete_post" value="Delete" class="col-sm-6 btn btn-danger gx-5">
							<a href="publish_result.php" class="col-sm-6 gx-5 btn btn-primary">Cancel</a>
						</div>
	</form>
	<?php
		if(array_key_exists("delete_post",$_POST)){
			unlink("../../uploads/published_result/".$row['file_name']);
			$sql = "DELETE FROM result_files WHERE rst_id = $id";
			$result = mysqli_query($conn, $sql);
			if($result){
				header("location:publish_result.php");
			}else{
				display_message("Can't Delete this record");
			}	
		}
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>