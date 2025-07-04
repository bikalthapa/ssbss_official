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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Style/style.css">
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
    </style>
</head>

<body>
    <!-- navigation bar  -->
    <?php
    print_header("admission");
    ?>
    <br>
    
    <div class="container d-flex justify-content-center align-items-center">
        <form class="w-75" id="admission_form">
            <p class="text-center display-6" data-i18n="admission_form.title.personalDetails">Personal Details</p>

            <div class="row">
                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="name" placeholder="Name"
                        aria-describedby="nameHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.name.placeholder">
                    <div id="nameHelp" class="form-text" data-i18n="admission_form.fields.name.help">Birth Certificate
                        Name</div>
                </div>

                <div class="col-sm-4 mb-3">
                    <input type="date" class="form-control admit_field" id="dob" aria-describedby="dobHelp">
                    <div id="dobHelp" class="form-text" data-i18n="admission_form.fields.dob.help">Your Birthday</div>
                </div>

                <div class="col-sm-3 mb-3">
                    <select class="form-select" id="gender" data-i18n-attr="aria-label" aria-label="Gender Selection"
                        data-i18n="admission_form.fields.gender.label">
                        <option value="Male" data-i18n="admission_form.fields.gender.options.male">Male</option>
                        <option value="Female" data-i18n="admission_form.fields.gender.options.female">Female</option>
                        <option value="Others" data-i18n="admission_form.fields.gender.options.others">Others</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="temp_address" placeholder="Current Address"
                        aria-describedby="tempAddressHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.temp_address.placeholder">
                    <div id="tempAddressHelp" class="form-text" data-i18n="admission_form.fields.temp_address.help">Your
                        Current Address</div>
                </div>

                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="permanent_address"
                        placeholder="Permanent Address" aria-describedby="permaAddressHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.permanent_address.placeholder">
                    <div id="permaAddressHelp" class="form-text"
                        data-i18n="admission_form.fields.permanent_address.help">Your Permanent Address</div>
                </div>

                <div class="col-sm-3 mb-3">
                    <input type="text" class="form-control admit_field" id="phoneOrEmail" placeholder="Phone Or Email"
                        aria-describedby="emailOrPhoneHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.phoneOrEmail.placeholder">
                    <div id="emailOrPhoneHelp" class="form-text" data-i18n="admission_form.fields.phoneOrEmail.help">
                        Your Contact Info</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="father_name" placeholder="Father's Name"
                        aria-describedby="fatherNameHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.father_name.placeholder">
                    <div id="fatherNameHelp" class="form-text" data-i18n="admission_form.fields.father_name.help">Your
                        Father's Name</div>
                </div>

                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="mother_name" placeholder="Mother's Name"
                        aria-describedby="motherNameHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.mother_name.placeholder">
                    <div id="motherNameHelp" class="form-text" data-i18n="admission_form.fields.mother_name.help">Your
                        Mother's Name</div>
                </div>

                <div class="col-sm-3 mb-3">
                    <input type="text" class="form-control admit_field" id="father_contact"
                        placeholder="Father's Contact No" aria-describedby="fatherContactHelp"
                        data-i18n-attr="placeholder" data-i18n="admission_form.fields.father_contact.placeholder">
                    <div id="fatherContactHelp" class="form-text" data-i18n="admission_form.fields.father_contact.help">
                        Father's Contact Info</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 mb-3">
                    <input type="text" class="form-control admit_field" id="mother_contact"
                        placeholder="Father's Contact No" aria-describedby="motherContactHelp"
                        data-i18n-attr="placeholder" data-i18n="admission_form.fields.mother_contact.placeholder">
                    <div id="motherContactHelp" class="form-text" data-i18n="admission_form.fields.mother_contact.help">
                        Father's Contact Info</div>
                </div>

                <div class="col-sm-3 mb-3">
                    <input type="file" class="form-control admit_field" id="birth_certificate"
                        placeholder="Previous Class Certificate" aria-describedby="birthCertificateHelp"
                        accept="image/jpg" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.birth_certificate.placeholder">
                    <div id="birthCertificateHelp" class="form-text"
                        data-i18n="admission_form.fields.birth_certificate.help">Birth certificate.</div>
                </div>
            </div>

            <p class="text-center display-6" data-i18n="admission_form.title.educationDetails">Education Details</p>

            <div class="row">
                <div class="col-sm-4 mb-3">
                    <input type="text" class="form-control admit_field" id="pre_school" placeholder="Prev. School Name"
                        aria-describedby="preSchoolHelp" data-i18n-attr="placeholder"
                        data-i18n="admission_form.fields.pre_school.placeholder">
                    <div id="preSchoolHelp" class="form-text" data-i18n="admission_form.fields.pre_school.help">Your
                        Previous School</div>
                </div>

                <div class="col-sm-4 mb-3">
                    <select class="form-select admit_field" id="admit_class" aria-describedby="admitClassHelp">
                        <?php
                        $sql = "SELECT * FROM class";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $class_id = $row['class_id'];
                                $class_name = $row['class_name'];
                                ?>
                                <option value="<?php echo $class_id; ?>"><?php echo $class_name ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <div id="admitClassHelp" class="form-text" data-i18n="admission_form.fields.admit_class.help">Class
                        that you want to admit.</div>
                </div>

                <div class="col-sm-3 mb-3">
                    <input type="file" class="form-control admit_field" id="certificate"
                        placeholder="Previous Class Certificate" aria-describedby="certificateHelp"
                        data-i18n-attr="placeholder" data-i18n="admission_form.fields.certificate.placeholder">
                    <div id="certificateHelp" class="form-text" data-i18n="admission_form.fields.certificate.help">
                        Previous Class certificate.</div>
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="admission_policy">
                <label class="form-check-label" for="admission_policy"
                    data-i18n="admission_form.fields.admission_policy.label">
                    I agree on SSBSS <a href="#">Admission Policy</a>.
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100" data-i18n="admission_form.buttons.submit">Admit
                Now</button>
        </form>
    </div>


    <!-- Website Footer -->
    <?php
    print_footer();
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../../script/javascript/admission_validate.js"></script>
    <script src="data/translation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</body>

</html>