<?php
include "script/php_scripts/database.php";
include "script/php_scripts/header_and_footer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Admission | SSBSS</title>
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
</style>
</head>
<body>
<!-- navigation bar  -->
<?php
print_header("admission");
?>

<div class="container d-flex justify-content-center align-items-center">
    <form class="w-75" id="admission_form">
        <p class="text-center display-6">Personal Details</p>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="name" aria-describedby="nameHelp" placeholder="Name">
                <div id="nameHelp" class="form-text">Birth Cirtificate Name</div>
            </div>
            <div class="col-sm-4 mb-3">
                <input type="date" class="form-control admit_field" id="dob" aria-describedby="dobHelp">
                <div id="dobHelp" class="form-text">Your Birthday</div>
            </div>
            <div class="col-sm-3 mb-3">
                <select class="form-select" id="gender" aria-label="Gender Selection">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="temp_address" aria-describedby="tempAddressHelp" placeholder="Current Address">
                <div id="tempAddressHelp" class="form-text">Your Current Address</div>
            </div>
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="permanent_address" aria-describedby="permaAddressHelp" placeholder="Permanent Address">
                <div id="permaAddressHelp" class="form-text">Your Permanent Address</div>
            </div>
            <div class="col-sm-3 mb-3">
                <input type="text" class="form-control admit_field" id="phoneOrEmail" aria-describedby="emailOrPhoneHelp" placeholder="Phone Or Email">
                <div id="emailOrPhoneHelp" class="form-text">Your Contact Info</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="father_name" aria-describedby="fatherNameHelp" placeholder="Father's Name">
                <div id="fatherNameHelp" class="form-text">Your Father's Name</div>
            </div>
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="mother_name" aria-describedby="motherNameHelp" placeholder="Mother's Name">
                <div id="motherNameHelp" class="form-text">Your Mother's Name</div>
            </div>
            <div class="col-sm-3 mb-3">
                <input type="text" class="form-control admit_field" id="father_contact" aria-describedby="fatherContactHelp" placeholder="Father's Contact No">
                <div id="fatherContactHelp" class="form-text">Father's Contact Info</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 mb-3">
                <input type="text" class="form-control admit_field" id="mother_contact" aria-describedby="motherContactHelp" placeholder="Father's Contact No">
                <div id="motherContactHelp" class="form-text">Father's Contact Info</div>
            </div>
            <div class="col-sm-3 mb-3">
                <input type="file" class="form-control admit_field" id="birth_certificate" aria-describedby="birthCertificateHelp" placeholder="Previous Class Certificate" accept="image/jpg">
                <div id="birthCertificateHelp" class="form-text">Birth certificate.</div>
            </div>     
        </div>
        <p class="text-center display-6">Education Details</p>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <input type="text" class="form-control admit_field" id="pre_school" aria-describedby="preSchoolHelp" placeholder="Prev. School Name">
                <div id="preSchoolHelp" class="form-text">Your Previous School</div>
            </div>
            <div class="col-sm-4 mb-3">
                <select class="form-select admit_field" id="admit_class" aria-describedby="admitClassHelp">
                    <?php
                        $sql = "SELECT * FROM class";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $class_id = $row['class_id'];
                                $class_name = $row['class_name'];
                                ?>
                                    <option value="<?php echo $class_id; ?>"><?php echo $class_name ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
                <div id="admitClassHelp" class="form-text">Class that you want to admit.</div>
            </div>
            <div class="col-sm-3 mb-3">
                <input type="file" class="form-control admit_field" id="certificate" aria-describedby="certificateHelp" placeholder="Previous Class Certificate">
                <div id="certificateHelp" class="form-text">Previous Class certificate.</div>
            </div>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="admission_policy">
        <label class="form-check-label" for="admission_policy">
            I agree on SSBSS <a href="#">Admission Policy</a>.
        </label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Admit Now</button>
    </form>
</div>
<!-- Website Footer -->
<?php
print_footer();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../../script/javascript/admission_validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>