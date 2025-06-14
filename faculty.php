<?php
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty | SSBSS</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../Style/style.css">
  <link rel="icon" type="icon" href="images/slogo.png">
  <style>
    .controls {
      max-height: 40px;
      min-width: 45%;
      background-color: #dbdbdb;
      overflow: hidden;
    }

    .circle_image {
      border-radius: 100%;
      height: 100px;
      margin: auto;
      width: 100px;
    }

    .counter_title {
      font-size: 20px;
      text-align: center;
    }

    .faculty_thumbnail {
      min-width: 100%;
      max-height: 250px;
    }
  </style>
</head>

<body>
  <!-- navigation bar  -->
  <?php
  print_header("faculty");
  ?><br>
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


  <!-- Website Footer -->
  <?php
  print_footer();
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="data/translation.js"></script>
</body>

</html>