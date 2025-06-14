<?php
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Style/style.css">
    <link rel="icon" type="icon" href="images/slogo.png">
<style>
    .contact_card{
      margin: auto;
      box-shadow: 2px 2px 5px;
      padding: 15px;
    }
</style>
</head>
<body>
<!-- navigation bar  -->
<?php
print_header("contact");
?>
<br>
<p class="display-6 text-center" data-i18n="common.contact_us">सम्पर्क गर्नुहोस्</p>
<!-- contact section -->
<form class="border-primary col-sm-4 card contact_card gap-3" id="message_form" method="post" action="">
  <div class="mb-3">
    <label for="name" class="form-label" id="nameHelp" data-i18n="labels.name">नाम</label>
    <input type="text" id="name" name="name" class="border-primary form-control" data-i18n="input.name" data-i18n-attr="placeholder">
  </div>
  <div class="mb-3">
    <label for="emailaddress" class="form-label" id="emailHelp" data-i18n="labels.email">इमेल ठेगाना</label>
    <input type="email" name="email" class="form-control border-primary" id="emailaddress" data-i18n="input.email" data-i18n-attr="placeholder">
  </div>
  <div class="mb-3">
    <label for="message" class="form-label" id="messageHelp" data-i18n="labels.message">तपाईंको सन्देश</label>
    <textarea name="message" class="form-control border-primary" id="message" rows="3" data-i18n="input.message" data-i18n-attr="placeholder"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label" data-i18n="labels.scl_relation">विधालयसँगको नाता</label>
    <div class="row" style="margin-left:5px;">
          <div class="col-sm-4 form-check">
            <input class="form-check-input border-primary" type="radio" id="student" name="role">
            <label class="form-check-label" for="student" data-i18n="common.student">विधार्थी</label>
          </div>
          <div class="col-sm-4 form-check">
            <input class="form-check-input border-primary" type="radio" id="parent" name="role" checked>
            <label class="form-check-label" for="parent" data-i18n="common.parents">अभिभावक</label>
          </div>
          <div class="col-sm-4 form-check">
            <input class="form-check-input border-primary" type="radio" id="guest" name="role">
            <label class="form-check-label" for="guest" data-i18n="common.guest">पाहुना</label>
          </div>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" name="submit" data-i18n="button.send" data-i18n-attr="value">
</form>

<!-- Website Footer -->
<?php
print_footer();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="data/translation.js"></script>
<script src="script\javascript\contact_validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>