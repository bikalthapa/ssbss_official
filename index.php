<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSBSS | Home</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Style/style.css">
    <link rel="icon" type="icon" href="../images/slogo.png">
<style>
    .controls{
        max-height:40px;
        min-width:45%;
        background-color:#dbdbdb;
        overflow: hidden;
    }
    .circle_image{
        margin: auto;
        background-color: white;
        border-radius: 100%;
        height: 100px;
        width: 100px;
    }
    .counter_title{
      font-size: 20px;
      text-align: center;
    }
    .counter_div{
      margin-top: 10px;
    }
    .news_cards{
      box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
    }
</style>
</head>
<body>
<!-- navigation bar of index page  -->
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
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/news.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/contact.php">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/faculty.php">Faculty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/authorities.php">Authorities</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="category/admission.php">Admission</a></li>
            <li><a class="dropdown-item" href="category/gallery.php">Gallery</a></li>
            <li><a class="dropdown-item" href="category/result.php">Results</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Image carosel section -->
<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2000">
      <img src="images/english medium.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Building Of English Medium</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="images/school.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Clean School Environment</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="images/students_with_teachers.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Science Students With Teachers</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- News and notices -->
  <div class="row w-100" style="margin-top:5px; margin-left:2px;">
    <div class="g-5 col-md-8">
      <div class="controls row">
          <p class="display-6 col col-9">News</p>
          <a href="category/news.php" class="btn btn-warning col col-3">+ More</a>
      </div><br>
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
        $sql = "SELECT * FROM news WHERE type=\"news\" ORDER BY news_id DESC;";
        $result = mysqli_query($conn, $sql);
        if($result){
          while($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $thumbnail = $row['thumbnail'];
            $upload_date = $row['upload_date'];
        ?>
        <div class="col">
          <div class="card news_cards">
            <img src="uploads/images/<?php echo $thumbnail; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $title; ?></h5>
              <p class="text-body-secondary"><?php echo $upload_date; ?></p>
            </div>
          </div>
        </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
    <div class="g-5 col-md-4">
      <div class="controls row">
      <p class="display-6  col-9">Notice</p>
      <a href="category/notice.php" class="btn btn-warning col col-3">+More</a>
      </div><br>
      <div class="row">
        <?php
          $sql = "SELECT * FROM news WHERE type=\"notice\" ORDER BY news_id DESC";
          $result = mysqli_query($conn,$sql);
          if($result){
            while($row = mysqli_fetch_assoc($result)){
              $date = $row['upload_date'];
              $title = $row['title'];
        ?>
            <div class="mb-3" style="border: 1px solid lightgrey;max-height:100px;">
              <div class="row">
                <div class="col-md-4 bg-info text-light">
                  <p class="text-center text-dark"><?php echo $date; ?></p>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text"><?php echo $title; ?></p>
                  </div>
                </div>
              </div>
            </div>
        <?php
            }
          }
        ?>
      </div>
      <!-- Download Section of notice board -->
      <div class="downloads">
          <div class="controls row">
          <p class="display-6  col-9">Downloads</p>
          <a href="category/download.php" class="btn btn-warning col col-3">+More</a>
          </div><br>
            <div class="mb-3" style="max-height:100px; border:1px solid lightgrey;">
              <div class="row">
                <div class="col-md-4 bg-info text-light">
                  <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                  <p class="text-center text-dark">Dates</p>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text">Third Terminal Examination from 2073
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3" style="max-height:100px; border:1px solid lightgrey;">
              <div class="row">
                <div class="col-md-4 bg-info text-light">
                  <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                  <p class="text-center text-dark">Dates</p>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text">Third Terminal Examination from 2073</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3" style="max-height:100px; border:1px solid lightgrey;">
              <div class="row">
                <div class="col-md-4 bg-info text-light">
                  <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                  <p class="text-center text-dark">Dates</p>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text">Third Terminal Examination from 2073</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div><br>

<!-- Counter Section -- Used for counting teachers, students, etc. -->
<div class="counter_div row row-cols-1 row-cols-md-2" onmouseover="start_counting()">
  <div class="col gx-5">
    <div class="card h-100 news_cards">
      <img src="images/icon/students_icon.png" class="circle_image card-img-top" alt="...">
      <div class="card-body">
        <h5 class="display-6 text-center">2,723 +</h5>
        <p class="counter_title">Students</p>
      </div>
    </div>
  </div>
  <div class="col gx-5">
    <div class="card h-100 news_cards">
      <img src="images/icon/teachers.jpg" class="circle_image card-img-top" alt="...">
      <div class="card-body">
        <h5 class="display-6 text-center">100 +</h5>
        <p class="counter_title">Experience Teachers</p>
      </div>
    </div>
  </div>
</div>


<p class="text-center display-6">Our Services</p>
<!-- Our Services -->
<div class="row row-cols-1 row-cols-md-3">
  <div class="col">
    <div class="news_cards card h-100">
      <img src="images/english medium.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Clean Environment</h5>
        <p class="card-text">We provide quality education to our students in a clean school environment.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 news_cards">
      <img src="images/entrance_examination_ce.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Well Furnished Classroom</h5>
        <p class="card-text">We have well furnished and clean Classroom too. It will help in better learning for students.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 news_cards">
      <img src="images/class_9_c_lab.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">ICT Oriented Teaching</h5>
        <p class="card-text">We are making our students understand the contents with the help of ICT.</p>
      </div>
    </div>
  </div>
</div>

<!-- Website Footer -->
<hr>
<div class="row">
    <div class="gx-5 gy-5 col-md-4">
        <p class="foot_title display-6 text-center">INFORMATION OFFICER</p>
        <img src="images/shree_prashad_dhakal.jpg" style="margin-left: 30%;max-width:40%;">
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