<?php
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
if ($auth->isLoggedIn() != "T") {
	header("Location: ../../authentication/");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSBSS - Teachers</title>
	<link rel="stylesheet" type="text/css"
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" href="../images/slogo.png">
</head>

<body>
	<?php
	get_navbar("dashboard");
	?>
	<br><br><br>

	<!-- Make sure to include Bootstrap 5 CSS & JS and Bootstrap Icons in your project -->

	<div class="container my-5">
		<div class="bg-white rounded-3">
			<!-- Progress Highlights -->
			<div class="row g-4 mb-5 align-items-stretch">

				<!-- Marks Entry Card -->
				<div class="col-md-4 h-100">
					<div class="card text-center border-0 shadow p-4 bg-warning-subtle rounded hover-shadow h-100">
						<div class="d-flex justify-content-center align-items-center mb-3">
							<i class="bi bi-journal-check fs-2 text-warning me-2"></i>
							<h6 class="text-warning fw-semibold mb-0">Marks Entry</h6>
						</div>
						<p class="display-5 text-warning mb-1">
							45 / 50 <sub class="text-warning-subtle fs-6">class</sub>
						</p>
					</div>
				</div>

				<!-- Total Students Card -->
				<div class="col-md-4 h-100">
					<div class="card text-center border-0 shadow p-4 bg-warning-subtle rounded hover-shadow h-100">
						<div class="d-flex justify-content-center align-items-center mb-3">
							<i class="bi bi-people-fill fs-2 text-warning me-2"></i>
							<h6 class="text-warning fw-semibold mb-0">Total Students</h6>
						</div>
						<p class="display-5 text-warning mb-1">120</p>
					</div>
				</div>

			</div>





			<!-- Students Details -->
			<h5 class="mb-4 fw-bold text-warning">Students Details</h5>
			<div class="shadow-sm rounded border border-warning-subtle p-3 d-inline-block bg-white">
				<table class="table table-striped table-hover align-middle mb-0">
					<thead class="table-warning-subtle text-warning fw-semibold">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col" class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Rina Sharma</td>
							<td class="text-center">
								<div class="dropdown">
									<i class="bi bi-three-dots-vertical" role="button" data-bs-toggle="dropdown"
										aria-expanded="false"></i>
									<ul class="dropdown-menu dropdown-menu-end">
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-pencil-square me-2 text-primary"></i> Edit Student
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-trash3-fill me-2 text-danger"></i> Delete Student
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-info-circle-fill me-2 text-info"></i> View Details
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-arrow-up-circle-fill me-2 text-success"></i> Promote
											</a>
										</li>
									</ul>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">2</th>
							<td>Arjun Thapa</td>
							<td class="text-center">
								<div class="dropdown">
									<i class="bi bi-three-dots-vertical" role="button" data-bs-toggle="dropdown"
										aria-expanded="false"></i>
									<ul class="dropdown-menu dropdown-menu-end">
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-pencil-square me-2 text-primary"></i> Edit Student
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-trash3-fill me-2 text-danger"></i> Delete Student
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-info-circle-fill me-2 text-info"></i> View Details
											</a>
										</li>
										<li>
											<a class="dropdown-item d-flex align-items-center" href="#">
												<i class="bi bi-arrow-up-circle-fill me-2 text-success"></i> Promote
											</a>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>




		</div>
	</div>






	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
		crossorigin="anonymous"></script>
</body>

</html>