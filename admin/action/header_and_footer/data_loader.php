<?php
include "../../../connection.php";
$mode = isset($_GET['mode'])?$_GET['mode']:"news_load";
$str = "";
$sort = $_POST['sort'];
$limit = $_POST['limit'];
$key = $_POST['sr_for'];
if($mode=="news_load"){
	$type = $_POST['type'];

	// Changing the sql commands according to the type
	if($type=="news" || $type=="notice"){
		if(!empty($key)){// Searching the record if key is not empty
		$sql = "SELECT * FROM news WHERE type = '$type' AND (title LIKE '$key' OR src LIKE '$key') ORDER BY news_id $sort LIMIT $limit";

		}else{
			$sql = "SELECT * FROM news WHERE type = '$type' ORDER BY news_id $sort LIMIT $limit";
		}
	}else if($type=="document"){
		$sql = "SELECT * FROM documents WHERE doc_title LIKE '$key' OR doc_file LIKE '$key' ORDER BY doc_id $sort LIMIT $limit";
	}
	$result = mysqli_query($conn,$sql);

	if(mysqli_num_rows($result)<=0){
		$str = "<p class='display-6'>Nothing Found</p>";
	}else{// displaying records if row exists
		if($type=="news" || $type=="notice"){// This block is for performing operation on news 
			if($result){
				if($type=="news"){
					$id_type = "news_id";
					$view_url = "../../category/individual_content.php?news_id=";
				}else if($type=="notice"){
					$id_type = "notice_id";
					$view_url = "../../category/individual_content.php?news_id=";
				}
				while($row = mysqli_fetch_assoc($result)){
					$news_id = $row['news_id'];
					$title = $row['title'];
					$title = strlen($title)>=30?substr($title,0,30)."...":$title;
					$description_file = file_get_contents("../../../uploads/news_descr/".$row['src']);
					$description = strlen($description_file)>=30?substr($description_file,0,45)." ...":$description_file;
					$thumbnail = $row['thumbnail'];
					$date = $row['upload_date'];
					
					// Traversing other images as well
					$img_sql = "SELECT * FROM news_img WHERE news_id = '$news_id'";
					$img_result = mysqli_query($conn, $img_sql);
					if($img_result){
						$related_img = '<div class="carousel-item active d-flex justify-content-center align-item-center">
										<img src="../../uploads/images/'.$thumbnail.'" class="d-block news_img_carousel" alt="...">
										</div>';
						while($img_row = mysqli_fetch_assoc($img_result)){
							$filename = $img_row['filename'];
							$related_img .= '
								<div class="carousel-item d-flex justify-content-center align-item-center">
								<img src="../../uploads/images/'.$filename.'" class="d-block news_img_carousel" alt="...">
								</div>
							';
						}
					}
				$str .= '
						<div class="col col-sm-6 g-3" style="z-index:0;">
							<div class="card post_form">
								<div class="card-body">
									<h5 class="card-title">
										<div class="hstack gap-3">
										<div>'.$title.'</div>
										<div class="ms-auto">
												<div class="dropdown dropstart">
												<a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
															<path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
														</svg>
												</a>
					
												<ul class="dropdown-menu">
													<li>
														<a href="update.php?news_id='.$news_id.'" title="Update" class="dropdown-item">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
																<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
																<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
															</svg>
															Update
														</a>
													</li>
													<li>
														<a href="delete.php?news_id='.$news_id.'" title="Delete" class="dropdown-item">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
																<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
																<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
															</svg>
															Delete
														</a>
													</li>
													<li>
														<a class="dropdown-item" href="'.$view_url.$news_id.'" target="blank" style="z-index:1;">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
															<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
															<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
															</svg>	
															Detail View
														</a>
													</li>
												</ul>
												</div>
										</div>
										</div>
									</h5><hr>
									<p class="card-text" style="text-align:justify;">'.$description.'</p>
									<p class="card-text text-start"><small class="text-body-secondary">'.$date.'</small></p>
									<!-- image carousel -->
									<div id="carouselExampleFade'.$news_id.'" class="carousel slide carousel-fade">
										<div class="carousel-inner">
											'.$related_img.'
										</div>
										<button class="carousel-control-prev bg-dark bg-opacity-25" type="button" data-bs-target="#carouselExampleFade'.$news_id.'" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next bg-dark bg-opacity-25" type="button" data-bs-target="#carouselExampleFade'.$news_id.'" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
								</div>
							</div>
						</div>
				';
				}
			}
		}else if($type=="document"){// THis block is for performing operation on notice
			$str = '<tr>
						<th>Id</th>
						<th>Title</th>
						<th>File Name</th>
						<th>Date</th>
						<th colspan="2">Action</th>
					</tr>';
			while($row = mysqli_fetch_assoc($result)){
				$id = $row['doc_id'];
				$title = $row['doc_title'];
				$file_name = $row['doc_file'];
				$date = $row['upload_date'];
				$str .= '<tr>
							<td>'.$id.'</td>
							<td>'.$title.'</td>
							<td>'.$file_name.'</td>
							<td>'.$date.'</td>
							<td>
								<a href="update.php?document_id='.$id.'" title="Update" class="btn btn-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
								</a>
							</td>
							<td>
								<a href="delete.php?document_id='.$id.'" title="Delete" class="btn btn-danger">
									<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
										<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
									</svg>
								</a>
							</td>
						</tr>';
			}
		}
	}
}else if($mode=="result_load"){
	$term = $_POST['term'];
	$year = $_POST['year'];
	$sql = "SELECT * FROM class RIGHT JOIN result_files ON class.class_id = result_files.class_id WHERE result_files.term = $term AND result_files.published_year = $year AND class.class_name LIKE '$key' ORDER BY class.class_id $sort LIMIT $limit";
	$result = mysqli_query($conn, $sql);
	if($result){
		if(mysqli_num_rows($result)>=1){
			$str .= "<tr>
						<th>SN</th>
						<th>Class</th>
						<th>Term</th>
						<th>Date</th>
						<th colspan='3'>Action</th>
					</tr>";
		}else{
			$str .= "<p style='font-size:20px;'>Result Isn't Published For this term and year</p>";
		}
		while($row=mysqli_fetch_assoc($result)){
			$id = $row['rst_id'];
			$term = $row['term'];
			$date = $row['published_date'];
			$class_name = $row['class_name'];
			$str .= '<tr>
							<td>'.$id.'</td>
							<td>'.$class_name.'</td>
							<td>'.$term.'</td>
							<td>'.$date.'</td>
						<td>
							<a class="btn btn-primary"  type="button" data-bs-toggle="modal" data-bs-target="#result_viewer_modal">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
									<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
									<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
								</svg>
							</a>
						</td>
						<td>
							<a href="update.php?rst_id='.$id.'" class="btn btn-primary">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
								</svg>
							</a>
						</td>
						<td>
							<a href="delete.php?rst_id='.$id.'" class="btn btn-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
									<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
									<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
								</svg>
							</a>
						</td>
					</tr>';
		}
	}
}
echo $str;
?>