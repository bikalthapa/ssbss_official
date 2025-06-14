<?php
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="icon" href="images/slogo.png">
</head>
<body>
<!-- navigation bar  -->
<?php
print_header("");
?>
<!-- News Section -->
<div class="card text-center">
    <div class="card-body">
        <p class="display-5">Sorry Page Not Found !</p>
        <button class="btn btn-primary" onclick="history.back()">Back To Previous Page</button>
    </div>
</div>



<!-- Website Footer -->
<?php
print_footer();
?>
<script type="text/javascript">
  function close_news_model(){
    document.getElementById("staticBackdrop").style.display = "none";
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>