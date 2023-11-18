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

<form method="post" action="" class="col-sm-6 col" style="margin:auto; max-width:98vw;">
  <div class="row" style="margin-bottom:10px;">
    <div class="col col-sm-9">
      <select class="form-select border-primary" id="exam_title">
        <option value="1">First Terminal Exam</option>
        <option value="2">Second Terminal Exam</option>
        <option value="3">Third Terminal Exam</option>
        <option value="4">Final Exam</option>
      </select>      
    </div>
    <div class="col">
      <select class="form-select border-primary" id="year">
        <option value="2080">2080</option>
        <option value="2077">2078</option>
        <option value="2076">2077</option>
        <option value="2075">2076</option>
      </select>      
    </div>
  </div>
    <select class="form-select border-primary" id="grade" aria-label="Default select example">
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

<div class="row row-cols-2 row-cols-md-2 d-flex justify-content-center" id="grade_sheet_control">
  <button class="btn btn-primary col g-5" style="max-width:98%; margin:10px;" id="print_btn">Print</button>
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
    $("#print_btn").hide();
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
          if(type=="grade_load"){
            $("#grade").html(data);
          }else if(type=="grade"){
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
            $("#print_btn").show();
          }
        },
        complete: function(){
          $("#result_spinner").hide();
        }
      })
    }
    $("#print_btn").click(function(){// It will print the marksheet
      var temp = $("#grade_sheet").html();
      $("#grade_sheet").html($("#main_body").html());
      $("#main_body").html(temp);
      window.print();
      location.reload();
    });
    var term = $("#exam_title").val();
    var year = $("#year").val();
    var grade_id,section_id,std_id,dob;
    loadData("title",term);
    loadData("year",year);
    loadData("grade_load",0);
    //It will execute if Term is changed //
    $("#exam_title").on("change",function(){
      term = $("#exam_title").val();
      loadData("title",term);
      $("#grade").val(0);
      $("#student_name").hide();
      $("#section").hide();
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#print_btn").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if year is changed //
    $("#year").on("change",function(){
      year = $("#year").val();
      loadData("year",year);
      $("#grade").val(0);
      $("#student_name").hide();
      $("#section").hide();
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#print_btn").hide();
      $("#date_of_birth").val("");
    });
    //It will execute if grade is changed //
    $("#grade").on("change",function(){
      grade_id = $("#grade").val();
      loadData("grade", grade_id);
      $("#student_name").hide();
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#print_btn").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if section is changed//
    $("#section").on("change",function(){
      section_id = $("#section").val();
      loadData("section",section_id);
      $("#date_of_birth").hide();
      $("#grade_sheet").hide();
      $("#print_btn").hide();
      $("#date_of_birth").val("");
    });
    // It will execute if name is selected //
    $("#student_name").on("change",function(){
      std_id = $("#student_name").val();
      loadData("name",std_id);
      $("#date_of_birth").show();
      $("#grade_sheet").hide();
      $("#print_btn").hide();
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