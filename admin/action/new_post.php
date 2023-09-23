<?php
include "../../connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Post | Admin</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../styles/style.css">
		<link rel="icon" href="../../images/slogo.png">
		<style>
				.post_form{
					padding: 10px;
					box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
				}


				.admin_nav{
					max-width:100%; 
					max-height: 50px;
					border:1px solid lightgrey;
					position: fixed;
					bottom: 0px;
					margin: auto;
					border-radius: 10px;
					box-shadow: black 8px 8px 30px 0px;
				}
				.admin_nav a{
					padding: 10px;
				}
				.my_badge{
					position: absolute;
					top: 0px;
				}
		</style>
</head>
<body>
	<!-- Dashboard Main Content -->
	<div class="row">
		<div class="d-flex justify-content-center col col-md-12">
			<div class="main_content">
				<button class="btn btn-warning w-100">View Post</button>
				<form class="border-primary d-flex justify-content-center card post_form" style=" margin-top:20px;" method="post" action=""  enctype="multipart/form-data">
					<select id="selection" onchange="select_post_type()" class="form-select form-select-md border-primary gx-5 mb-3" name="post_type">
						<option value="news">News</option>
						<option value="notice">Notice</option>
						<option value="document">Documents</option>
					</select>
					<div class="mb-3">
						<label class="form-label">Title</label>
						<input type="text" placeholder="Something..." class="form-control form-control-md border-primary" name="title" required>
					</div>


					<div class="news_section" id="news_section">
							<div class="mb-3">
								<label for="formFileSm" class="form-label">Content File (PDF)</label>
								<input name="content_file" class="form-control border-primary form-control-sm" id="formFileSm" type="file" required>
							</div>
							<div class="mb-3">
								<label for="thumbnail" class="form-label">Thumbnail (JPEG)</label>
								<input name="thumbnail" class="form-control border-primary form-control-sm" id="thumbnail" type="file" required>
							</div>
					</div>

					<div style="display:none;" class="document_section" id="document_section">
						<div class="row row-cols-1 row-cols-md-4" style="margin-left:5px;">
								<div class="form-check ">
									<input class="form-check-input" value="pdf" type="radio" name="document_type" id="pdf">
									<label class="form-check-label" for="pdf">
										PDF
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" value="image" type="radio" name="document_type" id="images" checked>
									<label class="form-check-label" for="images">
										Images
									</label>
								</div>
						</div>
						<div class="mb-3">
								<label for="formFileSm" class="form-label">Content File </label>
								<input name="document_file" class="form-control border-primary form-control-sm" id="formFileSm" type="file">
						</div>
					</div>

					<div class="mb-3">
						<label for="date" class="form-label">Upload Date</label>
						<input type="date" name="date" class="form-control border-primary form-control-sm" id="date" required>
					</div>
					<input type="submit" name="create_post" value="Post" class="btn btn-primary">
				</form>
			</div>

			<!-- Navigation Model -->
			<div class="admin_nav d-flex justify-content-center">
				<a href="../index.php">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
						<path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
						<path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
					</svg>
				</a>
				<a href="new_post.php">
					<svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
						<path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
						<path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
					</svg>
				</a>
				<a href="messages.php">
					<svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
						<path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
					</svg>
					<span class="bg-info text-dark badge rounded-pill" style="postition:absolute; top:0px;">5</span>
				</a>
				<a href="publish_result.php">
					<svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
						<path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
					</svg>
				</a>
				<a href="new_admission.php">
					<svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
						<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
						<path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
					</svg>
					<span class="my_badge badge bg-info rounded-pill">14</span>
				</a>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
						<path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
						<path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
					</svg>
				</a>
				<a href="#">
					<svg  type="button" data-bs-toggle="modal" data-bs-target="#log_out_model" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
						<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
					</svg>
				</a>
			</div>
		</div>
	</div>


<?php
if(array_key_exists("create_post",$_POST)){
	$target_dir = "../../uploads/";
	$post_type = $_POST['post_type'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	if($post_type == "news" || $post_type=="notice"){
		$cont_f_name = $_FILES['content_file']['name'];
		$thumb_name = $_FILES['thumbnail']['name'];
		$cont_ftmp_name = $_FILES['content_file']['tmp_name'];
		$thumb_tmp_name = $_FILES['thumbnail']['tmp_name'];
		$cont_type = $_FILES['content_file']['type'];
		$thumb_type = $_FILES['thumbnail']['type'];

		// Uploading only pdf files for news and notice
		if($cont_type=="application/pdf"){
			move_uploaded_file($cont_ftmp_name,$target_dir."documents/".$cont_f_name);
			$sql = "INSERT INTO news (title, src, thumbnail, upload_date, type) VALUES ('$title','$cont_f_name','$thumb_name','$date','$post_type');";
			$result = mysqli_query($conn, $sql);
		}
		// Uploading only jpg images files
		if($thumb_type=="image/jpeg"){
			move_uploaded_file($thumb_tmp_name, $target_dir."images/".$thumb_name);
		}
	}
}

?>

<!-- logout model -->
<div class="modal fade" id="log_out_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
	 <h1 class="modal-title fs-5" id="exampleModalLabel">Are you Sure you want to Log Out ?</h1>
	 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-footer">
	 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
	 <button type="button" class="btn btn-primary">Yes</button>
			</div>
		</div>
	</div>
</div>

<script>
	function select_post_type(){
		var selected_item = document.getElementById("selection");
		var news_section = document.getElementById("news_section");
		var docmt_section = document.getElementById("document_section");
		if(selected_item.value=="news" || selected_item.value=="notice"){
			news_section.style.display = "";
			docmt_section.style.display = "none";
		}else if(selected_item.value=="document"){
			news_section.style.display = "none";
			docmt_section.style.display = "";
		}
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>