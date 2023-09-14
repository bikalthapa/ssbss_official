<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<style>
    .logo{
        display:flex;
        flex-direction:row;
        margin-bottom:2px;
    }
    .logo img{
        height:10%;
        margin-right:2%;
        width:10%;
        border-radius:100%;
        border:1px solid black;
    }
    .headings{
        font-size:20px;
        margin-top:3%;
    }
    /* .carousel{
      height:90%;
      width:100%;
    } */
    .carousel > .carousel-inner > .carousel-item > img{
    width:240px; /* Yeap you can change the width and height*/
    height:400px;
}
.carousel-caption{
  position:absolute;
  top:60%;
  text-shadow:5px 5px 5px;
}
/* .news_btn_container{
  display:flex;
  flex-direction:row;
} */
/* .tabs{
  display:flex;
  flex-direction:row;
  max-height:40px;
  background-color:lightgrey;
  padding-bottom:5px;
} */
.controls{
  display:flex;
  flex-direction:row;
  max-height:40px;
  min-width:45%;
  background-color:#dbdbdb;
}
/* .controls a{
  position:absolute;
  right:0px;
} */
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

  <div class="logo text-center">
    <img src="images/slogo.png" class="logo">
    <p class="headings">Shree Shanti Bhagwati Secondary School</p>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/admission.php">Admission</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/result.php">Results</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Authorities</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About Us
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Message From Head Teacher</a></li>
            <li><a class="dropdown-item" href="#">Faculty</a></li>
            <li><a class="dropdown-item" href="#">Gallery</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Image carosel section -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/students_with_teachers.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Students With Teachers</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/english medium.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Clean School Environment</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/school.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- news and notice -->\
<!-- <div class="news_btn_container col">
  <div class="news_tab tabs position-relative col-9">
    <p class="display-6" style="margin-bottom:3px;">News</p>
    <a class="btn btn-warning position-absolute top-0 end-0" href="#">+ More</a>
  </div>
  <div class="tabs position-relative col-3">
    <p class="display-6">Notice</p>
    <a class="btn btn-warning position-absolute top-0 end-0">+ More</a>
  </div>
</div> -->
<div class="container text-center">
  <div class="row">
    <div class="col col-9">
      <div class="controls">
      <p class="display-6">News</p>
      <a class="btn btn-warning">+ More</a>
      </div>
    </div>
    <div class="col col-3">
      <div class="controls">
      <p class="display-6">Notice</p>
      <a href="#" class="btn btn-warning">+More</a>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>