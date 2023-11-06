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
    </style>
</head>
<body>
<div class="w-50" style="margin:auto;">
<p class="display-6 text-center">SSBSS Login</p>
    <form class="login_form">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control border-primary" id="exampleInputPassword1">
    </div>
    <label for="exampleInputEmail1" class="form-label">Your Role</label>
    <div class="roles row" style="margin-left:10px;">
        <div class="form-check gx-5 col col-md-3">
            <input class="form-check-input border-primary" name="role" type="radio" value="" id="flexCheckIndeterminateDisabled" checked>
            <label class="form-check-label" for="flexCheckIndeterminateDisabled">Admin</label>
        </div>

        <div class="form-check gx-5 col col-md-3">
            <input class="form-check-input border-primary" name="role" type="radio" value="" id="flexCheckDisabled">
            <label class="form-check-label" for="flexCheckDisabled">Teacher</label>
        </div>

        <div class="form-check gx-5 col col-md-3">
            <input class="form-check-input border-primary" name="role" type="radio" value="" id="flexCheckCheckedDisabled">
            <label class="form-check-label" for="flexCheckCheckedDisabled">Student</label>
        </div>
    </div>
    <p class="text-center text-primary">Doesn't have account | Sign In</p>
    <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>