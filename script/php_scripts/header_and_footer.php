<?php
include __DIR__ . "/utilities/authentication.php";
// This function will print the header of the page
$login_condition = $auth->isLoggedIn() != "";
function print_header($active)
{
  global $login_condition;
  ?>
  <!-- माथिल्लो ब्रान्डिङ बार (Non-Sticky) -->
  <nav class="navbar bg-warning-subtle py-2 shadow-sm">
    <div class="container-fluid px-3">
      <div class="row w-100 align-items-center">
        
        <!-- Left: Logo + School Name -->
        <div class="col-12 col-md-6 d-flex align-items-center gap-3 mb-2 mb-md-0">
          <img src="images/slogo.png" alt="Logo" class="rounded-5" style="height: 50px;">
          <h6 class="mb-0 fw-bold text-warning text-nowrap" data-i18n="school.name">
            श्री शान्ति भागवती माध्यमिक विद्यालय
          </h6>
        </div>

        <!-- Right: Contact + Online Services -->
        <div class="col-12 col-md-6 d-flex flex-column flex-md-row align-items-md-center justify-content-md-end gap-3 text-end">
          
          <!-- Contact Info -->
          <div class="small text-primary">
            <div><i class="bi bi-envelope-fill me-1"></i><span data-i18n="school.email"> info@school.edu.np</span></div>
            <div><i class="bi bi-telephone-fill me-1"></i> <span data-i18n="school.phone">+९७७-१-१२३४५६७</span></div>
          </div>

          <!-- Online Services Dropdown -->
          <div class="dropdown">
            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-globe2 me-1"></i> <span data-i18n="menu.online_services">अनलाइन सेवा</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $active == 'admission' ? 'active text-primary fw-semibold' : '' ?>"
                  href="admission">
                  <i class="bi bi-person-plus"></i> अनलाइन भर्ना
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $active == 'result' ? 'active text-primary fw-semibold' : '' ?>"
                  href="result">
                  <i class="bi bi-clipboard-data"></i> नतिजा हेर्नुहोस्
                </a>
              </li>
            </ul>
          </div>

          <!-- Language Switcher -->
          <select id="lang-switcher" class="form-select form-select-sm w-auto">
            <option value="en">En</option>
            <option value="np">नेपा</option>
          </select>

        </div>
      </div>
    </div>
  </nav>


  <!-- मुख्य नेभिगेसन बार (Sticky) -->
  <nav class="navbar navbar-expand-lg bg-light sticky-top shadow-sm border-bottom" style="z-index: 1020;">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
        <ul class="navbar-nav gap-3">

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1 <?php echo $active == 'home' ? 'active fw-semibold text-primary' : '' ?>"
              href="index">
              <i class="bi bi-house-door"></i> <span data-i18n="menu.home">गृहपृष्ठ</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1 <?php echo $active == 'news' ? 'active fw-semibold text-primary' : '' ?>"
              href="news">
              <i class="bi bi-megaphone"></i> <span data-i18n="menu.news">सूचना</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1 <?php echo $active == 'contact' ? 'active fw-semibold text-primary' : '' ?>"
              href="contact">
              <i class="bi bi-telephone"></i><span data-i18n="menu.contact"> सम्पर्क</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1 <?php echo $active == 'faculty' ? 'active fw-semibold text-primary' : '' ?>"
              href="faculty">
              <i class="bi bi-people"></i><span data-i18n="menu.faculty">विभागहरू</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-1 <?php echo $active == 'authorities' ? 'active fw-semibold text-primary' : '' ?>"
              href="authorities">
              <i class="bi bi-person-badge"></i><span data-i18n="menu.authorities"> प्रशासन</span>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-1 <?php echo in_array($active, ['login', 'result', 'admission', 'gallery']) ? 'fw-semibold text-primary' : '' ?>"
              href="#" role="button" data-bs-toggle="dropdown" data-i18n="menu.other">
              अरु
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $active == 'login' ? 'active text-primary fw-semibold' : '' ?>"
                  href="authentication/">
                  <i class="bi bi-box-arrow-in-right"></i> <?php echo $login_condition ? "<span data-i18n='menu.dashboard'>व्यवस्थापक</span>" : "<span data-i18n='menu.login'>लग-इन</span>"; ?>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $active == 'admission' ? 'active text-primary fw-semibold' : '' ?>"
                  href="admission">
                  <i class="bi bi-person-plus"></i> <span data-i18n="menu.admission">विधार्थी भर्ना</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 <?php echo $active == 'gallery' ? 'active text-primary fw-semibold' : '' ?>"
                  href="gallery">
                  <i class="bi bi-images"></i> <span data-i18n="menu.gallery">ग्यालरी</span>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <?php
}




//This function will print the footer of the page
function print_footer()
{
  ?><br>
  <hr>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-4 d-flex justify-content-center align-items-center flex-column">
        <p class="fs-5 text-center fw-bolder" data-i18n="authorities.3.position">सुचना अधिकारी तथा सहायक प्र.अ</p>
        <img src="images/authorities_img/information_officer.jpg"
          style="max-width:50%; border:1px solid black; margin:auto;">
        <p class="fs-5 text-center" data-i18n="authorities.3.name">लेखनाथ पौड्याल</p>
      </div>
      <div class="col-md-4">
        <p class="fs-5 text-center fw-bolder" data-i18n="common.contact_us">सम्पर्क गर्नुहोस्</p>
        <p>
          <span data-i18n="footer.address">ठेगाना : लेटाङ ५, मेराङ</span> <br>
          <span data-i18n="footer.contact">सम्पर्क नम्बर : ०२१-५६००३४</span><br>
          <span data-i18n="footer.email">इमेल : shantibhagawatiletang2009@gmail.com</span>
        </p>
        <div class="row">
          <div class="col">
            <a href="https://www.facebook.com/SSBSS.L4" target="blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook"
                viewBox="0 0 16 16">
                <path
                  d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
              </svg>
            </a>
          </div>
          <div class="col">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter"
              viewBox="0 0 16 16">
              <path
                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15" />
            </svg>
          </div>
          <div class="col">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill"
              viewBox="0 0 16 16">
              <path
                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
            </svg>
          </div>
        </div><br>
        <div class="row">
          <div class="col">
            <a href="#" data-i18n="footer.privacy">गोपनीयता नीति</a>
          </div>
          <div class="col">
            <a href="#" data-i18n="footer.terms">नियम र शर्तहरू</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex justify-content-center align-items-center flex-column">
        <p class="fs-5 text-center fw-bolder" data-i18n="footer.location">स्थान</p>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d730.7346048992009!2d87.50285265078094!3d26.737957315466375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef605715a77919%3A0x448599134f99e5c7!2sShree%20Shanti%20Bhagawati%20Secondary%20School!5e1!3m2!1sen!2snp!4v1749722524254!5m2!1sen!2snp"
          width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <span data-i18n="footer.dev.by">Website Developed By</span> &nbsp;<a href="https://www.thapabikal.com.np" target="blank" data-i18n="footer.dev.name">Bikal Thapa</a>
    </div>
  </div>
  <?php
}
?>