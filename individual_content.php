<?php
include "script/php_scripts/database.php";
include "script/php_scripts/header_and_footer.php";
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
<?php
$news_status =  isset($_GET['news_id'])?'active':'';
$notice_status = isset($_GET['notice_id'])?'active':'';
$document_status =  isset($_GET['doc_id'])?'active':'';
?>
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link <?php echo $news_status; ?>" href="news">समचार</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $notice_status; ?>" href="notice">सुचना</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $document_status; ?>" href="download">कागजातहरु</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
<?php
  if(isset($_GET['news_id']) || isset($_GET['notice_id'])){
    $id = isset($_GET['news_id'])?$_GET['news_id']:$_GET['notice_id'];
    $sql = "SELECT * FROM news WHERE news_id = '$id';";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $news_title = $row['title'];
            $description = file_get_contents("../uploads/news_descr/".$row['src']);
            $upload_date = $row['upload_date'];
            $thumbnail = $row['thumbnail'];
    ?>
            <div class="card mb-3" style="max-width: 50%; margin:auto; border:none;">
              <div class="row g-0">
                  <div class="card-body">
                    <h5 class="card-title text-start display-4"><?php echo $news_title; ?></h5>
                    <p class="card-text text-start"><small class="text-body-secondary"><?php echo $upload_date;?></small></p>
                    <p class="card-text text-start"><?php echo $description; ?></p>
                  </div>
                  <img style="max-height:350px; border-radius:7px;" src="../uploads/images/<?php echo $thumbnail; ?>" class="img-fluid rounded-start" alt="...">

                  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <?php
                        $img_retrive_sql = "SELECT * FROM news_img WHERE news_id = '$id';";
                        $img_result = mysqli_query($conn, $img_retrive_sql);
                        if($img_result){
                          while($img_row = mysqli_fetch_assoc($img_result)){
                            $img_filename = $img_row['filename'];
                      ?>
                      <div class="carousel-item active" data-bs-interval="3000">
                        <img src="../uploads/images/<?php echo $img_filename;?>" class="d-block w-100" alt="...">
                      </div>
                      <?php
                          }
                        }
                      ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>

                </div>
            </div>
    <?php
          }
      }
  }else if(isset($_GET['doc_id'])){
    $id = $_GET['doc_id'];
    $sql = "SELECT * FROM documents WHERE doc_id = \"$id\"";
    $result = mysqli_query($conn, $sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $title = $row['doc_title'];
        $file_name = $row['doc_file'];
        $date = $row['upload_date'];
  ?>
            <div class="card mb-3" style="max-width:80%; max-height: 100%; margin:auto; border:none;">
              <div class="row g-0">
                  <div class="card-body">
                    <h5 class="card-title text-start display-4"><?php echo $title; ?></h5>
                    <p class="card-text text-start"><small class="text-body-secondary"><?php echo $date;?></small></p>
                  </div>
                  <iframe style="border-radius:7px; min-height:500px;" src="../uploads/documents/<?php echo $file_name; ?>"></iframe>
              </div>
            </div>
  <?php
      }
    }
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