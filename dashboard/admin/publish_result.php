<?php
include "../../connection.php";
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
// Check if the user is logged in as an admin
if ($auth->isLoggedIn() != "A") {
	header("Location: ../authentication/");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Post | Admin</title>
	<link rel="stylesheet" type="text/css"
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="icon" href="../../images/slogo.png">
	<style>
		body {
			max-height: 150vh;
		}

		.post_form {
			padding: 10px;
			box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
		}


		.admin_nav {
			max-width: 100%;
			max-height: 50px;
			border: 1px solid lightgrey;
			position: fixed;
			bottom: 0px;
			margin: auto;
			border-radius: 10px;
			box-shadow: black 8px 8px 30px 0px;
		}

		.admin_nav a {
			padding: 10px;
		}

		.my_badge {
			position: absolute;
			top: 7px;
			right: 3px;
		}

		td,
		th {
			border: 1px solid black;
			padding: 2px;
		}

		.table_div {
			overflow: auto;
		}

		.header {
			position: relative;
		}

		.header .logo {
			height: 45%;
			width: 15%;
			border: 2px solid black;
			border-radius: 100%;
			z-index: -1;
			margin: auto;
			position: absolute;
			left: 5%;
			top: 20%;
		}

		.details_data,
		tr {
			font-weight: 800;
			color: black;
		}

		.details_data {
			padding: 10px;
			min-width: 60px;
		}

		.details {
			font-size: 18px;
		}

		td,
		th {
			border: 1px solid black;
		}

		.design1 {
			padding: 10px;
			max-height: 1600px;
			max-width: 800px;
			border: 2px solid blue;
			border-style: dashed;
			margin: 15px;
			margin: auto;
		}

		.GS {
			font-weight: 800px;
			font-size: 1.5rem;
		}

		.head_para {
			font-weight: bold;
			z-index: 1;
		}

		.school_name {
			font-size: 1.5rem;
			text-transform: uppercase;
		}

		.examination_title {
			font-size: 1rem;
			font-weight: bold;
			margin-top: -20px;
		}

		.signature {
			height: 50px;
			width: 100px;
		}

		.hold {
			background-color: red;
			color: white;
			padding: 3px;
			font-size: 25px;
		}

		.hide {
			display: none;
		}

		.no_select {
			user-select: none;
		}
	</style>
</head>

<body id="main_body">
	<?php
	get_navbar("exam");
	?>
	<br><br><br>


	<div class="container">
		<button class="btn btn-warning w-100" id="result_toggler" current-toogle="view">Add Result</button>
		<form method="post" action="" id="result_form" enctype="multipart/form-data">
			<!-- First Row -->
			<div class="row">
				<div class="col-sm-6 g-3">
					<label class="form-label">Exam Title</label>
					<div class="row">
						<div class="col col-sm-9">
							<select class="form-select border-primary col-sm-9" name="exam_title">
								<option value="1">First Terminal Examination </option>
								<option value="2">Second Terminal Examination </option>
								<option value="3">Third Terminal Examination </option>
								<option value="4">Final Terminal Examination </option>
							</select>
						</div>
						<div class="col col-sm-3">
							<input type="number" id="year" class="form-control border-primary" name="year"
								value="<?php echo date("y") + 2057; ?>">
						</div>
					</div>


					<div class="row" style="padding-left:14px;">
						<label class="form-label">File Template</label>
						<div class="col-sm-6 gx-5 form-check">
							<input class="form-check-input border-primary" name="template_type" type="radio"
								value="default" id="default_template" checked oninput="decide_template_viewer()">
							<label class="form-check-label" for="default_template">
								Default Template
							</label>
						</div>
						<div class="col-sm-6 gx-5 form-check">
							<input class="form-check-input border-primary" name="template_type" type="radio"
								value="custom" id="custom_template" oninput="decide_template_viewer()">
							<label class="form-check-label" for="custom_template">
								Custom Template
							</label>
						</div>
					</div>
				</div>
				<div class="col-sm-6 g-3">
					<label class="form-label">CSV File</label>
					<input type="file" name="csv_file[]" accept=".csv"
						class="form-control form-control-md border-primary" id="csv_file" multiple><br>
					<div class="row" style="margin-left:10px;" id="file_unity_div">
						<div class="form-check">
							<input class="form-check-input border-primary" name="file_unity" type="radio" value="same"
								id="same" checked>
							<label class="form-check-label" for="same">
								All Files have similar template.
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input border-primary" name="file_unity" type="radio"
								value="different" id="different">
							<label class="form-check-label" for="different">
								All Files have different template.
							</label>
						</div>
					</div>
				</div>
			</div><br>
			<!-- Second Row //  Class Name and section choosing section-->
			<?php
			$sql = "SELECT * FROM class;";
			$result = mysqli_query($conn, $sql);
			$classes = "<option value='0'>Choose Class</option>";
			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$classname = $row['class_name'];
					$id = $row['class_id'];
					$classes .= "<option value=\"$id\">$classname</option>";
				}
			}
			?>
			<p class="text-center" id="filename_title">Choose Class And Section for each file.</p>
			<div class="row row-cols-1 row-cols-md-2 g-4" id="file_name_column">
			</div><br>
			<!-- Third Row  // Result design viewing, drag and drop section-->
			<div class="row" id="template_viewer">
				<div class="col-sm-6 g-3">
					<p class="display-6">Result Design</p>
					<div class="design1" id="design1">
						<div class="row">
							<div class="text-center header">
								<img src="../../images/slogo.png" class="logo">
								<div class="head_para">
									<p class="display-6 school_name text-primary">Shree Shanti Bhagwati
										Secondary School</p>
									<p>LETANG-4, MORANG<br>ESTD 2009</p>
									<p class="examination_title">Second-Terminal Examination-2080</p>
									<p class="display-6 GS text-danger">GRADE SHEET</p>
								</div>
							</div>
							<div class="details">
								<div class="row">
									<div class="col-sm-4">
										Name : <span class="details_data drop_col"></span><br>
									</div>
									<div class="col-sm-4">
										Grade : <span class="details_data"></span>
									</div>
									<div class="col-sm-4">
										Symbol No : <span class="details_data drop_col"></span>
									</div>
								</div>
								<table border="1" cellspacing="0" cellpadding="5" class="text-center"
									style="margin:auto; width:100%;">
									<tr class="text-primary">
										<th rowspan="2">S.N</th>
										<th rowspan="2">Subjects</th>
										<th rowspan="2">FM</th>
										<th rowspan="2">PM</th>
										<th colspan="2">Obtained Marks</th>
										<th rowspan="2">Grade Point</th>
										<th rowspan="2">Remarks</th>
									</tr>
									<tr class="text-primary">
										<th>TH</th>
										<th>IN</th>
									</tr>
									<tr>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
										<td class="details_data drop_col"></td>
									</tr>
									<tr class="text-primary">
										<th></th>
										<th colspan="2" style="text-align:left;">GPA: <span
												class="details_data drop_col"></span></th>
										<th colspan="3" style="text-align:left;">Percentage :<span
												class="details_data drop_col"></span></th>
										<th colspan="2" style="text-align:left;">Rank :<span
												class="details_data drop_col"></span> </th>
									</tr>
								</table>
								<div class="result_conclusion row row-cols-2">
									<div class="col gy-2 gx-5">
										<p class="total_students">TOTAL STUDENTS :<span
												class="details_data drop_col"></span></p>
										<p class="remarks">REMAKRS :<span class="details_data"></span></p>
									</div>
									<div class="col gy-2 gx-5">
										<p class="attendance drop_col">ATTENDANCE : <span class="details_data"></span>
										</p>
										<p class="date_of_issue">DATE OF ISSUE :<span class="details_data"></span></p>
									</div>
								</div>
								<hr>
								<div class="result_footer row row-cols-2">
									<div class="col gy-2 gx-5">
										<p class="class_teacher">CLASS TEACHER
										</p>
									</div>
									<div class="col gy-2 gx-5">
										<p class="head_teacher">HEAD TEACHER
										<p>
									</div>
								</div>
								<hr>
								<div class="note row row-cols-1">
									<p class="result_notes col gx-5">
										NOTE: PM = Pass Marks, FM = Full Marks, F = Fail, TH = Theory, IN =
										Internal
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 g-3">
					<p class="display-6">Data Sheet</p>
					<table cellspacing="0" cellpadding="2">
						<tr>
							<th><span class="drag_col" draggable="true">1</span></th>
							<th><span class="drag_col" draggable="true">2</span></th>
							<th><span class="drag_col" draggable="true">3</span></th>
							<th><span class="drag_col" draggable="true">4</span></th>
							<th><span class="drag_col" draggable="true">5</span></th>
							<th><span class="drag_col" draggable="true">6</span></th>
							<th><span class="drag_col" draggable="true">7</span></th>
							<th><span class="drag_col" draggable="true">8</span></th>
							<th><span class="drag_col" draggable="true">9</span></th>
							<th><span class="drag_col" draggable="true">10</span></th>
							<th><span class="drag_col" draggable="true">11</span></th>
						</tr>
					</table>
				</div>
			</div>
			<input class="btn btn-primary w-100" type="submit" id="publish_result" name="publish_result"
				value="Publish Result">
		</form>
		<div id="result_viewer" class="w-100">
			<div class="card text-center border-primary">
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
						<li class="nav-item">
							<select class="form-select" id="exam_title">
								<option value="1">First Terminal Examination</option>
								<option value="2">Second Terminal Examination</option>
								<option value="3">Third Terminal Examination</option>
								<option value="4">Final Examination</option>
							</select>
						</li>
						<li class="nav-item">
							<select class="form-select" id="published_year">
								<?php
								$sql = "SELECT DISTINCT published_year FROM result_files";
								$result = mysqli_query($conn, $sql);
								if ($result) {
									while ($row = mysqli_fetch_assoc($result)) {
										$published_year = $row['published_year'];
										?>
										<option value="<?php echo $published_year ?>"><?php echo $published_year; ?>
										</option>
										<?php
									}
								}
								?>
							</select>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<form class="controls_container row gx-1" style="margin-bottom:3px; margin-top:-15px;"
						method="post">
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
							<input class="form-control me-2 border-primary dropdown-toggle" required name="search"
								type="search" placeholder="Search" aria-label="Search" id="search_bar">
						</div>
					</form><br>
					<div class="table_div w-100 d-flex justify-content-center">
						<table cellspacing="0" cellpadding="5" id="result_table">

						</table>
					</div>
					<!-- Loader -->
					<div class="d-flex justify-content-center">
						<div class="spinner-border" role="status" id="result_view_spinner">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="result_viewer_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Understood</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$("#filename_title").hide();
		// $("#result_viewer").hide();
		$("#result_form").hide();
		$("#result_view_spinner").hide();
		$(document).ready(() => {
			var term = $("#exam_title").val();
			var year = $("#published_year").val();
			if (year == null) {// it will reduce an error in sql
				year = 0;
			}
			var limit = 10;
			var sort = "DESC";
			var key = "%";

			// This function will request server to load result data //
			function load_result(term, year, limit_value, order_value, key_value) {
				$.ajax({
					url: "action/read.php?mode=result_load",
					type: "POST",
					data: { term: term, year: year, sort: order_value, limit: limit_value, sr_for: key_value },
					success: function (data) {
						$("#result_table").html(data);
					}
				});
			}
			load_result(term, year, limit, sort, key);

			// This function will execute when exam title is changed
			$("#exam_title").on("change", function () {
				term = $("#exam_title").val();
				load_result(term, year, limit, sort, key);
			})
			// This function will execute when limit is changed
			$("#limit").on("input", function () {
				limit = $("#limit").val();
				if (limit == "") {
					limit = 10;
				}
				load_result(term, year, limit, sort, key);
			});
			// This function will execute when sort is changed
			$("#sort").on("input", function () {
				sort = $("#sort").val();
				load_result(term, year, limit, sort, key);
			});
			// This function will execute when search input is active
			$("#search_bar").on("input", function () {
				key = $("#search_bar").val();
				if (key == "") {
					key = "%";
				} else {
					key = "%" + key + "%";
				}
				load_result(term, year, limit, sort, key);
			});
			// This function will request server to insert data to database //
			$("#result_form").on("submit", function (e) {
				e.preventDefault();
				if ($("#year").val() == "") {
					alert("Please Enter a year !");
				} else if ($("#csv_file")[0].files.length == "") {
					alert("Please Enter at least one file !");
				} else {
					$.ajax({
						url: "header_and_footer/data_inserter.php?mode=result_publish",
						type: "POST",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData: false,
						success: function (data) {
							if (data.length > 4) {
								alert(data);
							}
						}
					});
				}
			});

			//This function is invoked when file is uploaded
			$("#csv_file").change(function () {
				var grades = document.getElementsByClassName("grade_selection");
				var file = $("#csv_file");
				var length = file[0].files.length;
				var items = file[0].files;
				var allowed_types = "text/csv";
				var grade_id;
				var str = " ", error_str = "";
				if (length >= 1) {// Executes if at least one file is uploaded
					for (var i = 0; i < length; i++) {// Visiting each file
						var name = items[i].name;
						var file_type = this.files[i].type;

						if (allowed_types == file_type) {// File type is valid
							str += `<div class="col gx-3">
									<div class="row">`+ name + `</div>
									<div class="row">
										<div class="col-sm-6">
											<select class="col-sm-6 form-select border-primary grade_selection" aria-label="Class Example" choose_for="`+ "id" + i + `" name="grade_selection[]" required>
												<?php echo $classes; ?>
											</select>
										</div>
									</div>
								</div>`;
							$("#filename_title").show();
							$("#file_name_column").html(str);

							for (grade of grades) {
								grade.addEventListener("change", (e) => {
									grade_id = e.target.value;
									var choose_for = e.target.getAttribute("choose_for");
									$.ajax({
										url: "../../category/more/result_data_loader.php",
										type: "POST",
										data: { type: "grade", id: grade_id },
										success: function (data) {
											if (data != "") {
												$("#" + choose_for).html(data);
											} else {
												$("#" + choose_for).html("<option value='0'>No Section</option>");
											}
										}
									});
								});
							}

						} else {//File Type is not valid
							error_str += "'" + name + "', ";
						}
					}

					if (error_str != "") {// Displaying invalid file types
						alert(error_str + " Can't add due to invalid file type. Only CSV file is valid.");
					}
				}
			});

			// Data view and add button toggler
			var current_toogle_value = $("#result_toggler").attr("current-toogle");
			$("#result_toggler").click(function () {
				if (current_toogle_value == "add") {
					$("#result_viewer").show();
					$("#result_form").hide();
					current_toogle_value = "view";
				} else if (current_toogle_value == "view") {
					$("#result_viewer").hide();
					$("#result_form").show();
					current_toogle_value = "add";
				}
			});
			// This is for drag and drop //
			var drag_cols = document.getElementsByClassName("drag_col");
			var dropable_cols = document.getElementsByClassName("drop_col");
			var body = document.getElementById("main_body");
			var selected;
			for (drag_col of drag_cols) {
				drag_col.addEventListener("dragstart", (e) => {
					//drag started
					body.classList.add("no_select");
					selected = e.target;
					e.target.className += " hold";
					setTimeout(() => {
						e.target.className = "hide";
					}, 0);
				});
				drag_col.addEventListener("dragend", (e) => {
					e.target.className = " drop_col";
					body.classList.remove("no_select");
				});
			}
			for (dropable_col of dropable_cols) {
				dropable_col.addEventListener("dragover", (e) => {
					e.preventDefault();
				});
				dropable_col.addEventListener("drop", (e) => {
					e.target.append(selected);
				});
			}
		});
		function decide_template_viewer() {
			if (document.getElementById("default_template").checked) {
				$("#template_viewer").hide();
				$("#file_unity_div").hide();
			} else if (document.getElementById("custom_template").checked) {
				$("#template_viewer").show();
				$("#file_unity_div").show();
			}
		}
		decide_template_viewer();

	</script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
		crossorigin="anonymous"></script>
</body>

</html>