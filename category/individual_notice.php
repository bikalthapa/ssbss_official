<?php
include "../connection.php";
$limit = 6;
$page = isset($_GET['page'])? $_GET['page']:1;
$start = ($page-1)*$limit;
$previous = $page -1;
$next = $page + 1;
$sql = "SELECT * FROM news WHERE type =\"notice\";";
$result = mysqli_query($conn,$sql);
$total_rows = mysqli_num_rows($result);
$total_page = ceil($total_rows/$limit);

// Getting the maximum id of notice
$notice_select = "SELECT MAX(news_id) FROM news WHERE type=\"notice\";";
$notice_result = mysqli_query($conn, $notice_select);
$row = mysqli_fetch_assoc($notice_result);
$max_value = $row['MAX(news_id)'];
$id = $_GET['notice_id'];
if($id<1 || $id>$max_value){
    header("location:../page_not_found.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices | SSBSS</title>
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
    .news_cards{
      box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
    }
</style>
</head>
<body>
<!-- navigation bar  -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

  <div class="logo text-center">
    <img src="../images/slogo.png" class="logo">
    <p class="headings">Shree Shanti Bhagwati Secondary School</p>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav nav-underline">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="news.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="faculty.php">Faculty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="authorities.php">Authorities</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="admission.php">Admission</a></li>
            <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
            <li><a class="dropdown-item" href="result.php">Results</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- News Section -->
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" href="news.php">News</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="true">Notice</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="download.php">Downloads</a>
      </li>
      <form class="d-flex" role="search">
        <input class="border-primary form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </ul>
  </div>
  <div class="card-body">
 

  
  <?php
    $sql = "SELECT * FROM news WHERE news_id = '$id';";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $news_title = $row['title'];
            $description = $row['src'];
            $upload_date = $row['upload_date'];
            $thumbnail = $row['thumbnail'];
?>
<div class="card mb-3" style="max-width: 70%; margin:auto; border:none;">
  <div class="row g-0">
      <img style="max-height:350px; border-radius:7px;" src="../uploads/images/<?php echo $thumbnail; ?>" class="img-fluid rounded-start" alt="...">
      <div class="card-body">
        <h5 class="card-title display-2"><?php echo $news_title; ?></h5>
        <p class="card-text text-justify"><?php echo $description; ?></p>
        <p class="card-text"><small class="text-body-secondary"><?php echo $upload_date;?></small></p>
      </div>
  </div>
</div>
<?php
        }
    
    }
    ?>
    </div>
</div>


  </div>
</div>




<!-- Modal for viewing news -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width:70vw;">
    <div class="modal-content" style="min-width:100%;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Notice Title Comes Here</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <iframe src="MP-EXP-3.pdf" style="height:70vh;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<!-- Website Footer -->
<hr>
<div class="row">
    <div class="gx-5 gy-5 col-md-4">
        <p class="foot_title display-6 text-center">INFORMATION OFFICER</p>
        <img src="../images/shree_prashad_dhakal.jpg" style="margin-left: 30%;max-width:40%;">
        <p class="foot_title display-6 text-center">Homnath Poudyal</p>
    </div>
    <div class="col-md-4 gx-5 gy-5">
        <p class="foot_title display-6 text-center">CONTACT US</p>
        <p>
          Address : Letang-4, Morang<br>
          Phone : 021-560034<br>
          Email : shantibhagawatiletang2009@gmail.com
        </p>
    </div>
    <div class="col-md-4 gy-5 gx-5">
        <p class="foot_title display-6 text-center">LOCATION</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2723.4279550372253!2d87.50420574853884!3d26.73830469689345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2snp!4v1695029463556!5m2!1sen!2snp" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>