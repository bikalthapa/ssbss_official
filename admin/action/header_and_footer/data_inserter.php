<?php
include "../../../connection.php";
include "header_and_footer.php";
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
	}
}

echo $str;
?> 