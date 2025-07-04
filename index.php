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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title data-i18n="title.home">Shree Shanti Bhagwati Secondary School | Letang-5, Morang</title>

  <meta name="description"
    content="Official website of Shree Shanti Bhagwati Secondary School, Letang-5, Morang. Access school news, results, notices, and updates.">
  <meta name="keywords"
    content="Shree Shanti Bhagwati Secondary School, Letang, Morang School, SSBSS, school results, school notice, basic school Nepal, secondary education Morang">
  <meta name="author" content="Shree Shanti Bhagwati Secondary School">
  <link rel="canonical" href="https://www.ssbss.edu.np/">

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="Shree Shanti Bhagwati Secondary School | Letang-5, Morang" />
  <meta property="og:description"
    content="Explore news, notices, results, gallery, and more from Shree Shanti Bhagwati Secondary School." />
  <meta property="og:image" content="https://www.ssbss.edu.np/images/slogo.png" />
  <meta property="og:url" content="https://www.ssbss.edu.np/" />
  <meta property="og:type" content="website" />

  <!-- Twitter Card Meta -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Shree Shanti Bhagwati Secondary School" />
  <meta name="twitter:description"
    content="Official school site for updates, notices, and academic information from Letang-5, Morang." />
  <meta name="twitter:image" content="https://www.ssbss.edu.np/images/slogo.png" />

  <!-- Favicon and CSS -->
  <link rel="icon" href="images/slogo.png" type="image/png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="Style/style.css">
  <link rel="stylesheet" href="Style/index.css">

  <style>
    /* Custom Color Scheme - Yellow and Sky Blue */
    .hero-carousel {
      --primary-yellow: #FFD700;
      --secondary-yellow: #FFA500;
      --primary-sky-blue: #87CEEB;
      --secondary-sky-blue: #4169E1;
      --accent-blue: #1E90FF;
      --white: #FFFFFF;
      --black: #000000;
    }

    /* Hero Carousel Styles */
    .hero-carousel {
      height: 95vh;
      margin-top: -10px;
    }

    .hero-carousel .carousel-item {
      height: 100vh;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
    }

    /* Dark overlay for better text readability */
    .hero-carousel .carousel-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .hero-carousel .carousel-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 80%;
      max-width: 800px;
    }

    /* Text Background Overlay */
    .hero-carousel .text-overlay {
      background: rgba(250, 250, 249, 0.12);
      backdrop-filter: blur(2px);
      border-radius: 12px;
      padding: 40px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .hero-carousel .hero-title {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    .hero-carousel .hero-subtitle {
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
      font-size: 1.25rem;
      line-height: 1.6;
    }

    /* Custom Button Styles */
    .hero-carousel .btn-primary {
      background: linear-gradient(45deg, var(--primary-yellow), var(--secondary-yellow));
      border: none;
      color: var(--black);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .hero-carousel .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
      background: linear-gradient(45deg, var(--secondary-yellow), var(--primary-yellow));
      color: var(--black);
    }

    .hero-carousel .btn-outline-light {
      border: 2px solid var(--white);
      color: var(--white);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-radius: 50px;
      background: transparent;
      transition: all 0.3s ease;
    }

    .hero-carousel .btn-outline-light:hover {
      background: var(--white);
      color: var(--secondary-sky-blue);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
    }

    /* Carousel Controls */
    .hero-carousel .carousel-control-prev,
    .hero-carousel .carousel-control-next {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0.8;
      transition: all 0.3s ease;
    }

    .hero-carousel .carousel-control-prev {
      left: 30px;
    }

    .hero-carousel .carousel-control-next {
      right: 30px;
    }

    .hero-carousel .carousel-control-prev:hover,
    .hero-carousel .carousel-control-next:hover {
      opacity: 1;
      transform: translateY(-50%) scale(1.05);
    }

    .hero-carousel .carousel-control-prev-icon,
    .hero-carousel .carousel-control-next-icon {
      color: var(--black);
      width: 24px;
      height: 24px;
    }

    /* Carousel Indicators */
    .hero-carousel .carousel-indicators {
      bottom: 30px;
      margin-bottom: 0;
    }

    .hero-carousel .carousel-indicators [data-bs-target] {
      width: 25px;
      height: 5px;
      border-radius: 5px;
      background: rgba(255, 255, 255, 0.5);
      margin: 0 8px;
      opacity: 0.7;
      border: none;
      transition: all 0.3s ease;
    }

    .hero-carousel .carousel-indicators .active {
      background: var(--primary-yellow);
      opacity: 1;
      transform: scale(1.2);
    }

    .hero-carousel .carousel-indicators [data-bs-target]:hover {
      opacity: 1;
      transform: scale(1.1);
    }

    /* Animations */
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-carousel .animate-fade-up {
      animation: fadeUp 1s ease-out;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-carousel .text-overlay {
        padding: 30px 25px;
        margin: 0 15px;
      }

      .hero-carousel .hero-title {
        font-size: 2rem !important;
      }

      .hero-carousel .hero-subtitle {
        font-size: 1.1rem;
      }

      .hero-carousel .btn-lg {
        padding: 12px 30px !important;
        font-size: 1rem;
      }

      .hero-carousel .carousel-control-prev,
      .hero-carousel .carousel-control-next {
        width: 50px;
        height: 50px;
      }

      .hero-carousel .carousel-control-prev {
        left: 15px;
      }

      .hero-carousel .carousel-control-next {
        right: 15px;
      }
    }

    @media (max-width: 576px) {
      .hero-carousel .text-overlay {
        padding: 25px 20px;
        margin: 0 10px;
      }

      .hero-carousel .hero-title {
        font-size: 1.5rem !important;
      }

      .hero-carousel .hero-subtitle {
        font-size: 1rem;
      }

      .hero-carousel .carousel-control-prev,
      .hero-carousel .carousel-control-next {
        width: 45px;
        height: 45px;
      }

      .hero-carousel .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        margin: 0 5px;
      }
    }

    /* Focus styles for accessibility */
    .hero-carousel .carousel-control-prev:focus,
    .hero-carousel .carousel-control-next:focus,
    .hero-carousel .carousel-indicators [data-bs-target]:focus {
      outline: 3px solid var(--primary-yellow);
      outline-offset: 2px;
    }

    .hero-carousel .btn:focus {
      outline: 3px solid var(--primary-sky-blue);
      outline-offset: 2px;
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

    .full-overlay-title {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      font-weight: 700;
      font-size: 1.4rem;
      margin-bottom: 0.75rem;
      color: #ffca28;
    }

    .full-overlay-title i {
      font-size: 28px;
      color: #ffca28;
    }

    .full-overlay-text {
      color: #ffe082;
    }

    .section {
      max-height: 50px;
      margin: 0px;
      padding: 0px;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <!-- navigation bar of index page  -->
  <?php
  print_header("home");
  ?>


  <!-- Hero Carousel Section -->
  <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

    <!-- Carousel Inner -->
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url('images/front_wallpapers/ssbss_entry_gate.jpg');">
        <div class="carousel-caption">
          <div class="text-overlay animate-fade-up">
            <h1 class="hero-title display-2 fw-bold mb-4 text-white" data-i18n="hero.slides.0.caption">
              विधालय प्रवेशद्वार
            </h1>
            <div class="hero-buttons">
              <a href="gallery" class="btn btn-primary btn-lg me-3 px-5 py-3" data-i18n="hero.button_text">
                + More
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url('images/front_wallpapers/from_administration.jpg');">
        <div class="carousel-caption">
          <div class="text-overlay">
            <h1 class="hero-title display-3 fw-bold mb-4 text-white" data-i18n="hero.slides.1.caption">
              विधालय प्राँगण
            </h1>
            <div class="hero-buttons">
              <a href="gallery" class="btn btn-primary btn-lg me-3 px-5 py-3" data-i18n="hero.button_text">
                + More
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url('images/front_wallpapers/school.jpg');">
        <div class="carousel-caption">
          <div class="text-overlay">
            <h1 class="hero-title display-3 fw-bold mb-4 text-white" data-i18n="hero.slides.2.caption">
              विद्यालयको स्वच्छ वातावरण
            </h1>
            <div class="hero-buttons">
              <a href="gallery" class="btn btn-primary btn-lg me-3 px-5 py-3" data-i18n="hero.button_text">
                + More
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 4 -->
      <div class="carousel-item" style="background-image: url('images/front_wallpapers/students.jpg');">
        <div class="carousel-caption">
          <div class="text-overlay">
            <h1 class="hero-title display-3 fw-bold mb-4 text-white" data-i18n="hero.slides.3.caption">
              शिक्षकसँग विधार्थीहरु
            </h1>
            <div class="hero-buttons">
              <a href="gallery" class="btn btn-primary btn-lg me-3 px-5 py-3" data-i18n="hero.button_text">
                + More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- About school and principal section -->
  <div class="container my-5">
    <div class="row align-items-stretch g-4">
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
                  <img src="images/english_block.jpg" alt="School" class="img-fluid h-100 w-100"
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
  <div class="container" style="z-index:0;">
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
        <!-- Download Section of notice board -->

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
  <br>


  <!-- Our Services -->
  <section class="container my-5">
    <h2 class="text-center display-6 fw-bold mb-4 text-warning" data-i18n="common.our_services">हाम्रा सुविधाहरु</h2>


    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/class_9_c_lab.jpg" class="img-fluid w-100 h-100" alt="ICT Lab"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2" data-i18n="services.0.title">२ वटा कम्प्युटर ल्याब</h5>
            <p class="mb-0 px-3" data-i18n="services.0.description">
              हाम्रो विधालयमा दुईवटा अत्याधुनिक कम्प्युटर ल्याब छन्, जहाँ विद्यार्थीहरूलाई व्यवहारिक रूपमा सूचना
              प्रविधिको अध्ययन गराइन्छ।
            </p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/chemistry_lab.jpg" class="img-fluid w-100 h-100" alt="Science Lab"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2">विज्ञान प्रयोगशाला</h5>
            <p class="mb-0 px-3">
              भौतिक, रसायन र जीव विज्ञानका लागि सुविधा सम्पन्न प्रयोगशालाहरूले विद्यार्थीलाई प्रयोगात्मक शिक्षामा सहयोग
              पुर्‍याउँछन्।
            </p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/nurshing_room.jpg" class="img-fluid w-100 h-100" alt="Nursing Room"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2">विधालय नर्स</h5>
            <p class="mb-0 px-3">
              विद्यालयमा दक्ष नर्सको व्यवस्था गरिएको छ जसले विद्यार्थीको स्वास्थ्य सुरक्षामा विशेष ध्यान दिन्छन्।
            </p>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/smart_board.jpg" class="img-fluid w-100 h-100" alt="Smart Classroom"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2">प्रविधी मैत्री कक्षा</h5>
            <p class="mb-0 px-3">
              स्मार्ट बोर्ड र डिजिटल उपकरणमार्फत पढाइ हुने प्रविधि मैत्री कक्षाहरूले सिकाइलाई अझै प्रभावकारी बनाउँछन्।
            </p>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/school_bus.jpg" class="img-fluid w-100 h-100" alt="School Bus"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2">२ वटा विधालय बस</h5>
            <p class="mb-0 px-3">
              विद्यालयका आफ्नै दुई बसद्वारा विद्यार्थीहरूलाई सुरक्षित तथा नियमित यातायात सेवा उपलब्ध गराइएको छ।
            </p>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="col-md-6 col-lg-4">
        <div class="card-container position-relative overflow-hidden rounded-4 shadow h-100"
          style="cursor: pointer; max-height: 200px;">
          <img src="images/from_administration.jpg" class="img-fluid w-100 h-100" alt="School Environment"
            style="object-fit: cover; transition: transform 0.5s ease;">
          <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark bg-opacity-50 text-white">
            <h5 class="fw-semibold text-warning mb-2">स्वच्छ विधालय वातावरण</h5>
            <p class="mb-0 px-3">
              विद्यालय परिसर सफा, हरियाली र सुरक्षित छ, जसले विद्यार्थीहरूलाई अनुशासित र स्वस्थ वातावरणमा अध्ययन गर्न
              सहयोग पुर्‍याउँछ।
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
              <a href="admission" class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
                <i class="bi bi-pencil-square me-2 fs-4"></i><span data-i18n="common.online_admission">अनलाइन
                  भर्ना</span>
              </a>
            </div>

            <!-- Result -->
            <div class="col">
              <a href="result" class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
                <i class="bi bi-bar-chart-line-fill me-2 fs-4"></i><span data-i18n="common.result">परिक्षाफल</span>
              </a>
            </div>

            <!-- Contact -->
            <div class="col">
              <a href="contact" class="btn w-100 py-3 rounded-pill bg-info text-white shadow-sm fw-semibold">
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