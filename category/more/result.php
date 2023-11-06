<?php
include "../../connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Publication | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Style/style.css">
    <link rel="icon" type="icon" href="../../images/slogo.png">
<style>
    .controls{
        max-height:40px;
        min-width:45%;
        background-color:#dbdbdb;
        overflow: hidden;
    }
    .circle_image{
        border-radius: 100%;
        height: 100px;
        margin: auto;
        width: 100px;
    }
    .counter_title{
      font-size: 20px;
      text-align: center;
    }
    .news_cards{
      box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
    }

    .header{
      position: relative;
    }

    .header .logo{
      height: 100px;
      width: 100px;
      border: 2px solid black;
      border-radius: 100%;
      z-index: -1;
      margin: auto;
      position: absolute;
      left: 35px;
      top: 45px;
    }
    .details_data{
      font-weight: 800;
      color: black;
    }
    .details{
      font-size: 18px;
    }
    td, th{
      border: 1px solid black;
    }
    .design1{
      padding: 10px;
      max-height: 1600px;
      max-width: 800px;
      border: 2px solid blue;
      border-style: dashed;
      margin: 15px;
      margin: auto;
    }
    .GS{
      font-weight: 800px;
    }
    .head_para{
      z-index: 1;
    }
    .school_name{
      font-size: 30px;
      font-weight:700;
      text-transform: uppercase;
    }
    .examination_title{
      font-size: 25px;
      font-weight: bold;
      margin-top: -20px;
    }
    .signature{
      height: 70px;
      width: 120px;
    }
    .address{
      font-size: 20px;
      font-weight: bold;
    }
</style>
</head>
<body id="main_body">
<!-- navigation bar  -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

  <div class="logo text-center">
    <img src="../../images/slogo.png" class="logo">
    <p class="headings">Shree Shanti Bhagwati Secondary School</p>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav nav-underline">
        <li class="nav-item">
          <a class="nav-link" href="../../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../news.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../faculty.php">Faculty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../authorities.php">Authorities</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../admission.php">Admission</a></li>
            <li><a class="dropdown-item" href="../gallery.php">Gallery</a></li>
            <li><a class="dropdown-item" href="../result.php">Results</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<p class="display-6 text-center">Examination Result</p>

<form method="post" action="" class="col-sm-6 col" style="margin:auto;">
    <select class="form-select border-primary" id="grade" aria-label="Default select example">
    <option selected>Select Class</option>
    <?php
    $sql = "SELECT * FROM class;";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $classname = $row['class_name'];
            $id = $row['class_id'];
    ?>
    <option value="<?php echo $id; ?>"><?php echo $classname; ?></option>
    <?php
        }
    }
    ?>
    </select><br>
    <select class="border-primary form-select" id="section">
    </select><br>
    <select class="col form-select border-primary" id="student_name">
    </select><br>
    <input class="col form-control border-primary" Placeholder="DOB in y/m/d format" type="text" id="date_of_birth">
    <div class="d-flex justify-content-center col">
      <div class="spinner-border" role="status" id="result_spinner">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
</form>
<br><br>


<div id="grade_sheet">
</div>








<!-- Website Footer -->
<hr>
<div class="row">
    <div class="gx-5 gy-5 col-md-4">
        <p class="foot_title display-6 text-center">INFORMATION OFFICER</p>
        <img src="../../images/shree_prashad_dhakal.jpg" style="margin-left: 30%;max-width:40%;">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $("#section").hide();
    $("#student_name").hide();
    $("#date_of_birth").hide();
    $("#grade_sheet").hide();
    $("#result_spinner").hide();
    $("#print_btn").click(function(){
      alert();
      // var temp = $("#grade_sheet").html();
      // $("#grade_sheet").html($("#main_body").html());
      // $("#main_body").html(temp);
      // window.print();
    });
  $(document).ready(function(){
    function loadData(type, id){
      $.ajax({
        url : "result_data_loader.php",
        type : "POST",
        data : {type : type, id : id},
        beforeSend: function(){
          $("#result_spinner").show();
        },
        success: function(data){
          if(type=="grade"){
            if(data!=""){
              $("#section").show();
              $("#section").html(data);
            }else{
              $("#section").hide();
              loadData("section",0);
            }
          }else if(type=="section"){
            $("#student_name").show();
            $("#student_name").html(data);
          }else if(type=="name"){
            $("#date_of_birth").show();
          }else if(type=="dob"){
            $("#grade_sheet").html(data);
          }
        },
        complete: function(){
          $("#result_spinner").hide();
        }
      })
    }
    var grade_id,section_id,std_id,dob;
    //It will execute if grade is changed //
    $("#grade").on("change",function(){
      grade_id = $("#grade").val();
      loadData("grade", grade_id);
      $("#student_name").hide();
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if section is changed//
    $("#section").on("change",function(){
      section_id = $("#section").val();
      loadData("section",section_id);
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if name is selected //
    $("#student_name").on("change",function(){
      std_id = $("#student_name").val();
      loadData("name",std_id);
      $("#date_of_birth").show();
      $("#grade_sheet").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if user input on DOB section
    $("#date_of_birth").on("input",function(){
      dob = $("#date_of_birth").val();
      loadData("dob",dob);
      $("#grade_sheet").show();
    });
  })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>