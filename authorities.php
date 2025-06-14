<?php
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Authorities | SSBSS</title>
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

    .authorized_person {
      border-radius: 100%;
      border: 1px solid black;
    }

    .authorized_card {
      box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
    }
  </style>
</head>

<body>
  <!-- navigation bar  -->
  <?php
  print_header("authorities");
  ?>
  <!-- Authorities Cards  -->
  <div class="container">
    <div class="row row-cols-md-4 row-cols-1 d-flex justify-content-center align-items-center">

      <!-- Authority 1 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/chairman.jpg" class="card-img authorized_person" alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.0.name">राम कुमार श्रेषठ</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.0.department">व्यवस्थापन समिती</span><br>
                <span data-i18n="authorities.0.position">अदक्क्ष</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 2 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/unknown_person.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.1.name">दीपक भण्डारी</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.1.department">शिक्षक अभिभावक संघ</span><br>
                <span data-i18n="authorities.1.position">अदक्क्ष</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 3 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/school_head_teacher.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.2.name">हाेमनाथ पाैड्याल</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.2.department">शान्ती भगवती</span><br>
                <span data-i18n="authorities.2.position">प्रधान्अध्यापक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 4 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/information_officer.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.3.name">लेखनाथ पाैड्याल</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.3.department">शान्ती भगवती</span><br>
                <span data-i18n="authorities.3.position">सुचना अधीकारी तथा सहायक प्र.अ.</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 5 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/unknown_person.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.4.name">सेामनाथ भट्रराइ</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.4.department">शान्ती भगवती</span><br>
                <span data-i18n="authorities.4.position">सहायक प्रधान्अध्यापक तथा विहानी सम्याेजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 6 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/science_incharge.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.5.name">बिपीन खत्री</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.5.department">विज्ञान</span><br>
                <span data-i18n="authorities.5.position">सम्याेजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 7 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/engineering_incharge.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.6.name">इ. विजय सहनी</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.6.department">इन्जीनियरीङ</span><br>
                <span data-i18n="authorities.6.position">सम्याेजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 8 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/education_and_commerce_incharge.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.7.name">राेमनाथ पाैड्याल</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.7.department">कक्षाा ११ र १२</span><br>
                <span data-i18n="authorities.7.position">परीक्षाा सम्याेजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 9 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/unknown_person.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.8.name">राम नारायणा यादव</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.8.department">समयाोजक नेपाली माध्यम (कक्षा ९ र १०)</span><br>
                <span data-i18n="authorities.8.position">परीक्षा सम्याेजक (०-१०)</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 10 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/english_medium_incharge.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.9.name">विरेन्द्र कुमार लिम्बु</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.9.department">अङग्रेजी माध्यम्</span><br>
                <span data-i18n="authorities.9.position">संयोजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 11 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/unknown_person.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.10.name">नेत्रप्रशाद चुडाल</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.10.department">अङग्रेजी माध्यम्</span><br>
                <span data-i18n="authorities.10.position">सह सम्याेजक</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Authority 12 -->
      <div class="col g-5">
        <div class="card authorized_card border-primary">
          <div class="card-body">
            <img src="images/authorities_img/unknown_person.jpg" class="card-img authorized_person"
              alt="Authority Image">
            <div class="authorities_description">
              <h5 class="card-title text-center" data-i18n="authorities.11.name">टङक थापा मगर</h5>
              <p class="text-secondary text-center">
                <span data-i18n="authorities.11.department">नेपाली माध्यम्</span><br>
                <span data-i18n="authorities.11.position">निमा सम्याेजक</span>
              </p>
            </div>
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