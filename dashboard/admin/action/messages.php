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
	<title>Messages | Admin</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="icon" href="../../images/slogo.png">
    <style>
    	.my_badge{
    		position: absolute;
    		top: 7px;
    		right: 3px;
    	}
    	.user_img{
    		height: 95%;
    		width: 100%;
    		border-radius: 100%;
    		border: 1px solid black;
    	}
    	.user_manage{
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100%;
    	}
    	.message_username{
    		margin-top: 17px;
    		margin-bottom: 0px;
    		font-weight: 800;
    	}
    	.message_users{
    		border: 1px solid lightgrey;
    		border-radius: 10px;
    	}
    	.individual_conversation{
    		max-height: 100vh;
    	}
    	.conversation{
    		position: relative;
    		border:1px solid lightgrey;
    	}
    	.conversation_footer{
    		min-width: 100%;
    		position: absolute;
    		bottom: 0px;
    		padding: 10px;
    	}
    	.conversation_data{
    		margin-bottom: 50px;
    	}

    	.each_message{
    		position: relative;
    		height: auto;
    	}
    	.sender, .receiver{
    		max-width: 75%;
    		padding: 10px;
    		border-radius: 20px;
    	}
    	.sender{
    		right: 0px;
    		text-align: right;
    		background-color: lightskyblue;
    	}
    	.receiver{
    		background-color: lightcyan;
    	}
    </style>
</head>
<body>
	<!-- Dashboard Main Content -->
<div class="mb-3" style="max-width: 100%; padding:10px;">
	<div class="row">
		<div class="col-sm-1" style="z-index:1;  max-width:5%;">
			<div style="position:fixed;">
				<?php echo get_html("navigation","inside_action");?>
			</div>
		</div>
		<div class="col col-md-11">
			<div class="row">
				<div class="col-sm-4">
					<div class="hstack">
						<div class="row" style="font-weight:500; font-size:25px;">
							<div class="col-sm-3">Chats</div> 
					     	<form class="col-sm-9 d-flex" role="search">
					        	<input class="form-control me-2 w-100" type="search" placeholder="Search" aria-label="Search">
					      	</form>
  						</div>
					</div>
					<div class="container" style="margin:0px; padding:0px;">
						<div class="vstack gap-3 p-2">
						  	<div class="p-2 message_users row">
							  	<div class="col col-sm-3">
							  		<img src="../../images/authorities_img/school_head_teacher.jpg" class="user_img">
							  	</div>
							  	<div class="col col-sm-7">
							  		<p class="message_username">Shree Prashad Dhakal</p>
							  		<p class="message">Hi.. <span> 3d</span></p>
							  	</div>
							  	<div class="col col-sm-2">
							  		<div class="row user_manage">
								  		<div class="col col-sm-5">
								  			<img src="../../images/authorities_img/school_head_teacher.jpg" style="height:20px; width:20px;" class="user_img">
								  		</div>
								  		<div class="col col-sm-7" style="height:20px; width:20px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
											  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
											</svg>
								  		</div>
							  		</div>
							  	</div>
						  	</div>
						  	<div class="p-2 message_users row">
							  	<div class="col col-sm-3">
							  		<img src="../../images/authorities_img/unknown_person.jpg" class="user_img">
							  	</div>
							  	<div class="col col-sm-7">
							  		<p class="message_username">Unknown User 1</p>
							  		<p class="message">Thank You Very Mu.. <span> 3d</span></p>
							  	</div>
							  	<div class="col col-sm-2">
							  		<div class="row user_manage">
								  		<div class="col col-sm-5">
								  			<img src="../../images/authorities_img/unknown_person.jpg" style="height:20px; width:20px;" class="user_img">
								  		</div>
								  		<div class="col col-sm-7" style="height:20px; width:20px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
											  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
											</svg>
								  		</div>
							  		</div>
							  	</div>
						  	</div>
						  	<div class="p-2 message_users row">
							  	<div class="col col-sm-3">
							  		<img src="../../images/authorities_img/english_medium_incharge.jpg" class="user_img">
							  	</div>
							  	<div class="col col-sm-7">
							  		<p class="message_username">Lekhnath Poudyal</p>
							  		<p class="message">It was so helpful.. <span> 3d</span></p>
							  	</div>
							  	<div class="col col-sm-2">
							  		<div class="row user_manage">
								  		<div class="col col-sm-5">
								  			<img src="../../images/authorities_img/english_medium_incharge.jpg" style="height:20px; width:20px;" class="user_img">
								  		</div>
								  		<div class="col col-sm-7" style="height:20px; width:20px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
											  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
											</svg>
								  		</div>
							  		</div>
							  	</div>
						  	</div>
						  	<div class="p-2 message_users row">
							  	<div class="col col-sm-3">
							  		<img src="../../images/authorities_img/unknown_person.jpg" class="user_img">
							  	</div>
							  	<div class="col col-sm-7">
							  		<p class="message_username">Unknown User 2</p>
							  		<p class="message">Hi.. <span> 3d</span></p>
							  	</div>
							  	<div class="col col-sm-2">
							  		<div class="row user_manage">
								  		<div class="col col-sm-5">
								  			<img src="../../images/authorities_img/unknown_person.jpg" style="height:20px; width:20px;" class="user_img">
								  		</div>
								  		<div class="col col-sm-7" style="height:20px; width:20px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
											  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
											</svg>
								  		</div>
							  		</div>
							  	</div>
						  	</div>
						  	<div class="p-2 message_users row">
							  	<div class="col col-sm-3">
							  		<img src="../../images/authorities_img/science_and_engineering_incharge.jpg" class="user_img">
							  	</div>
							  	<div class="col col-sm-7">
							  		<p class="message_username">Shanti P. Chamlagain</p>
							  		<p class="message">Hi.. <span> 3d</span></p>
							  	</div>
							  	<div class="col col-sm-2">
							  		<div class="row user_manage">
								  		<div class="col col-sm-5">
								  			<img src="../../images/authorities_img/science_and_engineering_incharge.jpg" style="height:20px; width:20px;" class="user_img">
								  		</div>
								  		<div class="col col-sm-7" style="height:20px; width:20px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
											  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
											</svg>
								  		</div>
							  		</div>
							  	</div>
						  	</div>
						</div>
					</div>
				</div>
				<div class="col-sm-8 individual_conversation">
					<div class="hstack" style="border:1px solid lightgrey;">
						<div style="max-height:50px;display: flex;justify-content: center;align-items: center;">
						  	<img src="../../images/authorities_img/unknown_person.jpg" style="height:40px; border-radius:100%; margin:10px;">
						</div>
						<div class="p-2" style="font-weight: 700;">
							Unknown User 1
						</div>
					</div>
					<div class="conversation">
						<div class="conversation_data vstack gap-1 p-4">
							  <div class="p-2 each_message">
							  	<h5 class="receiver">Hello</h5>
							  </div>
							  <div class="p-2 each_message">
							  	<h5 class="receiver">How can we admit out child on ssbss ?</h5>
							  </div>
							  <div class="p-2 each_message">
							  	<h5 class="sender ms-auto">You can check our admission section.</h5>
							  </div>
							  <div class="p-2 each_message">
							  	<h5 class="receiver">Thank You Very Much</h5>
							  </div>
						</div>
						<div class="conversation_footer">
							<div class="hstack text-center" style="width:100%;">
								<div class="p-1" style="min-width:92%;">
									<input type="text" name="message" class="form-control border-primary" placeholder="your_message">
								</div>
								<div class="p-1">
									<button class="btn btn-primary" title="send">
										<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
										  <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
										</svg>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../scripts/javascripts/header_and_footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>