<?php
include "../../connection.php";
include "header_and_footer/header_and_footer.php";
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
				.table_div{
					overflow: auto;
				}
		</style>
</head>
<body>
	<!-- Dashboard Main Content -->
	<div class="row">
		<div class="col-sm-1" style="z-index:1;">
			<div style="position:fixed;">
				<?php echo get_html("navigation");?>
			</div>
		</div>
		<div class="col-sm-11 gy-3 gx-5">
				<button class="btn btn-warning" id="post_toggler" current-toggle="add" style=" margin:5px; width:100%;">View Result</button>
				<div id="add_post"><br>
					<form class="border-primary card post_form"  style=" margin: auto; max-width:500px;" method="post" action=""  enctype="multipart/form-data">
						<label class="form-label">Post Category</label>
						<select id="selection" class="form-select form-select-md border-primary gx-5 mb-3" name="post_type">
							<option value="news">News</option>
							<option value="notice">Notice</option>
							<option value="document">Documents</option>
						</select>
						<div class="mb-3">
							<label class="form-label">Title</label>
							<input type="text" placeholder="Something..." class="form-control form-control-md border-primary" name="title">
						</div>


						<div class="news_section" id="news_section">
								<div class="mb-3">
									<label for="formFileSm" class="form-label">Post Description</label>
									<textarea name="news_content" class="form-control border-primary form-control-sm" id="formFileSm"></textarea>
								</div>
								<div class="mb-3">
									<label for="thumbnail" class="form-label">Thumbnail (JPEG)</label>
									<input name="thumbnail" class="form-control border-primary form-control-sm" id="thumbnail" accept="image/*" type="file">
								</div>
						</div>

						<div style="display:none;" class="document_section" id="document_section">
							<div class="mb-3">
									<label for="formFileSm" class="form-label">Files</label>
									<input name="document_file[]" multiple class="form-control border-primary form-control-sm" id="formFileSm" type="file">
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
					 		<form class="controls_container row gx-1" style="margin-bottom:3px; margin-top:-15px;" method="post">
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
					 		</form>
					 		<div class="table_div">
							  	<div id="news_div">
							  		<table cellspacing="0" cellpadding="0" style="margin:auto; width:100%;" id="news_row">
							  		</table><br>
							  	</div>
							  	<div id="notice_div">
							  		<table cellspacing="0" cellpadding="0" style="margin:auto; width:100%;" id="notice_row">
							  		</table>
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
<?php
if(array_key_exists("create_post",$_POST)){
	$target_dir = "../../uploads/";
	$post_type = $_POST['post_type'];
	$title = $_POST['title'];
	$date = date("y-m-d");
	$news_content = $_POST['news_content'];
	if(empty($title)){
		display_message("Please Enter Title");
	}
	if($post_type == "news" || $post_type=="notice"){
		$thumb_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['thumbnail']['name'];
		$thumb_tmp_name = $_FILES['thumbnail']['tmp_name'];
		$thumb_type = $_FILES['thumbnail']['type'];

		if(empty($_POST['news_content'])){
			display_message("Description is empty");
		}else{
			// Uploading only jpg images files
			if($thumb_type=="image/jpeg" || $thumb_type=="image/png"){
				move_uploaded_file($thumb_tmp_name, $target_dir."images/".$thumb_name);
				$sql = "INSERT INTO news (title, src, thumbnail, upload_date, type) VALUES ('$title','$news_content','$thumb_name','$date','$post_type');";
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
	};
	if($post_type=="document"){
		// uploading each files into server folder
		foreach ($_FILES["document_file"]["tmp_name"] as $key => $value) {
			$file_tmpname = $_FILES['document_file']['tmp_name'][$key];
            $file_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['document_file']['name'][$key];
            $file_type = $_FILES['document_file']['type'][$key];
            $allowed_file_type = $file_type=="application/pdf";
            $error = 0;
            if($allowed_file_type){
            	$target_dir = "../../uploads/documents/";
            	if(!move_uploaded_file($file_tmpname, $target_dir.$file_name)){
            		display_message("Can't upload".$_FILES["document_file"]["name"][$key]);
            		$error++;
            	}else{
            		$sql = "INSERT INTO documents (doc_title, doc_file, upload_date) VALUES ('$title','$file_name','$date')";
            		$result = mysqli_query($conn, $sql);
            		if(!$result){
            			$error++;
            		}
            	}
            }else{
            	display_message($_FILES['document_file']['name'][$key]." is not pdf file ");
            	$error++;
            };

            if($error==0){
            	display_message("Successfully Uploaded all files");
            }else{
            	display_message($error." Files can't upload due to error");
            }
		}
	}
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

	$("#notice_section").hide();
	$("#document_section").hide();
	$("#view_post").hide();
	$("#post_view_spinner").hide();

	$(document).ready(function (){
	// Setting default values
	var limit_value = 10;
	var sort_value = "DESC";
	var search_value = "";
	var data_view_mode = "news";

	    function loadrows(type, sort_val, limit_val,search_for){// This will load data with limit
	      $.ajax({
	        url : "header_and_footer/data_loader.php",
	        type : "POST",
	        data : {type : type, sort : sort_val, limit : limit_val, sr_for : search_for},
	        beforeSend : function(){
	        	$("#post_view_spinner").show();
	        },
	        success: function(data){
	          if(type=="news"){
	            $("#news_row").html(data);
	          }else if(type=="notice"){
	          	$("#notice_row").html(data);
	          }else if(type=="document"){
	          	$("#document_row").html(data);
	          }
	        },
	        complete: function(){
	        	$("#post_view_spinner").hide();
	        }
	      })
	    }
	    loadrows(data_view_mode,sort_value,limit_value,search_value);
	    $("#limit").on("input",function (){// This will execute when putting values on limit
	    	limit_value = $("#limit").val();
	    	if(limit_value == ""){
	    		limit_value = 10;
	    	}
	    	loadrows(data_view_mode, sort_value, limit_value,search_value);
	    });
	    $("#sort").on("change",function (){// This will execute when choosing values on sort
	    	sort_value = $("#sort").val();
	    	loadrows(data_view_mode, sort_value, limit_value,search_value);
	    });
	    $("#search_bar").on("input",function(){
	    	var search_key = $("#search_bar").val();
	    	if(search_key==""){
	    		search_value = "%";
	    	}else{
	    		search_value = "%"+search_key+"%";
	    	}
	    	loadrows(data_view_mode, sort_value, limit_value, search_value);
	    })


		$("#selection").on("change",function(){//For Post category selection dropdown
			var selected_item = $("#selection").val();
			if(selected_item=="news" || selected_item=="notice"){
				$("#news_section").show();
				$("#document_section").hide();
			}else if(selected_item=="document"){
				$("#document_section").show();
				$("#news_section").hide();
			};
		});


		// Data view and add button toggler
		var view_div = document.getElementById("view_post");
		var add_div = document.getElementById("add_post");
		var btn_toggler = document.getElementById("post_toggler");
		btn_toggler.addEventListener("click",()=>{
			var current_mode = btn_toggler.getAttribute("current-toggle");
			if(current_mode=="add"){
				btn_toggler.innerHTML = "New Post";
				btn_toggler.setAttribute("current-toggle","show");
				view_div.style.display = "";
				add_div.style.display = "none";
			}else if(current_mode=="show"){
				btn_toggler.innerHTML = "View Post";
				btn_toggler.setAttribute("current-toggle","add");
				add_div.style.display = "";
				view_div.style.display = "none";
			}
		});
		// News, Notice and Download toggler
		$("#notice_div").hide();
		$("#document_div").hide();
		$("#news_view_btn").attr("class","nav-link active bg-primary text-white");
		$("#news_view_btn").on("click",function (){
			data_view_mode = "news";
			limit_value = 10;
			search_value = "%";
			$("#news_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#document_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link");
			$("#notice_div").hide();
			$("#document_div").hide();
			$("#news_div").show();
		    loadrows(data_view_mode,sort_value,limit_value,search_value);
		});
		$("#notice_view_btn").on("click",function (){
			data_view_mode = "notice";
			limit_value = 10;
			search_value = "%";
			$("#news_view_btn").attr("class","nav-link");
			$("#document_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#news_div").hide();
			$("#document_div").hide();
			$("#notice_div").show();
		    loadrows(data_view_mode,sort_value,limit_value,search_value);
		});
		$("#document_view_btn").on("click",function (){
			data_view_mode = "document";
			limit_value = 10;
			search_value = "%";
			$("#document_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#news_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link");
			$("#notice_div").hide();
			$("#news_div").hide();
			$("#document_div").show();
			loadrows(data_view_mode,sort_value,limit_value,search_value);
		});
	});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>