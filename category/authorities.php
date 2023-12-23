<?php
include "../script/php_scripts/header_and_footer.php";
$authorities = array(
array("राम कुमार श्रेषठ","व्यवस्थापन समिती","अधक्छ","../images/authorities_img/unknown_person.jpg"),
array("श्री प्रसाद ढकाल","शान्ती भगवती","प्रधान्अध्यापक","../images/authorities_img/school_head_teacher.jpg"),
array("सेामनाथ भट्रराइ","शान्ती भगवती","सहायक प्रधान्अध्यापक","../images/authorities_img/unknown_person.jpg"),
array("हेामनाथ पैड्याल","शान्ती भगवती","सुचना अधीकारी","../images/authorities_img/information_officer.jpg"),
array("लेख्नाथ पैड्याल","अङग्रेजी माध्यम्","सहायक प्र.अ/इन्चार्ज.","../images/authorities_img/english_medium_incharge.jpg"),
array("शान्ती प्र. चम्लगाँइ","विज्ञान तथा इन्जीनियरीङ"," इन्चार्ज.","../images/authorities_img/science_and_engineering_incharge.jpg"),
array("टङक थापा मगर","नेपाली माध्यम्"," इन्चार्ज.","../images/authorities_img/unknown_person.jpg"),
array("रेम्रनाथ पैड्याल","शिक्षा तथा वाणीज्य"," इन्चार्ज.","../images/authorities_img/education_and_commerce_incharge.jpg"),
array("विरेन्द्र कुमार लिम्बु","अङग्रेजी माध्यम्","संयोजक","../images/authorities_img/unknown_person.jpg")
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorities | SSBSS</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Style/style.css">
    <link rel="icon" type="icon" href="../images/slogo.png">
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
    .authorized_person{
        border-radius: 100%;
        border: 1px solid black;
    }
    .authorized_card{
        box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px; 
    }
</style>
</head>
<body>
<!-- navigation bar  -->
<?php
print_header(1,"authorities");
?>
<!-- Authorities Cards  -->
<div class="row row-cols-md-4 row-cols-1 d-flex justify-content-center align-items-center">
    <?php
    foreach ($authorities as $key => $value) {
        $image_src = $value[3];
        $name = $value[0];
        $organization = $value[1];
        $post = $value[2];
    ?>
  <div class="col g-5">
    <div class="card authorized_card border-primary">
      <div class="card-body">
        <img src="<?php echo $image_src?>" class="card-img authorized_person">
        <div class="authorities_description">  
            <h5 class="card-title text-center"><?php echo $name; ?></h5>
            <p class="text-secondary text-center">
                <?php echo $organization?><br>
                <?php echo $post;?>
            </p>
        </div>
      </div>
    </div>
  </div>
  <?php
    }
  ?>
</div>



<!-- Website Footer -->
<?php
print_footer("../images/");
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>