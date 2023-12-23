<?php
include "connection.php";
include "script/php_scripts/header_and_footer.php";

// This variables is for service section
  $first_service_title = "विधालय वातावरण";
  $first_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">विशाल खेल मैदान र स्वच्छ वातावरण।</li>
    <li class="list-group-item">व्यवस्थित कक्षाकोठा</li>
    <li class="list-group-item">विद्यालयमा आधारित स्वास्थ्य सेवा</li>
    <li class="list-group-item">२४ सै घण्टा सिसीटिभी निग्रानी सेवा ।</li>
  </ol>';
  $first_image_link = "images/front_wallpapers/english medium.jpg";

  $second_service_title = "शिक्षा प्रणाली";
  $second_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">प्राविधिक संकाय सहित ६ संकाय।<li>
    <li class="list-group-item">पुस्तकहरूको विभिन्न संग्रहको साथ पुस्तकालय।</li>
    <li class="list-group-item">व्यावहारिक ज्ञानको लागि राम्रो तरिकाले सुसज्जित प्रयोगशालाहरू।
</li>
    <li class="list-group-item">छात्रवृत्ति वितरण कार्यक्रम।</li>
  </ol>';
  $second_image_link = "images/entrance_examination_ce.jpg";

  $third_service_title = "अन्य महत्वपुर्ण कृयाकलापहरु";
  $third_description = '<ol class="list-group list-group-numbered">
    <li class="list-group-item">दैनिक हाजीरीजबाफ र वक्तृत्वकला ।</li>
    <li class="list-group-item">साप्ताहिक खेलाई ।</li>
    <li class="list-group-item">मासिक विषयगत कक्षा परीक्षा।</li>
    <li class="list-group-item">शिक्षकहरू विद्यार्थी र अभिभावक  बिच भेला।</li>
  </ol>';
  $third_image_link = "images/smart_board.jpg";

// This variables is for principal few words section
  $principal_name = "श्री प्रशाद ढकाल";
  $principal_image_src = "images/authorities_img/school_head_teacher.jpg";
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
<?php
print_header(0,"home");
?>

<!-- Image carosel section -->
<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
  <a href="category/gallery.php" class="btn btn-primary more_image_btn">+ अन्य तस्विर</a>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="images/front_wallpapers/ssbss_entry_gate.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">विधालय प्रवेशद्वार</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/english medium.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">विधालय प्राँगण</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/see_students.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">शिक्षकसँग विधार्थीहरु</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/front_wallpapers/school.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 bg-dark text-light bg-opacity-75">विद्यालयको स्वच्छ वातावरण</h5>
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
          <p class="display-6 col col-9">समचार</p>
          <a href="category/news.php" class="btn btn-warning col col-3">+ अन्य</a>
      </div><br>
      <div class="row" id="news_container">
        <div class="row row-cols-1 row-cols-md-2 g-4 d-flex justify-content-center align-item-center">
          <?php
            $sql = "SELECT * FROM news WHERE type=\"news\" ORDER BY news_id DESC LIMIT $start, $limit;";
            $result = mysqli_query($conn, $sql);
            $number_of_rows = mysqli_num_rows($result);
            if($result){
              if($number_of_rows>0){// News is published
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['news_id'];
                  $title = strlen($row['title'])>=35?substr($row['title'],0,31)." ...":$row['title'];
                  $thumbnail = $row['thumbnail'];
                  $upload_date = $row['upload_date'];
                  ?>
                    <div class="col">
                      <a  href="category/individual_content.php?news_id=<?php echo $id;?>" style="text-decoration:none;">
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
              }else{//News is not published
                ?>
                <div class="col">
                  <div class="display-6 text-center">Nothing Published</div>
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
      <p class="display-6  col-9">सुचना</p>
      <a href="category/notice.php" class="btn btn-warning col col-3">+ अन्य</a>
      </div><br>
      <div class="row overflow_control">
        <?php
          $sql = "SELECT * FROM news WHERE type=\"notice\" ORDER BY news_id DESC LIMIT 5";
          $result = mysqli_query($conn,$sql);
          if($result){
            while($row = mysqli_fetch_assoc($result)){
              $id = $row['news_id'];
              $date = $row['upload_date'];
              $title = $row['title'];
        ?>
            <div class="mb-3" style="border: 1px solid lightgrey;max-height:100px;">
              <a class="row" style="text-decoration: none;" href="category/individual_content.php?notice_id=<?php echo $id?>">
                <div class="col-md-4 bg-info text-light">
                  <p class="text-center text-dark"><?php echo $date; ?></p>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <p class="card-text"><?php echo $title; ?></p>
                  </div>
                </div>
              </a>
            </div>
        <?php
            }
          }
        ?>
      </div>
      <!-- Download Section of notice board -->
      <div class="downloads" style="margin-top:5px;">
          <div class="controls row">
          <p class="display-6  col-9">कागजातहरू</p>
          <a href="category/download.php" class="btn btn-warning col col-3">+ अन्य</a>
          </div><br>
          <div class="col overflow_control">
              <?php
                $sql = "SELECT * FROM documents ORDER BY doc_id DESC LIMIT 15";
                $result = mysqli_query($conn,$sql);
                if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    $id = $row['doc_id'];
                    $date = $row['upload_date'];
                    $title = $row['doc_title'];
              ?>
            <div class="mb-3" style="max-height:100px; border:1px solid lightgrey;">
                <a class="row" style="text-decoration: none;"  href="category/individual_content.php?doc_id=<?php echo $id?>">
                  <div class="col-md-4 bg-info text-light">
                    <span class="absolute top-0 start-100 translate-middle badge bg-danger">PDF</span>
                    <p class="text-center text-dark"><?php echo $date; ?></p>
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
</div><br>


<!-- Our Services -->
<p class="text-center display-6">हाम्रो सुविधाहरु</p>
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
      <p class="text-body-secondary" style="font-size:20px; margin-top:-10px;">प्रधानअध्यापक</p>
    </div>
    <div class="card-text" style="padding: 10px; font-size: 20px; text-align:justify; max-height:155px; overflow:hidden;">
      <?php echo $few_words_by_principal; ?>
    </div>
    <div class="head_teacher_control" style="display: flex; flex-direction: column;padding-left:10px; font-size:25px;">
      . . . . . .
      <button class="btn btn-primary"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#principal_modal" style="margin-top:20px;">अझै पड्नुहोस्</button>
      
    </div>
  </div>
</div><br><br>

<!-- Our Online service -->
<div class="card text-bg-dark news_cards" style="max-height:400px; max-width:95%; margin:auto;">
  <img src="images/online_services.jpg" style="max-height:400px;" class="card-img">
  <div class="card-img-overlay d-flex align-items-center bg-dark bg-opacity-75">
    <div class="w-100">
        <h5 class="display-6 text-center">अनलाइन सेवाहरू</h5>
        <div class="row row-cols-1 row-cols-sm-3 d-flex justify-content-center align-item-center">
          <div class="col g-1">
           <a href="category/more/admission" class="btn btn-primary online_btn w-100">अनलाइन भर्ना</a> 
          </div>
          <div class="col g-1">
           <a href="category/more/result" class="btn btn-primary online_btn w-100">परिक्षाफल</a> 
          </div>
          <div class="col g-1">
           <a href="category/contact" class="btn btn-primary online_btn w-100">सम्पर्क गर्नुहोस</a> 
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
        <h1 class="modal-title fs-5" id="staticBackdropLabelprincipal">प्रधानअध्यापकको भनाईहेरु</h1>
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

<!-- Modal for recent notice -->
<button type="button" id="recent_notice_viewer_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notice_popup">
  हालैको सूचना
</button>
<div class="modal fade" id="notice_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">हालैको सूचना</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
          $sql = "SELECT * FROM news WHERE type = \"notice\" ORDER BY news_id DESC LIMIT 2";
          $result = mysqli_query($conn,$sql);
          if($result){
            while($row = mysqli_fetch_assoc($result)){
              $id = $row['news_id'];
              $title = $row['title'];
              $date = $row['upload_date'];
              $description = file_get_contents("uploads/news_descr/".$row['src']);
              $thumbnail = 'uploads/images/'.$row['thumbnail'];
        ?>
        <div class="container"> 
          <p style="font-size:20px;"><?php echo $title; ?></p>
          <p class="text-secondary" style="margin-top:-10px;"><?php echo $date; ?></p>
          <p style="text-align:justify;"><?php echo $description; ?></p>
          <div class="notices_slider" style="display: flex; flex-direction: row;max-width:100%; overflow-x:auto;">
            <!-- image slider for notice  -->
            <div id="carouselExampleFade<?php echo $id?>" class="carousel slide carousel-fade">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?php echo $thumbnail; ?>" class="d-block w-100" alt="...">
                </div>
                <?php
                 $img_sql = "SELECT * FROM news_img WHERE news_id = '$id'";
                 $img_result = mysqli_query($conn, $img_sql);
                 if($img_result){
                  while($img_row = mysqli_fetch_assoc($img_result)){
                    $filename = 'uploads/images/'.$img_row['filename'];
                    ?>
                      <div class="carousel-item">
                        <img src="<?php echo $filename?>" class="d-block w-100" alt="...">
                      </div>           
                    <?php
                  }
                 }
                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade<?php echo $id?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade<?php echo $id?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div><br>
        <?php
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- Website Footer -->
<?php
print_footer("images/");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<?php
if(!isset($_GET['page'])){
?>
<script>
  $("#recent_notice_viewer_btn").hide();
  $(document).ready(function(){
    setTimeout(()=>{
      $("#recent_notice_viewer_btn").click();
    },2000);
  });
</script>
<?php
}else{
  ?>
<script>
  $("#recent_notice_viewer_btn").hide();
</script>
  <?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>