<?php
include "connection.php";

// This variables is for service section
  $first_service_title = "School Environment";
  $first_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">Clean environment with huge playground.</li>
    <li class="list-group-item">Well organized Classroom.</li>
    <li class="list-group-item">School based health supports</li>
    <li class="list-group-item">24 hours CCTV monitoring system.</li>
  </ol>';
  $first_image_link = "images/front_wallpapers/english medium.jpg";

  $second_service_title = "Education System";
  $second_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">Six faculty including Technical faculty.</li>
    <li class="list-group-item">Library with different collection of books.</li>
    <li class="list-group-item">Well equiped labs for practical knowledge.</li>
    <li class="list-group-item">Full scholarship to the toppers.</li>
  </ol>';
  $second_image_link = "images/entrance_examination_ce.jpg";

  $third_service_title = "Other Essential Activities";
  $third_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">Daily quiz and speech in the assembly.</li>
    <li class="list-group-item">Weekly sports and ECA.</li>
    <li class="list-group-item">Monthly subjectwise class test.</li>
    <li class="list-group-item">Teachers Meetup with students and parents.</li>
  </ol>';
  $third_image_link = "images/smart_board.jpg";

// This variables is for principal few words section
  $principal_name = "Shree Prashad Dhakal";
  $principal_image_src = "images/shree_prashad_dhakal.jpg";
  $few_words_by_principal = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$limit = 6;
$page = isset($_GET['page'])? $_GET['page']:1;
$start = ($page-1)*$limit;
$previous = $page -1;
$next = $page + 1;
$sql = "SELECT * FROM news WHERE type =\"news\";";
$result = mysqli_query($conn,$sql);
$total_rows = mysqli_num_rows($result);
$total_page = ceil($total_rows/$limit);
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
      .online_btn{
        margin: 10px;
        margin: auto;
        max-width: 100%;
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
      .overflow_control{
        max-height:350px;
        overflow-x:hidden;
        overflow-y:scroll;
        padding-top:10px;
        padding-left:20px;
      }
      .page_pagination{
        margin-top:10px;
      }
      .modal_image{
        max-width:100%;
      }
      .news_head{
        overflow-y: hidden;
      }
      body{
        overflow-x: hidden;
      }
      .more_image_btn{
        text-shadow: none;
        position: absolute;
        bottom: 30px;
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
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
  <a href="category/gallery.php" class="btn btn-primary more_image_btn">+ More</a>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="images/front_wallpapers/ssbss_entry_gate.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">School's Entry Gate</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/english medium.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Building Of English Medium</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/see_students.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Students With Teachers</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/school.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">Clean School Environment</h5>
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
      <div class="row" id="news_container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <?php
          $sql = "SELECT * FROM news WHERE type=\"news\" ORDER BY news_id DESC LIMIT $start, $limit;";
          $result = mysqli_query($conn, $sql);
          $number_of_rows = mysqli_num_rows($result);
          if($result){
            while($row = mysqli_fetch_assoc($result)){
              $id = $row['news_id'];
              $title = $row['title'];
              $thumbnail = $row['thumbnail'];
              $upload_date = $row['upload_date'];
          ?>
          <div class="col">
            <a  href="category/individual_news.php?news_id=<?php echo $id;?>" style="text-decoration:none;">
            <div class="card news_cards news_head">
              <img src="uploads/images/<?php echo $thumbnail; ?>" class="card-img-top news_img" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <p class="text-body-secondary"><?php echo $upload_date; ?></p>
              </div>
            </div>
            </a>
          </div>
          <?php
            }
          }
          ?>
        </div>
        <nav class="page_pagination d-flex justify-content-center">
          <ul class="pagination">
            <?php
            if(($previous+1)==1){
            ?>
            <li class="page-item disabled">
              <a class="page-link">
                <span aria-hidden="true">&laquo;</span>  
              </a>
            </li>
            <?php
            }
             if(($previous+1)>=2){
            ?>
            <li class="page-item">
              <a class="page-link" href="index.php?page=<?php echo $previous; ?>">
              <span aria-hidden="true">&laquo;</span>  
            </a>
            </li>
            <?php
            }
            for($i=1; $i<=3; $i++){
              $previous++;
              if($previous<=$total_page){
            ?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $previous ?>"><?php echo $previous;?></a></li>
            <?php
              }else if($previous>$total_page){
            ?>
            <li class="page-item disabled"><a class="page-link" href="index.php?page=<?php echo $previous ?>"><?php echo $previous;?></a></li>
            <?php
              }
            }
            if(($next-1)<$total_page){
              // echo "one";
            ?>
            <li class="page-item">
              <a class="page-link" href="index.php?page=<?php echo $next; ?>">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php 
            }
            if(($next-1)>=$total_page){
            ?>
            <li class="page-item disabled">
              <a class="page-link" href="index.php?page=<?php echo $next; ?>">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php
            }
            ?>

          </ul>
        </nav>
      </div>
    </div>
    <div class="g-5 col-md-4">
      <div class="controls row">
      <p class="display-6  col-9">Notice</p>
      <a href="category/notice.php" class="btn btn-warning col col-3">+More</a>
      </div><br>
      <div class="row overflow_control">
        <?php
          $sql = "SELECT * FROM news WHERE type=\"notice\" ORDER BY news_id DESC LIMIT 5";
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
      <div class="downloads" style="margin-top:5px;">
          <div class="controls row">
          <p class="display-6  col-9">Downloads</p>
          <a href="category/download.php" class="btn btn-warning col col-3">+More</a>
          </div><br>
          <div class="col overflow_control">
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
    </div>
</div><br>


<!-- Our Services -->
<p class="text-center display-6">Our Facility</p>
<div class="row row-cols-1 row-cols-md-3">
  <div class="col gx-5">
    <div class="news_cards card h-100"  type="button" data-bs-toggle="modal" data-bs-target="#service_one">
      <img src="<?php echo $first_image_link; ?>" class="card-img-top h-100" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $first_service_title; ?></h5>
        <p class="card-text"><?php echo $first_description; ?></p>
      </div>
    </div>
  </div>
  <div class="col gx-5">
    <div class="card h-100 news_cards" type="button" data-bs-toggle="modal" data-bs-target="#service_two">
      <img src="<?php echo $second_image_link; ?>" class="card-img-top h-100" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $second_service_title; ?></h5>
        <p class="card-text"><?php echo $second_description; ?></p>
      </div>
    </div>
  </div>
  <div class="col gx-5">
    <div class="card h-100 news_cards" type="button" data-bs-toggle="modal" data-bs-target="#service_three">
      <img src="<?php echo $third_image_link; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $third_service_title; ?></h5>
        <p class="card-text"><?php echo $third_description; ?></p>
      </div>
    </div>
  </div>
</div><br><br>

<!-- This is principal section -->
<div class="row row-cols-1 row-cols-md-2 news_cards" style="border-radius: 10px; padding: 10px;max-width:95%; border: 1px solid lightgrey; margin:auto">
  <div class="col gx-5 head_teacher">
    <img src="<?php echo $principal_image_src; ?>" style="border-radius: 10px;max-width:100%;">
  </div>
  <div class="col gx-5">
    <div class="headteacher_heading" style="padding:10px;">
      <p class="display-6"><?php echo $principal_name; ?></p>
      <p class="text-body-secondary" style="font-size:20px; margin-top:-10px;">Principal</p>
    </div>
    <div class="card-text" style="padding: 10px; font-size: 20px; text-align:justify; max-height:155px; overflow:hidden;">
      <?php echo $few_words_by_principal; ?>
    </div>
    <div class="head_teacher_control" style="display: flex; flex-direction: column;padding-left:10px; font-size:25px;">
      . . . . . .
      <button class="btn btn-primary"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#principal_modal" style="margin-top:20px;">Read More</button>
      
    </div>
  </div>
</div><br><br>

<!-- Our Online service -->
<div class="card text-bg-dark news_cards" style="max-height:400px; max-width:95%; margin:auto;">
  <img src="images/online_services.jpg" style="max-height:400px;" class="card-img">
  <div class="card-img-overlay d-flex align-items-center bg-dark bg-opacity-75">
    <div class="w-100">
        <h5 class="display-6 text-center">Online Services</h5>
        <div class="row row-cols-1 row-cols-sm-3 d-flex justify-content-center align-item-center">
          <div class="col g-1">
           <a href="category/more/admission.php" class="btn btn-primary online_btn w-100">Online Admission</a> 
          </div>
          <div class="col g-1">
           <a href="category/more/result.php" class="btn btn-primary online_btn w-100">Examination Result</a> 
          </div>
          <div class="col g-1">
           <a href="category/contact.php" class="btn btn-primary online_btn w-100">Contact Us</a> 
          </div>
        </div>
      </div>
  </div>
</div>

<!-- Modal for service section-->
<div class="modal fade" id="service_one" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel1"><?php echo $first_service_title; ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo $first_image_link;?>" class="modal_image">
        <?php echo $first_description; ?>
      </div>
    </div>
  </div>
</div>
<!-- Modal for second services -->
<div class="modal fade" id="service_two" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel2"><?php echo $second_service_title; ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo $second_image_link;?>" class="modal_image">
        <?php echo $second_description; ?>
      </div>
    </div>
  </div>
</div>
<!-- Third service Model -->
<div class="modal fade" id="service_three" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel3"><?php echo $third_service_title;?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo $third_image_link; ?>" class="modal_image">
        <?php echo $third_description; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal for principal read more button-->
<div class="modal fade" id="principal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabelprincipal">Few Words From Principal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo $principal_image_src; ?>" style="max-width: 100%;">
        <div class="principal_content">
          <p class="display-6"><?php echo $principal_name; ?></p>
          <p class="card-text" style="text-align:justify;">
            <?php echo $few_words_by_principal;?>
          </p>
        </div>
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