<?php
require_once 'script/php_scripts/Database.php';
require_once 'script/php_scripts/newsPortal.php';
require_once 'script/php_scripts/ui/pagination.php';
require_once 'script/php_scripts/ui/cards.php';
include "script/php_scripts/header_and_footer.php";

// Define parameters
$newsPortal = new NewsPortal($db);
$newsPortal->setCurrentPage($_GET['page'] ?? 1);
$newsPortal->setLimit(6);

$news = $newsPortal->getNews('?page=');
$newsData = $news['data'];
$pagination = $news['pagination'];



$portal = new NewsPortal($db);
$portal->setCurrentPage($_GET['page'] ?? 1);

$notices = $portal->getNotices(); // You can also pass base URL if needed
$noticeData = $notices['data'];

$document = $portal->getDocuments();
$documentData = $document['data'];


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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SSBSS | Home</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="Style/style.css">
  <link rel="stylesheet" type="text/css" href="Style/index.css">
  <link rel="icon" type="icon" href="../images/slogo.png">
</head>

<body>
  <!-- navigation bar of index page  -->
  <?php
  print_header(0, "home");
  ?>

  <!-- Image carosel section -->
  <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3"
        aria-label="Slide 4"></button>
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
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- News and notices -->
  <div class="container">
    <div class="row w-100">
      <div class="g-5 col-md-8">

        <div class="hstack section">
          <div class="p-2 pt-4">
            <p class="title">समचार</p>
          </div>
          <div class="ms-auto"></div>
          <a href="category/news.php" class="more_btn">
            <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
            अन्य
          </a>
        </div><br>

        <div class="row row-cols-1 row-cols-md-2 g-4" id="news_container">
          <!-- Fetching all the news  -->
          <?php if ($newsData && $newsData->num_rows > 0): ?>
            <?php while ($newsItem = $newsData->fetch_assoc()): ?>
              <?= Card::get_news_card($newsItem, "") ?>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No news found.</p>
          <?php endif; ?>
        </div><br><br>

        <!-- Pagination links -->
        <nav class="page_pagination d-flex justify-content-center">
          <?= $pagination ?>
        </nav>
      </div>


      <div class="g-5 col-md-4">
        <div class="hstack section">
          <div class="p-2 pt-4">
            <p class="title">सुचना</p>
          </div>
          <div class="ms-auto"></div>
          <a href="category/news.php" class="more_btn">
            <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
            अन्य
          </a>
        </div><br>
        <div class="row overflow_control">
          <?php if ($noticeData && $noticeData->num_rows > 0): ?>
            <?php while ($row = $noticeData->fetch_assoc()): ?>
              <?= Card::get_notice_card($row) ?>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No notices found.</p>
          <?php endif; ?>
        </div>


        <!-- Download Section of notice board -->
        <div class="downloads">

          <div class="hstack section">
            <div class="p-2 pt-4">
              <p class="title">कागजातहरू</p>
            </div>
            <div class="ms-auto"></div>
            <a href="category/news.php" class="more_btn">
              <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
              अन्य
            </a>
          </div><br>

          <div class="overflow_control">
            <?php if ($documentData && $documentData->num_rows > 0): ?>
              <?php while ($row = $documentData->fetch_assoc()): ?>
                <?= Card::get_document_card($row) ?>
              <?php endwhile; ?>
            <?php else: ?>
              <p>No documents found.</p>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>
  </div>
  <br>


  <!-- Our Services -->
  <p class="text-center display-6">हाम्रो सुविधाहरु</p>
  <div class="row row-cols-1 row-cols-md-3">
    <div class="col gx-5">
      <div class="news_cards card h-100" type="button" data-bs-toggle="modal" data-bs-target="#service_one">
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
  <div class="row row-cols-1 row-cols-md-2 news_cards"
    style="border-radius: 10px; padding: 10px;max-width:95%; border: 1px solid lightgrey; margin:auto">
    <div class="col gx-5 head_teacher">
      <img src="<?php echo $principal_image_src; ?>" style="border-radius: 10px;max-width:100%;">
    </div>
    <div class="col gx-5">
      <div class="headteacher_heading" style="padding:10px;">
        <p class="display-6"><?php echo $principal_name; ?></p>
        <p class="text-body-secondary" style="font-size:20px; margin-top:-10px;">प्रधानअध्यापक</p>
      </div>
      <div class="card-text"
        style="padding: 10px; font-size: 20px; text-align:justify; max-height:155px; overflow:hidden;">
        <?php echo $few_words_by_principal; ?>
      </div>
      <div class="head_teacher_control"
        style="display: flex; flex-direction: column;padding-left:10px; font-size:25px;">
        . . . . . .
        <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal"
          data-bs-target="#principal_modal" style="margin-top:20px;">अझै पड्नुहोस्</button>

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
  <div class="modal fade" id="service_one" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel1"><?php echo $first_service_title; ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="<?php echo $first_image_link; ?>" class="modal_image">
          <?php echo $first_description; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal for second services -->
  <div class="modal fade" id="service_two" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel2"><?php echo $second_service_title; ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="<?php echo $second_image_link; ?>" class="modal_image">
          <?php echo $second_description; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Third service Model -->
  <div class="modal fade" id="service_three" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel3"><?php echo $third_service_title; ?></h1>
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
  <div class="modal fade" id="principal_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
              <?php echo $few_words_by_principal; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for recent notice -->
  <button type="button" id="recent_notice_viewer_btn" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#notice_popup">
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
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['news_id'];
              $title = $row['title'];
              $date = $row['upload_date'];
              $description = file_get_contents("uploads/news_descr/" . $row['src']);
              $thumbnail = 'uploads/images/' . $row['thumbnail'];
              ?>
              <div class="container">
                <p style="font-size:20px;"><?php echo $title; ?></p>
                <p class="text-secondary" style="margin-top:-10px;"><?php echo $date; ?></p>
                <p style="text-align:justify;"><?php echo $description; ?></p>
                <div class="notices_slider" style="display: flex; flex-direction: row;max-width:100%; overflow-x:auto;">
                  <!-- image slider for notice  -->
                  <div id="carouselExampleFade<?php echo $id ?>" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="<?php echo $thumbnail; ?>" class="d-block w-100" alt="...">
                      </div>
                      <?php
                      $img_sql = "SELECT * FROM news_img WHERE news_id = '$id'";
                      $img_result = mysqli_query($conn, $img_sql);
                      if ($img_result) {
                        while ($img_row = mysqli_fetch_assoc($img_result)) {
                          $filename = 'uploads/images/' . $img_row['filename'];
                          ?>
                          <div class="carousel-item">
                            <img src="<?php echo $filename ?>" class="d-block w-100" alt="...">
                          </div>
                          <?php
                        }
                      }
                      ?>
                    </div>
                    <button class="carousel-control-prev" type="button"
                      data-bs-target="#carouselExampleFade<?php echo $id ?>" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                      data-bs-target="#carouselExampleFade<?php echo $id ?>" data-bs-slide="next">
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
  if (!isset($_GET['page'])) {
    ?>
    <script>
      $("#recent_notice_viewer_btn").hide();
      $(document).ready(function () {
        setTimeout(() => {
          $("#recent_notice_viewer_btn").click();
        }, 2000);
      });
    </script>
    <?php
  } else {
    ?>
    <script>
      $("#recent_notice_viewer_btn").hide();
    </script>
    <?php
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>
</body>

</html>