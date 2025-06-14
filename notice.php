<?php
include "script/php_scripts/database.php";
include "script/php_scripts/header_and_footer.php";
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
    <title>Notices | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Style/style.css">
    <link rel="icon" type="icon" href="images/slogo.png">
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
<?php
print_header("news");
?>

<!-- News Section -->
<div class="card text-center">
  <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link" href="news">समचार</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="false">सुचना</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="download">कागजातहरू</a>
        </li>
        <form class="d-flex" role="search" method="post" action="">
            <div class="dropup-center dropup">
              <div style="display:flex; flex-direction:row;">
                  <input class="form-control me-2 border-primary dropdown-toggle" required name="search" type="search" placeholder="खेाज्नुहेास्" aria-label="Search">
                  <input class="btn btn-outline-primary" type="submit" name="submit_search" value="खेाज्नुहेास्">
              </div>
            </div>
        </form>
      </ul>
    </div>
  <?php
  if(array_key_exists('submit_search',$_POST)){// This block is for display results according to users
    $query = mysqli_real_escape_string($conn,$_POST['search']);
    $sql = "SELECT * FROM news WHERE title LIKE '%$query%' AND type='notice' ORDER BY(news_id) DESC;";
    $result = mysqli_query($conn,$sql);
  ?>
  <div class="card text-center">
    <div class="card-body">
  <?php
    if(mysqli_num_rows($result)>0){
      echo "<p class=\"display-6\">खोज परिणामहरू</p>";
    }else{
      echo "<p class=\"display-6\">केहीपनि भेटिएन</p>";
    } 
  ?>
              <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['news_id'];
                        $title = strlen($row['title'])>=35?substr($row['title'],0,31)." ...":$row['title'];
                        $thumbnail = $row['thumbnail'];
                        $upload_date = $row['upload_date'];
                    ?>
                <div class="col">
                  <a href="individual_content.php?notice_id=<?php echo $id; ?>" style="text-decoration:none;">
                  <div class="news_cards card h-100">
                    <img src="uploads/images/<?php echo $thumbnail; ?>" class="h-100 card-img-top" alt="...">
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
              <div class="row row-cols-1 row-cols-md-4 g-4 d-flex justify-content-center align-items-center">
                    <?php
                    $sql = "SELECT * FROM news WHERE type=\"notice\" ORDER BY(news_id) DESC LIMIT 12;";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['news_id'];
                        $title = strlen($row['title'])>=35?substr($row['title'],0,31)." ...":$row['title'];
                        $thumbnail = $row['thumbnail'];
                        $upload_date = $row['upload_date'];
                    ?>
                <div class="col">
                  <a href="individual_content.php?notice_id=<?php echo $id; ?>" style="text-decoration:none;">
                  <div class="news_cards card h-100">
                    <img src="uploads/images/<?php echo $thumbnail; ?>" class="h-100 card-img-top" alt="...">
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
    
  <br><br>
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
<?php
print_footer();
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>