<?php
include "script/php_scripts/database.php";
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Publication | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Style/style.css">
    <link rel="icon" type="icon" href="images/slogo.png">
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
<?php
print_header("result");
?>


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
      <select class="form-select border-primary" id="year_dropdown">
      <?php
        $sql = "SELECT DISTINCT published_year FROM result_files;";
        $result = mysqli_query($conn, $sql);
        if($result){
          $str = "";
          while($row = mysqli_fetch_assoc($result)){
            $year_val = $row['published_year'];
      ?>
            <option value='<?php echo $year_val?>'><?php echo $year_val ?></option>
      <?php
          }
        }
      ?>   
      </select>      
    </div>
  </div>
    <select class="form-select border-primary" id="grade">
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
<?php
print_footer();
?>
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
          if(type=="title"){
            // $("#year_dropdown").html(data);
          }else if(type=="year"){
          }else if(type=="grade_load"){
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
    loadData("title",term);
    var year = $("#year_dropdown").val();
    loadData("year",year);
    loadData("grade_load",0);
    var grade_id,section_id,std_id,dob;

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>