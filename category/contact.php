<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Style/style.css">
    <link rel="icon" type="icon" href="../images/slogo.png">
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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

  <div class="logo text-center">
    <img src="../images/slogo.png" class="logo">
    <p class="headings">Shree Shanti Bhagwati Secondary School</p>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav nav-underline">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="news.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="contact.php">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="faculty.php">Faculty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="authorities.php">Authorities</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="admission.php">Admission</a></li>
            <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
            <li><a class="dropdown-item" href="result.php">Results</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- contact section -->
<div class="border-primary col-sm-4 card contact_card">
<div class="mb-3">
  <label class="form-label">Name</label>
  <input type="text" class="border-primary form-control" placeholder="Your Name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control border-primary" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label class="form-label">Phone</label>
  <input type="number" class="border-primary form-control" placeholder="+977 98..">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Your Messages</label>
  <textarea class="form-control border-primary" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<div class="mb-3">
  <label class="form-label">Your Role</label>
  <div class="row" style="margin-left:5px;">
        <div class="col-sm-4 form-check">
          <input class="form-check-input border-primary" type="radio" id="student" name="role">
          <label class="form-check-label" for="student">Student</label>
        </div>
        <div class="col-sm-4 form-check">
          <input class="form-check-input border-primary" type="radio" id="parent" name="role" style="border:1px solid black;">
          <label class="form-check-label" for="parent">Parents</label>
        </div>
        <div class="col-sm-4 form-check">
          <input class="form-check-input border-primary" type="radio" id="guest" name="role" style="border:1px solid black;">
          <label class="form-check-label" for="guest">Guest</label>
        </div>
  </div>
</div>
<input type="submit" class="btn btn-primary" name="submit" value="Send">
</div>

<!-- Website Footer -->
<hr>
<div class="row">
    <div class="gx-5 gy-5 col-md-4">
        <p class="foot_title display-6 text-center">INFORMATION OFFICER</p>
        <img src="../images/shree_prashad_dhakal.jpg" style="margin-left: 30%;max-width:40%;">
        <p class="foot_title display-6 text-center">Homnath Poudyal</p>
    </div>
    <div class="col-md-4 gx-5 gy-5">
        <p class="foot_title display-6 text-center">CONTACT US</p>
        <p>
          Address : Letang-4, Morang<br>
          Phone : 021-560034<br>
          Email : shantibhagawatiletang2009@gmail.com
        </p>
    </div>
    <div class="col-md-4 gy-5 gx-5">
        <p class="foot_title display-6 text-center">LOCATION</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2723.4279550372253!2d87.50420574853884!3d26.73830469689345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2snp!4v1695029463556!5m2!1sen!2snp" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>