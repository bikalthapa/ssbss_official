<?php
include "../../../script/php_scripts/database.php";
include "../scripts/php_scripts/header_and_footer.php";
$str = " ";

if(isset($_GET['mode'])){// Mode is set
	if($_GET['mode']=="result_publish"){
		// Form Data
		$term = $_POST['exam_title'];
		$file = $_FILES['csv_file'];
		$template_type = $_POST['template_type'];
		$year = $_POST['year'];
		$date = date("y-m-d");
		$target_dir = "../../../uploads/published_result/";

		if($template_type=="default"){
			foreach ($_FILES['csv_file']['tmp_name'] as $key => $value){// Visiting each files
			    $name = rand(1,10000)." ".date("y-m-d-h-s")." ".$_FILES['csv_file']['name'][$key];
			    $temp_name = $_FILES['csv_file']['tmp_name'][$key];
			    $class_id = $_POST['grade_selection'][$key];

				$sql = "INSERT INTO result_files (file_name, class_id, term, published_year,published_date) VALUES ('$name','$class_id','$term','$year','$date')";
				move_uploaded_file($temp_name, $target_dir.$name);
				$result = mysqli_query($conn, $sql);
				if($result){// Insertion successfull
					$str .= $_FILES['csv_file']['name'][$key]." Added Successfully";
				}else{// insertion failed
					$str .= "Data Insertion Failed.";
				}
			}

			if($str==" "){// Success message if str doesn't have error message
				$str = "Result Published Successfully !";
			}
		}
	}else if($_GET['mode']=="news_publish"){
		$target_dir = "../../../uploads/";
		$post_type = $_POST['post_type'];
		$title = $_POST['title'];
		$news_content = $_POST['news_content'];
		$thumbnail = $_FILES['thumbnail'];
		$related_img = $_FILES['image'];
		$date = date("y-m-d");
		if($post_type == "news" || $post_type=="notice"){
			$thumb_name = rand(1,10000)." ".date("y-m-d-h-s").$_FILES['thumbnail']['name'];
			$thumb_tmp_name = $_FILES['thumbnail']['tmp_name'];
			$thumb_type = $_FILES['thumbnail']['type'];

			if($thumb_type=="image/jpeg" || $thumb_type=="image/png"){
				move_uploaded_file($thumb_tmp_name, $target_dir."images/".$thumb_name);
				$description_file = rand(1,10000)." ndescr ".date("y-m-d-h-s").".txt";
				$myfile = fopen($target_dir."news_descr/".$description_file, "w");
				fwrite($myfile, $news_content);
				fclose($myfile);

				$sql = "INSERT INTO news (title, src, thumbnail,upload_date,type) VALUES ('$title','$description_file','$thumb_name','$date','$post_type');";
				$result = mysqli_query($conn, $sql);
				if($result){
					$sql = "SELECT MAX(news_id) FROM news;";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					$id = $row['MAX(news_id)'];
				}
			}

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
	}else if($_GET['mode']=="message_send"){
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$message = mysqli_real_escape_string($conn,$_POST['message']);
		echo $name;
	}
}

echo $str;
?> 