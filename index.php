<?php
require 'script/php_scripts/database.php';
include 'script/php_scripts/components/newsPortal.php';
require_once 'script/php_scripts/ui/pagination.php';
include 'script/php_scripts/ui/cards.php';
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

// This variables is for principal few words section
$principal_name = "हाेमनाथ पाैडयाल";
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

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title data-i18n="title">SSBSS | Home</title>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="Style/style.css">
<link rel="stylesheet" type="text/css" href="Style/index.css">
<link rel="icon" type="icon" href="images/slogo.png">
<style>
  /* Carousel indicators with flat sky blue and yellow */
  #carouselExampleAutoplaying .carousel-indicators [data-bs-slide-to] {
    background-color: #87ceeb;
    /* sky blue */
    opacity: 0.7;
    transition: opacity 0.2s ease;
  }

  #carouselExampleAutoplaying .carousel-indicators .active {
    background-color: #ffc107;
    /* yellow */
    opacity: 1;
  }

  #carouselExampleAutoplaying .carousel-indicators [data-bs-slide-to]:hover {
    opacity: 1;
  }

  /* More images button: flat color and sharp edges */
  .more_image_btn {
    margin-left: 1rem;
    background-color: #ffc107;
    color: white;
    font-weight: 600;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    box-shadow: none;
    transition: background-color 0.3s ease;
  }

  .more_image_btn:hover {
    background-color: #e0a800;
    color: white;
    text-decoration: none;
  }

  /* Caption with solid dark background and crisp white text */
  .carousel-caption {
    background: rgba(0, 0, 0, 0.7);
    border-radius: 0.3rem;
    padding: 0.4rem 0.8rem;
  }

  .carousel-caption h5 {
    color: #ffc107;
    /* yellow text */
    font-weight: 700;
    margin: 0;
  }

  /* Image styling with subtle rounded corners only */
  .carousel-item img {
    border-radius: 0.5rem;
    box-shadow: none;
  }

  .card-container:hover .overlay {
    opacity: 0;
  }

  .card-container:hover img {
    transform: scale(1.05);
  }

  @media (max-width: 768px) {
    .card-container {
      height: 220px !important;
    }
  }

  /* Service designs  */
  .full-overlay-title {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-weight: 700;
    font-size: 1.4rem;
    margin-bottom: 0.75rem;
    color: #ffca28;
    /* warm warning yellow */
  }

  .full-overlay-title i {
    font-size: 28px;
    color: #ffca28;
  }

  .full-overlay-text {
    color: #ffe082;
  }
</style>
</head>

<body>
  <!-- navigation bar of index page  -->
  <?php
  print_header("home");
  ?>




  <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators d-flex align-items-center">
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3"
        aria-label="Slide 4"></button>

      <a href="category/gallery.php" class="btn more_image_btn ms-3" data-i18n="hero.button_text">+ अन्य तस्विर</a>
    </div>

    <div class="carousel-inner rounded-3 shadow-sm">
      <div class="carousel-item active" data-bs-interval="3000">
        <img src="images/front_wallpapers/ssbss_entry_gate.jpg" class="d-block w-100" alt=""
          data-i18n="[alt]hero.slides.0.caption">
        <div class="carousel-caption d-none d-md-block">
          <h1 data-i18n="hero.slides.0.caption">विधालय प्रवेशद्वार</h1>
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="3000">
        <img src="images/front_wallpapers/english medium.jpg" class="d-block w-100" alt=""
          data-i18n="[alt]hero.slides.1.caption">
        <div class="carousel-caption d-none d-md-block">
          <h1 data-i18n="hero.slides.1.caption">विधालय प्राँगण</h1>
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="3000">
        <img src="images/front_wallpapers/see_students.jpg" class="d-block w-100" alt=""
          data-i18n="[alt]hero.slides.2.caption">
        <div class="carousel-caption d-none d-md-block">
          <h1 data-i18n="hero.slides.2.caption">शिक्षकसँग विधार्थीहरु</h1>
        </div>
      </div>

      <div class="carousel-item" data-bs-interval="3000">
        <img src="images/front_wallpapers/school.jpg" class="d-block w-100" alt=""
          data-i18n="[alt]hero.slides.3.caption">
        <div class="carousel-caption d-none d-md-block">
          <h1 data-i18n="hero.slides.3.caption">विद्यालयको स्वच्छ वातावरण</h1>
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


  <!-- About school and principal section -->
  <div class="container my-5">
    <div class="row align-items-stretch">
      <!-- About School Column -->
      <div class="col-sm-8">
        <div class="position-relative h-100">
          <div class="position-absolute top-0 start-0 translate-middle bg-warning-subtle rounded-circle"
            style="width: 160px; height: 160px; z-index: 0; opacity: 0.4;"></div>

          <div class="card border-0 shadow-lg h-100 bg-warning-subtle position-relative overflow-hidden"
            style="z-index: 1; border-radius: 20px;">
            <div class="row g-4 align-items-stretch h-100">

              <div class="col-md-5 p-4 d-flex">
                <div class="position-relative w-100 rounded-4 overflow-hidden shadow" style="min-height: 100%;">
                  <img src="images/front_wallpapers/new_school.jpg" alt="School" class="img-fluid h-100 w-100"
                    style="object-fit: cover; border-radius: 1rem;" data-i18n="[alt]school.name">
                  <div
                    class="position-absolute bottom-0 start-0 bg-warning text-dark px-3 py-1 rounded-top-end shadow-sm">
                    <i class="bi bi-buildings"></i> <span data-i18n="school.estd">स्थापना: वि.सं. २००९</span>
                  </div>
                </div>
              </div>

              <div class="col-md-7 p-4 d-flex flex-column justify-content-center">
                <h2 class="fw-bold mb-3 text-warning">
                  <i class="bi bi-mortarboard-fill me-2"></i> <span data-i18n="common.about_school">विद्यालयको
                    बारेमा</span>
                </h2>
                <p class="text-secondary" style="font-size: 1rem; text-align: justify;" data-i18n="school.about">
                  श्री शान्ती भगवती माध्यमिक विद्यालयको स्थापना वि.सं. २००९ मा भएको हो। हालै मात्र विद्यालयले
                  लेटाङ नगरपालिकाभित्र "श्रेष्ठ विद्यालय" को उपाधि प्राप्त गरेको छ। यहाँ विज्ञान, वाणिज्य, शिक्षा
                  र कम्प्युटर इन्जिनियरिङजस्ता संकायहरू सञ्चालित छन्। विशेष कुरा के छ भने इन्जिनियरिङ कक्षामा
                  स्मार्टबोर्ड प्रविधि समेत प्रयोग गरिन्छ।
                </p>

                <blockquote class="blockquote my-3 ps-3 border-start border-4" style="border-color: #00BFFF;">
                  <p class="text-dark-emphasis mb-0" data-i18n="school.vision">
                    “गुणस्तरीय शिक्षा, अनुशासन र संस्कार सहितको भविष्य निर्माण यहीँबाट सुरु हुन्छ।”
                  </p>
                </blockquote>

                <button class="btn btn-info text-white rounded-pill mt-2 align-self-start" data-bs-toggle="modal"
                  data-bs-target="#aboutSchoolModal" data-i18n="button.detail_view">
                  विस्तृत जानकारी हेर्नुहोस्
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Principal Column -->
      <div class="col-sm-4">
        <div class="card shadow border-0 h-100 bg-warning-subtle" style="border-radius: 1rem;">
          <div class="card-body p-4 d-flex flex-column justify-content-between">

            <!-- Principal Name and Title -->
            <div>
              <h2 class="fw-bold text-warning mb-1">
                <?php echo $principal_name; ?>
              </h2>
              <h5 class="text-muted mb-3" data-i18n="common.principal">प्रधानअध्यापक</h5>

              <!-- Wrapped Paragraph with floated image -->
              <div class="position-relative">
                <div class="position-relative" style="max-height: 215px; overflow: hidden;">
                  <img src="<?php echo $principal_image_src; ?>"
                    alt="<?php echo $principal_name ?: 'Principal Image'; ?>"
                    class="float-start me-3 shadow-sm rounded-3" style="width: 110px; height: auto; object-fit: cover;">

                  <p class="text-secondary" style="text-align: justify; font-size: 1rem;">
                    <?php echo $few_words_by_principal; ?>
                  </p>
                  <!-- Gradient Fade -->
                  <div class="position-absolute bottom-0 start-0 w-100"
                    style="height: 40px; background: linear-gradient(to top, var(--bs-warning-bg-subtle), transparent); pointer-events: none;">
                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
            </div>


            <!-- Read More Button -->
            <div class="mt-3 text-start">
              <button class="btn rounded-pill px-4 fw-semibold shadow-sm bg-info text-white" data-bs-toggle="modal"
                data-bs-target="#principal_modal" data-i18n="button.read_more">
                अझै पढ्नुहोस्
              </button>
            </div>

          </div>
        </div>
      </div>


    </div>
  </div>

  <!-- Different Faculty -->
  <div class="container py-5">
    <h2 class="text-center display-6 fw-bold mb-4 text-warning" data-i18n="common.our_faculty">हाम्रा विभागहरू</h2>


    <div class="row g-4">

      <!-- Engineering Faculty -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/engineering_students.jpg" class="img-fluid w-100 h-100" alt="Engineering Faculty"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.0.title">इन्जिनियरिङ (कक्षा ९–१२)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.0.description">कम्प्युटर इन्जिनियरिङ र इलेक्ट्रिकल ज्ञानमा आधारित
              व्यावसायिक शिक्षा, प्रयोगात्मक सिकाइसहित।</p>
          </div>
        </div>
      </div>

      <!-- Science Faculty -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/science_students.jpg" class="img-fluid w-100 h-100" alt="Science Faculty"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.1.title">विज्ञान (कक्षा ११–१२)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.1.description">फिजिक्स, केमिस्ट्री, बायोलोजी र कम्प्युटर शिक्षामा
              गहिरो अध्ययनका लागि उच्चस्तरीय प्रयोगशालासहित।</p>
          </div>
        </div>
      </div>

      <!-- Management Faculty -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/science_students.jpg" class="img-fluid w-100 h-100" alt="Management Faculty"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.2.title">वाणिज्य (कक्षा ११–१२)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.2.description">लेखा, व्यवस्थापन, उद्यमशीलता र सूचना प्रविधिमा
              आधारित आधुनिक पाठ्यक्रम।</p>
          </div>
        </div>
      </div>

      <!-- Education Faculty -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/science_students.jpg" class="img-fluid w-100 h-100" alt="Education Faculty"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.3.title">शिक्षा (कक्षा ११–१२)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.3.description">शिक्षाशास्त्र, मनोविज्ञान र समाजशास्त्रमा आधारित
              शिक्षक उत्पादनमुखी कार्यक्रम।</p>
          </div>
        </div>
      </div>

      <!-- English Medium -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/science_students.jpg" class="img-fluid w-100 h-100" alt="English Medium"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.4.title">अंग्रेजी माध्यम (कक्षा १० सम्म)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.4.description">CBT पद्धति, ICT प्रयोग र सृजनात्मक सिकाइ
              प्रणालीमार्फत गुणस्तरीय शिक्षा।</p>
          </div>
        </div>
      </div>

      <!-- Nepali Medium -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/science_students.jpg" class="img-fluid w-100 h-100" alt="Nepali Medium"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-75 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="faculties.5.title">नेपाली माध्यम (कक्षा १० सम्म)</h5>
            <p class="mb-0 px-3" data-i18n="faculties.5.description">नेपाली भाषामा प्रभावकारी सिकाइ, अनुशासन र संस्कारमा
              आधारित शिक्षण प्रणाली।</p>
          </div>
        </div>
      </div>

    </div>



  </div>



  <!-- News and notices -->
  <div class="container">
    <div class="row w-100">
      <div class="g-5 col-md-8">

        <div class="hstack section">
          <div class="p-2 pt-4">
            <p class="title" data-i18n="common.news">समचार</p>
          </div>
          <div class="ms-auto"></div>
          <a href="category/news.php" class="more_btn">
            <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
            <span data-i18n="common.more">अन्य</span>
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
            <p class="title" data-i18n="common.notice">सुचना</p>
          </div>
          <div class="ms-auto"></div>
          <a href="category/news.php" class="more_btn">
            <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
            <span data-i18n="common.more">अन्य</span>
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
              <p class="title" data-i18n="common.documents">कागजातहरू</p>
            </div>
            <div class="ms-auto"></div>
            <a href="category/news.php" class="more_btn">
              <i class="bi bi-plus-lg"></i>&nbsp;&nbsp;
              <span data-i18n="common.more">अन्य</span>
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
  <section class="container my-5">
    <h2 class="text-center display-6 fw-bold mb-4 text-warning" data-i18n="common.our_services">हाम्रा सुविधाहरु</h2>


    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- ICT Oriented Teaching -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="ICT Oriented Teaching"
          data-bs-toggle="modal" data-bs-target="#service_ict">
          <img src="images/front_wallpapers/ict_teaching.jpg"
            alt="Students using computers in a modern ICT classroom" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-laptop-fill"></i>
              ICT Oriented Teaching
            </h5>
            <p class="full-overlay-text">
              Innovative ICT tools to enhance learning experience.
            </p>
          </div>
        </div>
      </div>

      <!-- Science & Computer Labs -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="Science and Computer Labs"
          data-bs-toggle="modal" data-bs-target="#service_labs">
          <img src="images/front_wallpapers/science_lab.jpg"
            alt="Well-equipped science laboratory with students performing experiments" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-flask-fill"></i>
              Science & Computer Labs
            </h5>
            <p class="full-overlay-text">
              Fully equipped physics, chemistry, biology & computer labs.
            </p>
          </div>
        </div>
      </div>

      <!-- School Bus -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="School Bus" data-bs-toggle="modal"
          data-bs-target="#service_bus">
          <img src="images/front_wallpapers/school_bus_yellow.jpg" alt="Yellow school bus parked outside school" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-bus-front-fill"></i>
              School Bus
            </h5>
            <p class="full-overlay-text">
              Safe and reliable transportation for students.
            </p>
          </div>
        </div>
      </div>

      <!-- School Nurse -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="School Nurse" data-bs-toggle="modal"
          data-bs-target="#service_nurse">
          <img src="images/front_wallpapers/school_nurse_room.jpg" alt="School nurse room with medical supplies" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-heart-pulse-fill"></i>
              School Nurse
            </h5>
            <p class="full-overlay-text">
              Dedicated healthcare support on campus.
            </p>
          </div>
        </div>
      </div>

      <!-- Library -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="Library" data-bs-toggle="modal"
          data-bs-target="#service_library">
          <img src="images/front_wallpapers/library_interior.jpg" alt="Cozy school library with shelves of books" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-book-fill"></i>
              Library
            </h5>
            <p class="full-overlay-text">
              A rich collection of books in a peaceful environment.
            </p>
          </div>
        </div>
      </div>

      <!-- Well Furnished Classroom -->
      <div class="col">
        <div class="card-full-overlay" tabindex="0" role="button" aria-label="Well Furnished Classroom"
          data-bs-toggle="modal" data-bs-target="#service_classroom">
          <img src="images/front_wallpapers/well_furnished_classroom.jpg"
            alt="Modern well-furnished classroom with desks and whiteboard" />
          <div class="full-overlay-content">
            <h5 class="full-overlay-title">
              <i class="bi bi-columns-gap"></i>
              Well Furnished Classroom
            </h5>
            <p class="full-overlay-text">
              Comfortable and modern classrooms for effective learning.
            </p>
          </div>
        </div>
      </div>
    </div>





  </section>






  <!-- Our Online Services -->
  <section class="container my-5">
    <div class="card border-0 shadow-lg overflow-hidden position-relative text-white">
      <!-- Background Image -->
      <img src="images/online_services.jpg" alt="Online Services" class="card-img"
        style="height: 400px; object-fit: cover; filter: brightness(60%);">

      <!-- Glassmorphism Overlay -->
      <div class="card-img-overlay d-flex align-items-center justify-content-center p-4"
        style="backdrop-filter: blur(6px); background-color: rgba(0, 0, 0, 0.5);">
        <div class="text-center w-100">

          <h2 class="display-6 fw-bold mb-4 text-warning" data-i18n="menu.online_services">अनलाइन सेवाहरू</h2>

          <div class="row row-cols-1 row-cols-sm-3 g-3 justify-content-center">

            <!-- Online Admission -->
            <div class="col">
              <a href="category/more/admission"
                class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
                <i class="bi bi-pencil-square me-2 fs-4"></i><span data-i18n="common.online_admission">अनलाइन
                  भर्ना</span>
              </a>
            </div>

            <!-- Result -->
            <div class="col">
              <a href="category/more/result"
                class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
                <i class="bi bi-bar-chart-line-fill me-2 fs-4"></i><span data-i18n="common.result">परिक्षाफल</span>
              </a>
            </div>

            <!-- Contact -->
            <div class="col">
              <a href="category/contact" class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
                <i class="bi bi-telephone-fill me-2 fs-4"></i><span data-i18n="common.contact_us">सम्पर्क
                  गर्नुहोस्</span>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>





  <!-- Modal for service section-->
  <div class="modal fade" id="service_one" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel1">
            <?php echo $first_service_title; ?>
          </h1>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel2">
            <?php echo $second_service_title; ?>
          </h1>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel3">
            <?php echo $third_service_title; ?>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="<?php echo $third_image_link; ?>" class="modal_image">
          <?php echo $third_description; ?>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal for Full School Description -->
  <div class="modal fade" id="aboutSchoolModal" tabindex="-1" aria-labelledby="aboutSchoolModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-4">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title" id="aboutSchoolModalLabel">
            <i class="bi bi-info-circle-fill me-2"></i>विद्यालयको विस्तृत जानकारी
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-secondary" style="text-align: justify; font-size: 1rem;">
          <p>
            <i class="bi bi-calendar-event text-primary me-2"></i> श्री शान्ती भगवती माध्यमिक विद्यालयको स्थापना
            वि.सं.
            २००९ मा भएको हो।
            स्थापना कालदेखि विद्यालयले गुणस्तरीय, नैतिक र समावेशी शिक्षालाई प्राथमिकता दिँदै आएको छ। हालै मात्र लेटाङ
            नगरपालिकाभित्र
            उत्कृष्ट शैक्षिक योगदानका लागि विद्यालयलाई "श्रेष्ठ विद्यालय" को उपाधिले सम्मान गरिएको छ।
          </p>

          <p>
            <i class="bi bi-gear-wide-connected text-success me-2"></i> विद्यालयमा कक्षा ९ देखि १२ सम्म कम्प्युटर
            इन्जिनियरिङ, कक्षा ११ र १२ मा
            विज्ञान, वाणिज्य र शिक्षा संकाय सञ्चालनमा छन्। यिनै संकायहरू अंग्रेजी र नेपाली दुबै माध्यममा पढाइन्छ।
            इन्जिनियरिङ कक्षामा
            स्मार्टबोर्ड प्रविधिको प्रयोग गरिएको छ, जसले सिकाइलाई अझ प्रभावकारी बनाएको छ।
          </p>

          <p>
            <i class="bi bi-bus-front-fill text-warning me-2"></i> विद्यालयसँग दुईवटा स्कुल बस, दुई कम्प्युटर
            प्रयोगशाला, रसायन, भौतिक
            तथा जीव विज्ञान प्रयोगशाला, पुस्तकालय र नर्सिङ सेवा उपलब्ध छन्। साथै, विविध कार्यक्रमका लागि छुट्टै सभा
            हलको
            व्यवस्था गरिएको छ।
          </p>

          <p>
            <i class="bi bi-people-fill text-info me-2"></i> यहाँका शिक्षकगण विद्यार्थीमैत्री, सिर्जनशील र अनुभवी छन्।
            विद्यालयले
            प्रत्येक विद्यार्थीको क्षमता अनुसार सिकाइ प्रक्रिया सहज बनाउने प्रयास गर्दछ।
          </p>

          <!-- Iconic Photo Row -->
          <div class="row g-3 mt-4">
            <div class="col-6 col-md-4">
              <img src="images/class_9_c_lab.jpg" class="img-fluid rounded shadow-sm" alt="Lab">
              <small class="d-block text-center mt-1">प्रयोगशाला</small>
            </div>
            <div class="col-6 col-md-4">
              <img src="images/school_bus.jpg" class="img-fluid rounded shadow-sm" alt="School Bus">
              <small class="d-block text-center mt-1">विद्यालय बस</small>
            </div>
            <div class="col-6 col-md-4">
              <img src="images/smart_board.jpg" class="img-fluid rounded shadow-sm" alt="Smartboard">
              <small class="d-block text-center mt-1">स्मार्टबोर्ड कक्षा</small>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">बन्द गर्नुहोस्</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Principal Full Message Modal -->
  <div class="modal fade" id="principal_modal" tabindex="-1" aria-labelledby="principalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg"
        style="border-top: 4px solid #0d6efd; border-radius: 0.75rem; overflow: hidden;">

        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <div>
            <h5 class="modal-title d-flex align-items-center gap-2 mb-0" id="principalModalLabel">
              <i class="bi bi-person-badge-fill fs-4"></i>
              <?php echo $principal_name; ?>
            </h5>
            <small class="text-light ps-4" style="font-size: 16px;">प्रधानअध्यापक</small>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body bg-warning-subtle text-dark p-4" style="text-align: justify; font-size: 18px;">
          <p>
            <i class="bi bi-quote fs-2 text-primary me-2"></i>
            <?php echo $few_words_by_principal; ?>
          </p>
        </div>

      </div>
    </div>
  </div>




  <!-- Modal for recent notice -->
  <button type="button" id="recent_notice_viewer_btn" class="btn btn-primary invisible" data-bs-toggle="modal"
    data-bs-target="#notice_popup">
    हालैको सूचना
  </button>
  <div class="modal fade" id="notice_popup" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning bg-warning text-white">
          <h5 class="modal-title fw-bold" id="noticeModalLabel" data-i18n="common.recent_notice">हालैको सूचना</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">

          <?php
          $sql = "SELECT * FROM news WHERE type = 'notice' ORDER BY news_id DESC LIMIT 1";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['news_id'];
              $title = htmlspecialchars($row['title']);
              $date = htmlspecialchars($row['upload_date']);
              $description = nl2br(htmlspecialchars(file_get_contents("uploads/news_descr/" . $row['src'])));
              $thumbnail = 'uploads/images/' . $row['thumbnail'];
              ?>

              <section class="mb-5">
                <h4 class="fw-semibold mb-1"><?php echo $title; ?></h4>
                <p class="text-muted fst-italic mb-3"><?php echo $date; ?></p>
                <p style="text-align: justify; font-size: 1rem; line-height: 1.5;"><?php echo $description; ?></p>

                <!-- Image slider -->
                <div id="carouselNotice<?php echo $id ?>" class="carousel slide carousel-fade mt-3" data-bs-ride="carousel"
                  style="max-width: 100%;">
                  <div class="carousel-inner rounded shadow-sm">
                    <div class="carousel-item active">
                      <img src="<?php echo $thumbnail; ?>" class="d-block w-100" alt="Notice Image <?php echo $id; ?>"
                        style="object-fit: cover; max-height: 300px;">
                    </div>
                    <?php
                    $img_sql = "SELECT * FROM news_img WHERE news_id = '$id'";
                    $img_result = mysqli_query($conn, $img_sql);
                    if ($img_result) {
                      while ($img_row = mysqli_fetch_assoc($img_result)) {
                        $filename = 'uploads/images/' . $img_row['filename'];
                        ?>
                        <div class="carousel-item">
                          <img src="<?php echo $filename ?>" class="d-block w-100" alt="Notice Image <?php echo $id; ?>"
                            style="object-fit: cover; max-height: 300px;">
                        </div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselNotice<?php echo $id ?>"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselNotice<?php echo $id ?>"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </section>
              <hr class="my-4" />

              <?php
            }
          } else {
            echo "<p class='text-center text-muted'>सूचना उपलब्ध छैन।</p>";
          }
          ?>

        </div>
      </div>
    </div>
  </div>



  <!-- Website Footer -->
  <?php
  print_footer();
  ?>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="data/translation.js"></script>

  <?php if (!isset($_GET['page'])): ?>
    <script>
      $(document).ready(function () {
        $("#recent_notice_viewer_btn").hide();
        setTimeout(() => {
          $("#recent_notice_viewer_btn").trigger("click");
        }, 2000);
      });
    </script>
  <?php else: ?>
    <script>
      $(document).ready(function () {
        $("#recent_notice_viewer_btn").hide();
      });
    </script>
  <?php endif; ?>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>

</body>

</html>