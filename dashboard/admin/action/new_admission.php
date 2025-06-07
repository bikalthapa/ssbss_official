<?php
include "header_and_footer/header_and_footer.php";
include "../scripts/php_scripts/logout.php";
is_login("../../authentication/index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Admission | Admin</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="icon" href="../../images/slogo.png">
    <style>
    	.my_badge{
    		position: absolute;
    		top: 7px;
    		right: 3px;
    	}

    </style>
</head>
<body>
	<!-- Dashboard Main Content -->
<div class="mb-3" style="max-width: 100%; padding:10px;">
	<div class="row">
		<div class="col-sm-1" style="max-width:5%;">
	    	<div style="position:fixed;">
	    	<?php echo get_html("navigation","inside_action");?>
	    	</div>
	    </div>
		<div class="col col-md-11">









			<p class="display-6 text-center">New Admission</p>
	




		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(()=>{
	// This function is used to logout from admin panel
		$("#log_out_btn_off_canvas , #log_out_btn_nav").click(function(){
			var confirmation = confirm("Are you sure you want to log out");
			if(confirmation==true){// Admin can be log out
				$.ajax({
					url:"../scripts/php_scripts/logout.php",
					type:"POST",
					data: {logout:"true"},
					success: function(result){
						if(result=="logout_success"){
							window.location.replace("../../authentication/index.php");
						}
					}
				});
			}
			// alert(window.location.pathname);
		});
	});
</script>
<script src="../scripts/javascripts/header_and_footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>