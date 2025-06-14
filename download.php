<?php
include "script/php_scripts/database.php";
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads | SSBSS</title>
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
        <a class="nav-link" href="notice">सुचना</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="ture">कागजातहरू</a>
      </li>
      <form class="d-flex" role="search">
        <input class="border-primary form-control me-2" type="search" placeholder="खेाज्नुहेास्" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit_search">खेाज्नुहेास्</button>
      </form>
    </ul>
  </div>
  <div class="card-body">
  <?php
    if(array_key_exists('submit_search',$_POST)){// This block is for display results according to users
    $query = mysqli_real_escape_string($conn,$_POST['search']);
    $sql = "SELECT * FROM documents WHERE doc_title LIKE '%$query%'";
    $result = mysqli_query($conn,$sql);
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
                        $id = $row['doc_id'];
                        $title = $row['doc_title'];
                        $upload_date = $row['upload_date'];
                    ?>
                    <div class="col gx-5" style="max-height:100px; border:1px solid lightgrey;">
                        <a class="row" style="text-decoration: none;"  href="individual_content.php?doc_id=<?php echo $id?>">
                          <div class="col-md-4 bg-info text-light">
                            <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                            <p class="text-center text-dark"><?php echo $upload_date; ?></p>
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <p class="card-text"><?php echo $title;?></p>
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
              <div class="row row-cols-2 gap-3 d-flex justify-content-center align-items-center">
                    <?php
                    $sql = "SELECT * FROM documents ORDER BY doc_id DESC";
                    $result = mysqli_query($conn,$sql); 
                    if($result){
                      while($row = mysqli_fetch_assoc($result)){
                        $id = $row['doc_id'];
                        $title = $row['doc_title'];
                        $upload_date = $row['upload_date'];
                    ?>
                      <div class="col" style="max-height:100px; border:1px solid lightgrey;">
                          <a class="row" style="text-decoration: none;"  href="individual_content.php?doc_id=<?php echo $id?>">
                            <div class="col-md-4 bg-info text-light">
                              <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                              <p class="text-center text-dark"><?php echo $upload_date; ?></p>
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <p class="card-text"><?php echo $title;?></p>
                              </div>
                            </div>
                          </a>
                      </div>
                    <?php
                        }
                      }
                    ?>
              </div>
  <?php
  }

  ?>
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