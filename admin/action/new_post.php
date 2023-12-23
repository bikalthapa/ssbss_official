<?php
include "../../connection.php";
include "header_and_footer/header_and_footer.php";
include "../scripts/php_scripts/logout.php";
is_login("../../authentication/index.php");
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
				body{
					max-height:150vh;
				}
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
    				top: 7px;
    				right: 3px;
				}
				td,th{
					border: 1px solid black;
					padding: 2px;
				}
				.outer_img_div{
					min-height: 200px;
					border: 1px solid black;
					overflow: hidden;
					position: relative;
				}
				.inner_img{
					max-height: 290px;
					margin-left: 0px;
					position: absolute;
					left: -20px;
				}
				.thumbnail_checkbox{
					position: absolute;
					top: 5px;
					left: 5px;
				}
				.news_img_carousel{
					max-height:200px;
				}
		</style>
</head>
<body>
	<!-- Dashboard Main Content -->
<div class="mb-3" style="max-width: 100%; padding:10px;">
	<div class="row">
		<div class="col-sm-1" style="z-index:1;  max-width:5%;">
			<div style="position:fixed;">
				<?php echo get_html("navigation","inside_action");?>
			</div>
		</div>
		<div class="col-sm-11 gy-3 gx-5">
				<button class="btn btn-warning" id="post_toggler" current-toggle="add" style=" margin:5px; width:100%;">View Result</button>
				<div id="add_post"><br>
					<form class="border-primary card post_form" id="new_post_form"  style=" margin: auto; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
						<label class="form-label">Post Category</label>
						<select id="selection" class="form-select form-select-md border-primary gx-5 mb-3" name="post_type">
							<option value="news">News</option>
							<option value="notice">Notice</option>
							<option value="document">Documents</option>
						</select>
						<div class="mb-3">
							<label for="title" class="form-label" id="titleHelp">Title</label>
							<input type="text" placeholder="Something..." describeby="titleHelp" class="form-control form-control-md border-primary post_inputs" id="title" name="title">
						</div>


						<div class="news_section" id="news_section">
								<div class="mb-3">
									<label for="description" id="descriptionHelp" class="form-label">Post Description</label>
									<textarea name="news_content" class="form-control border-primary form-control-sm  post_inputs" id="description" describeby="descriptionHelp"></textarea>
								</div>
								<div class="mb-3">
									<label for="thumbnail" id="thumbnailHelp" class="form-label">Thumbnail (JPEG)</label>
									<input name="thumbnail" class="form-control border-primary form-control-sm  post_inputs" id="thumbnail" describeby="thumbnailHelp" accept="image/*" type="file">
								</div>
								<div id="thumbPreview" class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
								</div>
								<div class="mb-3">
									<label for="image" id="imageHelp" class="form-label">Related Images (JPEG)</label>
									<input name="image[]" class="form-control border-primary form-control-sm  post_inputs" id="image" multiple describeby="imageHelp" accept="image/*" type="file">
								</div>
								<div id="imgPreview" class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
								</div>
						</div>

						<div style="display:none;" class="document_section" id="document_section">
							<div class="mb-3">
									<label for="document" id="documentHelp" class="form-label">Files</label>
									<input name="document_file[]" multiple class="form-control border-primary form-control-sm  post_inputs" id="document" describeby="documentHelp" type="file">
							</div>
						</div>
						<input type="submit" name="create_post" value="Post" class="btn btn-primary">
					</form>
				</div>
				<div id="view_post">
					<div class="card text-center border-primary">
					  	<div class="card-header">
						    <ul class="nav nav-tabs card-header-tabs">
						      <li class="nav-item">
						        <button class="nav-link" aria-current="true" id="news_view_btn">News</button>
						      </li>
						      <li class="nav-item">
						        <button class="nav-link" id="notice_view_btn">Notice</button>
						      </li>
						      <li class="nav-item">
						        <button class="nav-link" id="document_view_btn">Document</button>
						      </li>
						    </ul>
						</div>
					 	<div class="card-body">
					 		<form class="controls_container row gx-1" style="margin-bottom:3px; margin-top:-15px;" method="post" action="">
					 			<div class="limit col-sm-2 gy-1">
					 				<input type="number" class="form-control border-primary" placeholder="Limit" id="limit">
					 			</div>
					 			<div class="short_by col-sm-2 gy-1">
					 				<select class="form-control border-primary" id="sort">
					 					<option value="DESC">Order By Desc</option>
					 					<option value="ASC">Order By Asc</option>
					 				</select>
					 			</div>
					 			<div class="search col-sm-2 gy-1">
				                    <input class="form-control me-2 border-primary dropdown-toggle" required name="search" type="search" placeholder="Search" aria-label="Search" id="search_bar">
					 			</div>
					 		</form><br>
					 		<div class="table_div">
							  	<div id="news_div">
									<div id="news_row" class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center align-items-center">
									</div>
							  	</div>
							  	<div id="notice_div">
									<div id="notice_row" class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center align-items-center">
									</div>
							  	</div>
							  	<div id="document_div">
							  		<table cellspacing="0" cellpadding="0" style="margin:auto; width:100%;" id="document_row">
							  		</table>
						  		</div>
					  		</div>
						  	<!-- Loader -->
							<div class="d-flex justify-content-center">
								<div class="spinner-border" role="status" id="post_view_spinner">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>
					  	</div>
					</div>
				</div>
		</div>
	</div>
</div>

<?php
// echo "Hello"readfile("../../uploads/news_descr/9849 ndescr 23-12-09-11-10.txt");
	// if(array_key_exists("create_post",$_POST)){
	// 	$target_dir = "../../uploads/";
	// 	$post_type = $_POST['post_type'];
	// 	$title = $_POST['title'];
	// 	$date = date("y-m-d");
	// 	$news_content = $_POST['news_content'];
	// 	if(empty($title)){
	// 		display_message("Please Enter Title");
	// 	}
	// 	if($post_type == "news" || $post_type=="notice"){
	// 		$thumb_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['thumbnail']['name'];
	// 		$thumb_tmp_name = $_FILES['thumbnail']['tmp_name'];
	// 		$thumb_type = $_FILES['thumbnail']['type'];

	// 		if(empty($_POST['news_content'])){
	// 			display_message("Description is empty");
	// 		}else{
	// 			// Uploading only jpg images files
	// 			if($thumb_type=="image/jpeg" || $thumb_type=="image/png"){
	// 				move_uploaded_file($thumb_tmp_name, $target_dir."images/".$thumb_name);
	// 				$sql = "INSERT INTO news (title, src, thumbnail, upload_date, type) VALUES ('$title','$news_content','$thumb_name','$date','$post_type');";
	// 				$result = mysqli_query($conn, $sql);
	// 				if($result){
	// 					display_message($post_type." successfully uploaded !");
	// 				}else{
	// 					display_message($post_type." can't upload");
	// 				}
	// 			}else{
	// 				display_message("Your thumbnail must be in jpeg or png format");
	// 			}
	// 		}
	// 	};
	// 	if($post_type=="document"){
	// 		// uploading each files into server folder
	// 		foreach ($_FILES["document_file"]["tmp_name"] as $key => $value) {
	// 			$file_tmpname = $_FILES['document_file']['tmp_name'][$key];
	//             $file_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['document_file']['name'][$key];
	//             $file_type = $_FILES['document_file']['type'][$key];
	//             $allowed_file_type = $file_type=="application/pdf";
	//             $error = 0;
	//             if($allowed_file_type){
	//             	$target_dir = "../../uploads/documents/";
	//             	if(!move_uploaded_file($file_tmpname, $target_dir.$file_name)){
	//             		display_message("Can't upload".$_FILES["document_file"]["name"][$key]);
	//             		$error++;
	//             	}else{
	//             		$sql = "INSERT INTO documents (doc_title, doc_file, upload_date) VALUES ('$title','$file_name','$date')";
	//             		$result = mysqli_query($conn, $sql);
	//             		if(!$result){
	//             			$error++;
	//             		}
	//             	}
	//             }else{
	//             	display_message($_FILES['document_file']['name'][$key]." is not pdf file ");
	//             	$error++;
	//             };

	//             if($error==0){
	//             	display_message("Successfully Uploaded all files");
	//             }else{
	//             	display_message($error." Files can't upload due to error");
	//             }
	// 		}
	// 	}
	// }
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../scripts/each_file_js/new_post.js"></script>
<script>
	$(document).ready(()=>{
		function validate_inputs(input,description){
			if(input.val()==""){
				input.addClass(" border-danger");
				description.addClass(" text-danger");
				description.attr("description",description.html());
				description.html("Fields Required");
				return false;
			}
			return true;
		}
	    function descr_of(input_field){
	        var attr = input_field.attr("describeby");
	        return $("#"+attr);
	    }
	    function validate_files(file_field,center_of_display){
	        var error_count = 0;
	        var files_length = file_field[0].files.length;
	        var file_list = file_field[0].files;
	        var allowed_format = ["image/jpeg", "image/png"];
	            if(files_length!=0){
	            	var new_id;
	            	document.getElementById(center_of_display).innerHTML = "";
	            	for(i=0; i<files_length; i++){
	            		if(allowed_format.includes(file_list[i].type)){
					        if (file_list[i]){
					          let reader = new FileReader();
					          reader.onload = function(event){
					       		document.getElementById(center_of_display).innerHTML += `
										<div class='col gx-5 outer_img_div'>
												<img class=' inner_img' src='`+event.target.result+`'>
										</div>`;
					          }
					          reader.readAsDataURL(file_list[i]);
					        }
	            		}else{
	            			error_count++;
	            		}
	            	}
	            }else{
	                error_count++;
	            }
	        if(error_count==0){
	            return true;
	        }
	        return false;
	    }
		var post_inputs = document.getElementsByClassName("post_inputs");
	    for(post_input of post_inputs){
	        post_input.addEventListener("input",(e)=>{
	            var choosen_element = $("#"+e.target.id);
	            if(choosen_element.hasClass("border-danger") && choosen_element.val()!=""){
	            	choosen_element.removeClass("border-danger");
	            	var description = descr_of(choosen_element);
	            	description.removeClass(" text-danger");
	            	description.html(description.attr("description"));
	            }
	        });
	    };
	    $("#image").on("change",function(){
	    	validate_files($("#image"),"imgPreview");
	    });
	    $("#thumbnail").on("change",function(){
	    	validate_files($("#thumbnail"),"thumbPreview");
	    });
	$("#new_post_form").on("submit",function(e){
		e.preventDefault();
		var post_category = $("#selection").val();
		var title_validate = validate_inputs($("#title"),$("#titleHelp"));
		if(post_category=="news" || post_category=="notice"){
			var desc_validation = validate_inputs($("#description"),$("#descriptionHelp"));
			var thumb_validation = validate_inputs($("#thumbnail"),$("#thumbnailHelp"));
			var img_validation = validate_inputs($("#image"),$("#imageHelp"));
			if(desc_validation && thumb_validation && img_validation&&title_validate){
				$.ajax({
					url:"header_and_footer/data_inserter.php?mode=news_publish",
					type:"POST",
					data:new FormData(this),
					contentType: false,
					cache:false,
					processData:false,
					success:function(data){
							alert(data);
					}	
				});
			}else{
				alert("Some Error Occur In Your input");
			}
		}else if(post_category=="document"){
			var docmt_validation = validate_inputs($("#document"),$("#documentHelp"));
		}
	});
	// This function is used to logout from admin panel
		$("#log_out_btn_off_canvas , #log_out_btn_nav").click(function(){
			var confirmation = confirm("Are you sure you want to log out");
			if(confirmation==true){// Admin can be log out
				$.ajax({
					url:"../scripts/php_scripts/logout.php",
					type:"POST",
					data: {logout:"true"},
					success: function(result){
						if(result=="logout_success"){
							window.location.replace("../../authentication/index.php");
						}
					}
				});
			}
		});
	});
</script>
<script src="../scripts/javascripts/header_and_footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>