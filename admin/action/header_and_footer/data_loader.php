<?php
include "../../../connection.php";
$type = $_POST['type'];
$sort = $_POST['sort'];
$limit = $_POST['limit'];
$key = $_POST['sr_for'];
$str = "";

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
			}else if($type=="notice"){
				$id_type = "notice_id";
			}
			$str = '<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Description</th>
						<th>Thumbnail</th>
						<th>Date</th>
						<th colspan="2">Action</th>
					</tr>
			';
			while($row = mysqli_fetch_assoc($result)){
				$news_id = $row['news_id'];
				$title = $row['title'];
				$description = $row['src'];
				$thumbnail = $row['thumbnail'];
				$date = $row['upload_date'];
			$str .= '
					<tr>
						<td>'.$news_id.'</td>
						<td>'.$title.'</td>
						<td>'.$description.'</td>
						<td>'.$thumbnail.'</td>
						<td>'.$date.'</td>
						<td>
		  					<a href="update.php?'.$id_type.'='.$news_id.'" title="Update" class="btn btn-primary">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
								</svg>
							</a>
						</td>
						<td>
							<a href="delete.php?'.$id_type.'='.$news_id.'" title="Delete" class="btn btn-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
									<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
									<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
								</svg>
							</a>
						</td>
					</tr>';
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

echo $str;
?>