<?php
if(isset($_COOKIE['login_id'])){
    header("location:../admin/");
    // echo "Login_id is set";
}
?>
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
<p class="display-6 text-center text-dark"><a href="../">SSBSS</a> Login</p>
    <form class="login_form" id="login_form" method="post" autocomplete="false">
    <div class="mb-3">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="Email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text text-danger"></div>
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label" id="password" autocomplete="new-password">Password</label>
        <input type="password" name="password" class="form-control" id="Password" aria-describedby="passwordHelp">
        <div id="passwordHelp" class="form-text text-danger"></div>
    </div>
    <label class="form-label">Your Role</label>
    <div class="roles row" style="margin-left:10px;">
        <div class="form-check gx-5 col col-md-4">
            <input class="form-check-input border-primary" name="role" type="radio" value="Admin" id="admin_check" checked>
            <label class="form-check-label" for="admin_check">Admin</label>
        </div>
        <div class="form-check gx-5 col col-md-4">
            <input class="form-check-input border-primary" type="radio" name="role" value="Student" id="student_check">
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
    <button type="submit" class="btn btn-primary w-100 login-btn">Login</button><br><br>
    <a href="forget-password" style="text-decoration:none; display:flex; justify-content:center; align-items-center;">Forget Password ?</a><hr>
    <a href="sign-up" class="btn create_account_btn w-100">Create A New Account</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
    $("#login_form").on("submit",function(e){
        e.preventDefault();
        var email = $("#Email").val();
        var password = $("#Password").val();
        if(email==""){// Email is Empty
            $("#emailHelp").html("Email is not choosen");
            $("#Email").addClass(" border-danger");
        }else{//Email is Not Empty
            if(password==""){// Password is empty
                $("#passwordHelp").html("Password is not choosen");
                $("#Password").addClass(" border-danger");
            }else{// Password is not empty
                $.ajax({
                    url:"validate_login.php",
                    type:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        if(data=="success"){
                            $("#login_form")[0].reset();
                            window.location.replace("../admin/index.php");
                        }else if(data=="password_not_match"){
                            $("#Password").addClass(" border-danger");
                            $("#passwordHelp").html("Password doesn't match.");
                        }else if(data=="data_doesn't_exists"){
                            alert("Invalid Email or role");
                        }
                    }
                });
            }
        }

    })
    // This function executes when email is being entered
    $("#Email").on("input",function(){
        if($("#emailHelp").html()!=""){// Email contains an error
            $("#Email").removeClass(" border-danger");
            $("#emailHelp").html("");
        }
    });
    // This function executes when password is being entered
    $("#Password").on("input",function(){
        if($("#passwordHelp").html()!=""){// Password contains an error
            $("#Password").removeClass(" border-danger");
            $("#passwordHelp").html("");
        }
    })
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>