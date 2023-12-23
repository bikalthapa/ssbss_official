<?php
include "../script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Style/style.css">
    <link rel="icon" type="icon" href="../images/slogo.png">
<style>
    .controls{
        max-height:40px;
        min-width:45%;
        background-color:#dbdbdb;
        overflow: hidden;
    }
    .circle_image{
        border-radius: 100%;
        height: 100px;
        margin: auto;
        width: 100px;
    }
    .counter_title{
      font-size: 20px;
      text-align: center;
    }
    .faculty_thumbnail{
      min-width:100%;
      max-height:250px;
    }
</style>
</head>
<body>
<!-- navigation bar  -->
<?php
print_header(1,"faculty");
?>
<p class="display-6 text-center">हाम्रा विभागहरू</p>
<div class="row">
  <div class="col-sm-4 mb-3 mb-sm-0 g-5">
    <div class="card h-100">
      <img src="../images/class_9_c_lab.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">ईन्जिनियरिङ् विभाग</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 g-5">
    <div class="card h-100">
      <img src="../images/students_with_teachers.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">विज्ञान तथा प्रवीधी विभाग</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 g-5">
    <div class="card h-100">
      <img src="../images/students_with_teachers.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">अङ्ग्रेजी माध्यम</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4 mb-3 mb-sm-0 g-5">
    <div class="card h-100">
      <img src="../images/class_9_c_lab.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">नेपाली माध्यम्</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 g-5">
    <div class="card h-100">
      <img src="../images/students_with_teachers.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">वाणाीज्य</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 g-5">
    <div class="card h-100">
      <img src="../images/students_with_teachers.jpg" class="card-img-top faculty_thumbnail" alt="...">
      <div class="card-body">
        <h5 class="card-title">शिक्षा</h5>
        <a href="about_faculty/about_faculty" class="btn btn-primary w-100">थप पढ्नुहाेस</a>
      </div>
    </div>
  </div>
</div>

<!-- Website Footer -->
<?php
print_footer("../images/");
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>