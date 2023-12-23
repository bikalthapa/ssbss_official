
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSBSS | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .login_form{
            border:1px solid lightgrey;
            box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
            border-radius:10px;
            padding:10px 20px 10px 20px;
            background-color:white;
        }
        .login_btn{
            font-size:25px;
        }
        .create_account_btn{
            background-color:#42B72A;
            color:white;
        }
        .create_account_btn:hover{
            background-color:#5cd544;
            color:white;
        }
    </style>
</head>
<body>
<div class="w-25" style="margin:auto;">
<p class="display-6 text-center text-dark"><a href="../">SSBSS</a> Sign Up</p>
<form class="login_form" id="signup_form" method="post" autocomplete="false">
    <div class="mb-3">
        <label for="username" class="form-label" id="userHelp">Username</label>
        <input type="text" name="username" class="form-control signup_input" id="username" aria-describedby="userHelp">
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label" id="emailHelp">Email address</label>
        <input type="email" name="email" class="form-control signup_input" id="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="Password" id="passwordHelp" class="form-label" autocomplete="new-password">Password</label>
        <input type="password" name="password" class="form-control signup_input" id="password" aria-describedby="passwordHelp">
    </div>
    <div class="mb-3">
        <label for="cpassword" class="form-label" id="cpasswordHelp" autocomplete="new-password">Confirmation Password</label>
        <input type="password" name="password" class="form-control signup_input" id="cpassword" aria-describedby="cpasswordHelp">
    </div>
    <label class="form-label">Your Role</label>
    <div class="roles row" style="margin-left:10px;">
        <div class="form-check gx-5 col col-md-4">
            <input class="form-check-input border-primary" checked type="radio" name="role" value="Student" id="student_check">
            <label class="form-check-label" for="student_check">
                Students
            </label>
        </div>
        <div class="form-check gx-5 col col-md-4">
        <input class="form-check-input border-primary" disabled type="radio" value="teacher" name="role" id="teacher_check">
        <label class="form-check-label" for="teacher_check">
            Teacher
        </label>
        </div>
    </div><br>
    <button type="submit" class="btn btn-primary w-100 login-btn">Sign Up</button><br><br>
    <a href="index" class="btn create_account_btn w-100">Already Have Account | Login</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        var error_count = 0;
        function warn_user(input_field,message){
                var description = $("#"+input_field.attr("aria-describedby"));
                input_field.addClass("border-danger");
                input_field.attr("description",description.html());
                description.addClass("text-danger");
                description.html(message);
                error_count++;
        }
        $("#signup_form").on("submit",function(e){
            e.preventDefault();
            var username = $("#username");
            var email = $("#email");
            var password = $("#password");
            var confirm_password = $("#cpassword");

            if(username.val()==""){
                warn_user(username, "Username Required");
            }else if(email.val()==""){
                warn_user(email, "Email Required");
            }else if(password.val()==""){
                warn_user(password, "Password Required");
            }else if(confirm_password.val()==""){
                warn_user(confirm_password, "Confirm Password Required");
            }else if(password.val()!=confirm_password.val()){
                alert("Password doesn't match");
            }else{//You can login from here
                alert("Student's signup is under construction");
                $("#signup_form")[0].reset();
            }
        });
        var inputs = document.getElementsByClassName("signup_input");
        for(input of inputs){
            input.addEventListener("input",(e)=>{
                var selected = $("#"+e.target.id);
                var description = $("#"+selected.attr("aria-describedby"));
                    selected.removeClass("border-danger");
                    description.removeClass("text-danger");
                    description.html(selected.attr("description"));
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>