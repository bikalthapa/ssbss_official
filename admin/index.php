<?php
include "action/header_and_footer/header_and_footer.php";
include "scripts/php_scripts/logout.php";
is_login("../authentication/index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome To Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" href="../images/slogo.png">
</head>
<body>
<div class="mb-3" style="max-width: 100%; padding:10px;">
	<div class="row">
			<div class="col-sm-1" style="z-index: 1; max-width:5%;">
				<div style="position:fixed;">
					<?php echo get_html("navigation","outside_action");?>
				</div>
			</div>
			<div class="col-sm-11 gy-3">
				<div class="row">
				  <div class="col-sm-4 mb-3 mb-sm-0">
						<div class="hstack gap-3">
						  	<h5 class="p-2">Notification</h5>
						  	<div class="p-2 ms-auto">
								<div class="dropdown">
								  <button class="btn btn-secondary bg-light border-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								    	<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="bi bi-three-dots" viewBox="0 0 16 16">
											<path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
										</svg>
								  </button>
								  <ul class="dropdown-menu">
								    <li><a class="dropdown-item" href="#">Clear All</a></li>
								    <li><a class="dropdown-item" href="#">Block Notification</a></li>
								  </ul>
								</div>
						  	</div>
						</div>
							<div class="list-group gap-3" style="max-height:100vh; overflow-y:auto;">
							  <a href="#" class="list-group-item list-group-item-action bg-info" aria-current="true">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small>3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small>And some small print.</small>
							  </a>
							  <a href="#" class="list-group-item list-group-item-action bg-info" aria-current="true">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small>3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small>And some small print.</small>
							  </a>
							  <a href="#" class="list-group-item list-group-item-action bg-info">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small class="text-body-secondary">3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small class="text-body-secondary">And some muted small print.</small>
							  </a>
							  <a href="#" class="list-group-item list-group-item-action bg-info">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small class="text-body-secondary">3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small class="text-body-secondary">And some muted small print.</small>
							  </a>
							  <a href="#" class="list-group-item list-group-item-action bg-info">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small class="text-body-secondary">3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small class="text-body-secondary">And some muted small print.</small>
							  </a>
							  <a href="#" class="list-group-item list-group-item-action bg-info">
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1">List group item heading</h5>
							      <small class="text-body-secondary">3 days ago</small>
							    </div>
							    <p class="mb-1">Some placeholder content in a paragraph.</p>
							    <small class="text-body-secondary">And some muted small print.</small>
							  </a>
							</div>				     
				  </div>
				  <div class="col-sm-8">
				  	<div class="charts row">
				  		<div class="col col-sm-8">
				  			<h5>Admission</h5>
						  <canvas id="myChart"></canvas>
				  		</div>
				  		<div class="col-sm-4">
				  			<h5>Post</h5>
				  			<canvas id="post"></canvas>
				  		</div>
				  	</div><br>
				  	<div class="row">
				  		<h5>Web Traffic</h5>
				  		<div class="col">
				  			<canvas id="traffic" style="min-width:100%"></canvas>
				  		</div>
				  	</div>
				  </div>
				</div>
			</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	$(document).ready(()=>{
	  const ctx = document.getElementById('myChart');
	 var a = new Chart(ctx, {
	    type: 'line',
	    data: {
	      labels: [ '2029','2030', '2031','2032', '2033','2034', '2035','2036', '2037','2038', '2039','2040', '2041'],
	      datasets: [{
	        label: 'Total Admission',
	        data: [110,123,12,29,43,44,65,66,17,0,1,70,90,100],
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
	      labels: [ '2029','2030', '2031','2032', '2033','2034', '2035','2036', '2037','2038', '2039','2040', '2041'],
	      datasets: [{
	        label: 'Traffic',
	        data: [110,123,12,29,43,44,65,66,17,0,1,70,90,100],
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
	      labels: ['News','Notice','Documents'],
	      datasets: [{
	        label: 'Post',
	        data: [110,193,12],
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
		$("#log_out_btn_off_canvas , #log_out_btn_nav").click(function(){
			var confirmation = confirm("Are you sure you want to log out");
			if(confirmation==true){// Admin can be log out
				$.ajax({
					url:"scripts/php_scripts/logout.php",
					type:"POST",
					data: {logout:"true"},
					success: function(result){
						if(result=="logout_success"){
							window.location.replace("../authentication/index.php");
						}
					}
				});
			}
		});
	});
</script>
<script src="scripts/javascripts/header_and_footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>