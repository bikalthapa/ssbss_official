<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News | SSBSS</title>
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
<nav class=" navbar navbar-expand-lg bg-body-tertiary">
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

<!-- News section -->
<div class="card text-center">
  <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="true">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notice.php">Notice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="download.php">Downloads</a>
        </li>
        <form class="d-flex" role="search" method="post" action="">
            <div class="dropup-center dropup">
              <div style="display:flex; flex-direction:row;">
                  <input class="form-control me-2 border-primary dropdown-toggle" required name="search" type="search" placeholder="Search" aria-label="Search">
                  <input class="btn btn-outline-primary" type="submit" name="submit_search" value="Search">
              </div>
              <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Action two</a></li>
                <li><a class="dropdown-item" href="#">Action three</a></li>
              </ul>
            </div>
        </form>
      </ul>
    </div>
  <?php
  if(array_key_exists('submit_search',$_POST)){// This block is for display results according to users
    $query = $_POST['search'];
    $sql = "SELECT * FROM news WHERE title LIKE '%$query%' AND type='news' ORDER BY(news_id) DESC;";
    $result = mysqli_query($conn,$sql);
  ?>
  <div class="card text-center">
    <div class="card-body">
  <?php
    if(mysqli_num_rows($result)>0){
      echo "<p class=\"display-6\">Search Results</p>";
    }else{
      echo "<p class=\"display-6\">No Match Found</p>";
    } 
  ?>
              <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['news_id'];
                        $title = $row['title'];
                        $thumbnail = $row['thumbnail'];
                        $upload_date = $row['upload_date'];
                    ?>
                <div class="col">
                  <a href="individual_news.php?news_id=<?php echo $id; ?>" style="text-decoration:none;">
                  <div class="news_cards card h-100">
                    <img src="../uploads/images/<?php echo $thumbnail; ?>" class="h-100 card-img-top" alt="...">
                    <div class="card-img-overlay">
                    <p class="bg-dark text-light bg-opacity-50"><?php echo $upload_date; ?></p>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $title; ?></h5>
                    </div>
                  </div>
                  </a>
                </div>
                    <?php
                        }
                      }
                    ?>
              </div>
    </div>
  </div>
  <?php
  }else{// This block is for displaying all news if user doesn't search
  ?>
    <div class="card-body">
      <p class="display-6">Recommended</p>
          <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
              $counter = 0;
              $sql = "SELECT * FROM news WHERE type=\"news\" ORDER BY news_id DESC;";
              $result = mysqli_query($conn, $sql);
              if($result && mysqli_num_rows($result)>2){
                for($i = 0; $i<2; $i++){
                  $row = mysqli_fetch_assoc($result);
                  $id = $row['news_id'];
                  $title = $row['title'];
                  $thumbnail = $row['thumbnail'];
            ?>
            <div class="col" style="max-height:300px; overflow:hidden;">
              <a href="individual_news.php?news_id=<?php echo $id; ?>">
              <div class="card news_cards">
                  <div class="card-img-overlay">
                    <h5 class="display-6 card-title bg-dark text-light bg-opacity-50"><?php echo $title; ?></h5>
                  </div>
                  <img src="../uploads/images/<?php echo $thumbnail; ?>" class="card-img" alt="...">
              </div>
              </a>
            </div>
            <?php
                }
              }
            ?>
          </div>

          <p class="display-6">Previously Uploaded</p>
              <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    $sql = "SELECT * FROM news WHERE type=\"news\" ORDER BY(news_id) DESC LIMIT 12;";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['news_id'];
                        $title = $row['title'];
                        $thumbnail = $row['thumbnail'];
                        $upload_date = $row['upload_date'];
                    ?>
                <div class="col">
                  <a href="individual_news.php?news_id=<?php echo $id; ?>" style="text-decoration:none;">
                  <div class="news_cards card h-100">
                    <img src="../uploads/images/<?php echo $thumbnail; ?>" class="h-100 card-img-top" alt="...">
                    <div class="card-img-overlay">
                    <p class="bg-dark text-light bg-opacity-50"><?php echo $upload_date; ?></p>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $title; ?></h5>
                    </div>
                  </div>
                  </a>
                </div>
                    <?php
                        }
                      }
                    ?>
              </div>
    </div>
  <?php
  }
  ?>
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
<script type="text/javascript">
  function close_news_model(){
    document.getElementById("staticBackdrop").style.display = "none";
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>