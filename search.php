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
<!-- News Section -->
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
                <button class="btn btn-outline-primary" type="submit" name="submit_search">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg>
                </button>
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
</div>

<!-- Website Footer -->
<?php
include "script/php_scripts/header_and_footer.php";
print_footer("images/");
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