<?php
// This function will print the header of the page
function print_header($file_index,$active){
  $index_path = "";
  $login_condition = isset($_COOKIE['login_id'])?True:False;
  if($file_index==0){
    $index_path = "";
    $first_siblings = "category/";
    $second_siblings = "category/more/";
  }else if($file_index==1){
    $index_path = "../";
    $first_siblings = "";
    $second_siblings = "more/";
  }else if($file_index==2){
    $index_path = "../../";
    $first_siblings = "../";
    $second_siblings = "";
  }
  ?>
    <!-- navigation bar  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">

      <div class="logo text-center">
        <img src="<?php echo $index_path?>images/slogo.png" class="logo">
        <p class="headings">श्री शान्ती भगवती माध्यमिक विधालय</p>
      </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav nav-underline">
            <li class="nav-item">
              <a class="nav-link <?php echo $active=="home"?"active":""?>" href="<?php echo $index_path?>">होम</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $active=="news"?"active":""?>" href="<?php echo $first_siblings?>news">सुचना</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $active=="contact"?"active":""?>" href="<?php echo $first_siblings?>contact">सम्पर्क</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $active=="faculty"?"active":""?>" href="<?php echo $first_siblings?>faculty">विभाग</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $active=="authorities"?"active":""?>" href="<?php echo $first_siblings?>authorities">वि.प्रमुख</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                अरु
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item <?php echo $active=="login"?"active":""?>" href="<?php echo $index_path?>authentication"><?php echo $login_condition?"व्यवस्थापक":"लगइन";?></a>
                </li>
                <li>
                  <a class="dropdown-item <?php echo $active=="result"?"active":""?>" href="<?php echo $second_siblings?>result">परिक्षाफल</a>
                </li>
                <li><a class="dropdown-item <?php echo $active=="admission"?"active":""?>" href="<?php echo $second_siblings?>admission">विधार्थी भर्ना</a></li>
                <li><a class="dropdown-item <?php echo $active=="gallery"?"active":""?>" href="<?php echo $second_siblings?>gallery">ग्यालरी</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php
}
//This function will print the footer of the page
function print_footer($inf_officer){
    ?>
  <hr>
  <div class="row">
      <div class="gx-5 gy-5 col-md-4 d-flex justify-content-center align-items-center" style="flex-direction:column;">
          <p class="foot_title display-6 text-center" style="font-weight:700;">सुचना अधिकारी</p>
          <img src="<?php echo $inf_officer; ?>/authorities_img/information_officer.jpg" style="max-width:50%; border:1px solid black; margin:auto;">
          <p class="foot_title display-6 text-center">होमनाथ पौड्याल</p>
      </div>
      <div class="col-md-4 gx-5 gy-5">
          <p class="foot_title display-6 text-center" style="font-weight:700;">सम्पर्क गर्नुहोस्</p>
          <p>
            ठेगाना : लेटाङ ५, मेराङ <br>
            सम्पर्क नम्बर : ०२१-५६००३४<br>
            इमेल : shantibhagawatiletang2009@gmail.com
          </p>
          <div class="row">
            <div class="col">
              <a href="https://www.facebook.com/SSBSS.L4" target="blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
              </svg>
              </a>
            </div>
            <div class="col">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"/>
              </svg>
            </div>
            <div class="col">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
              <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
              </svg>
            </div>
          </div><br>
          <div class="row">
            <div class="col">
              <a href="#">गोपनीयता नीति</a>
            </div>
            <div class="col">
              <a href="#">नियम र शर्तहरू</a>
            </div>
          </div>
      </div>
      <div class="col-md-4 gy-5 gx-5 d-flex justify-content-center align-items-center" style="flex-direction:column;">
          <p class="foot_title display-6 text-center" style="font-weight:700;">स्थान</p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2723.4279550372253!2d87.50420574853884!3d26.73830469689345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2snp!4v1695029463556!5m2!1sen!2snp" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
  </div><hr>
  <div class="text-center">
    Website Developed By <a href="https://www.thapabikal.com.np" target="blank">Bikal Thapa</a>
  </div><br>
    <?php
}
?>