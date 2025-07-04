<?php
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
if ($auth->isLoggedIn() != "A") {
	header("Location: ../../authentication/");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SSBSS - Admin</title>
	<link rel="stylesheet" type="text/css"
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" href="../images/slogo.png">
</head>

<body>
	<?php
	get_navbar("dashboard");
	?>
	<br><br><br>


	<div class="container py-4">
		<!-- Welcome Message -->
		<div class="card shadow-sm rounded-4 border-0 bg-light mb-4">
			<div class="card-body d-flex align-items-center justify-content-between flex-wrap">
				<div>
					<h4 class="fw-bold mb-1">👋 Welcome back, <span class="text-primary">Admin</span>!</h4>
					<p class="text-muted mb-0" id="greetingMessage">Here's your dashboard overview.</p>
				</div>
				<img src="../../images/authorities_img/unknown_person.jpg" alt="Admin Avatar" class="rounded-circle shadow ms-3" width="60"
					height="60">
			</div>
		</div>

		<!-- Quick Stats -->
		<div class="row g-3">
			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-primary shadow rounded-4 h-100">
					<div class="card-body">
						<h6 class="card-title">Total News</h6>
						<h3 class="fw-bold"><span id="newsCount">0</span></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-warning shadow rounded-4 h-100">
					<div class="card-body">
						<h6 class="card-title">Notices</h6>
						<h3 class="fw-bold"><span id="noticeCount">0</span></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-success shadow rounded-4 h-100">
					<div class="card-body">
						<h6 class="card-title">Documents</h6>
						<h3 class="fw-bold"><span id="documentCount">0</span></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="card text-white bg-danger shadow rounded-4 h-100">
					<div class="card-body">
						<h6 class="card-title">Admissions</h6>
						<h3 class="fw-bold"><span id="admissionCount">0</span></h3>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		$(document).ready(() => {
			const ctx = document.getElementById('myChart');
			var a = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['2029', '2030', '2031', '2032', '2033', '2034', '2035', '2036', '2037', '2038', '2039', '2040', '2041'],
					datasets: [{
						label: 'Total Admission',
						data: [110, 123, 12, 29, 43, 44, 65, 66, 17, 0, 1, 70, 90, 100],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});

			const traffic = document.getElementById('traffic');
			var a = new Chart(traffic, {
				type: 'line',
				data: {
					labels: ['2029', '2030', '2031', '2032', '2033', '2034', '2035', '2036', '2037', '2038', '2039', '2040', '2041'],
					datasets: [{
						label: 'Traffic',
						data: [110, 123, 12, 29, 43, 44, 65, 66, 17, 0, 1, 70, 90, 100],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});

			const post = document.getElementById('post');
			var a = new Chart(post, {
				type: 'pie',
				data: {
					labels: ['News', 'Notice', 'Documents'],
					datasets: [{
						label: 'Post',
						data: [110, 193, 12],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
			// This function is used to logout from admin panel
			$("#log_out_btn_off_canvas , #log_out_btn_nav").click(function () {
				var confirmation = confirm("Are you sure you want to log out");
				if (confirmation == true) {// Admin can be log out
					$.ajax({
						url: "scripts/php_scripts/logout.php",
						type: "POST",
						data: { logout: "true" },
						success: function (result) {
							if (result == "logout_success") {
								window.location.replace("../../authentication/index.php");
							}
						}
					});
				}
			});
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
		integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
		integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
		crossorigin="anonymous"></script>
</body>

</html>