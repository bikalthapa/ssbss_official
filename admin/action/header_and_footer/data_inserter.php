<?php
include "../../../connection.php";
include "header_and_footer.php";
$str = " ";
if(isset($_GET['mode'])){// Mode is set

	if($_GET['mode']=="result"){// Mode is result => Result publication

		// Form Data
		$exam_title = $_POST['exam_title'];
		$file = $_FILES['csv_file'];
		$files_unity = $_POST['file_unity'];
		$template_type = $_POST['template_type'];

		if($files_unity=="same" && $template_type=="default"){// Default template having all files same

			foreach ($_FILES['csv_file']['tmp_name'] as $key => $value){// Visiting each files
			    $name = rand(1,10000)." ".date("y-m-d-h-s")." ".$_FILES['csv_file']['name'][$key];
			    $temp_name = $_FILES['csv_file']['tmp_name'][$key];
			    $target_dir = "../../../uploads/published_result/";
			    $file_extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));
			    $class_id = $_POST['grade_selection'][$key];
			    $section_id = $_POST['section_selection'][$key];
			    $date = $_POST['year'];
			    $config_file = "default.xml";

			    $section_sql = "SELECT * FROM class_section WHERE class_id = $class_id";
			    $result = mysqli_query($conn,$section_sql);
			    if(mysqli_num_rows($result)>0){// Chosen class have section //
					$sql = "INSERT INTO result_files (file_name, class_id, section_id, config_file_name,published_date) VALUES ('$name','$class_id','$section_id','$config_file','$date')";
					move_uploaded_file($temp_name, $target_dir.$name);
					$result = mysqli_query($conn, $sql);
					if(!$result){// Insertion Failed
						$str .= "Data Insertion Failed.";
					}
				}else{// Choosen class doesn't have section
					$sql = "INSERT INTO result_files (file_name, class_id, config_file_name,published_date) VALUES ('$name','$class_id','$config_file','$date')";
					move_uploaded_file($temp_name, $target_dir.$name);
					$result = mysqli_query($conn, $sql);
				}
			}

			if($str==" "){// Success message if str doesn't have error message
				$str = "Result Published Successfully !";
			}
		}else{// Custom template

		}
	}else if($_GET['mode']=="result_validation"){// Result class and section validation
		foreach($_FILES['csv_file']['name'] as $key => $value){
			$class_id = $_POST['grade_selection'][$key];
			$section_id = $_POST['section_selection'][$key];
			if($class_id!=0){// Class is choosen
			    $section_sql = "SELECT * FROM class_section WHERE class_id = $class_id";
			    $result = mysqli_query($conn,$section_sql);
			    if(mysqli_num_rows($result)>0){//Section exists
			    	if($section_id==0){
			    		$str .= "Section is not choosen for ".$_FILES['csv_file']['name'][$key]."<br>";
			    	}
			    }
			}else{// Class is not choosen
				$str.= "Class is not choosen for ".$_FILES['csv_file']['name'][$key];
			}
		}
	}

}

echo $str;
?>


