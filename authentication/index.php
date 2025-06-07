<?php
require_once "../script/php_scripts/utilities/authentication.php";
// Start session and check if user is already logged in
if ($auth->isLoggedIn() == "A") {
    header("Location: ../dashboard/admin/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSBSS | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login_container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .login_form {
            border: 1px solid lightgrey;
            box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
            border-radius: 10px;
            padding: 10px 20px 10px 20px;
            width: clamp(300px, 30vw, 500px);
            background-color: white;
        }

        .login_btn {
            font-size: 25px;
        }

        .create_account_btn {
            background-color: #42B72A;
            color: white;
        }

        .create_account_btn:hover {
            background-color: #5cd544;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container login_container">
        <p class="display-6 text-center text-dark"><a href="../">SSBSS</a> Login</p>
        <form class="login_form" id="login_form" method="post" autocomplete="off">
            <div class="mb-3">
                <label for="Email" class="form-label">Email address</label>
                <input type="email" name="user_email" class="form-control" id="Email">
                <div id="emailHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control" id="Password">
                <div id="passwordHelp" class="form-text text-danger"></div>
            </div>
            <button type="submit" class="btn btn-primary w-100 login-btn">Login</button><br><br>
            <!-- <a href="forget-password" class="d-block text-center text-decoration-none">Forget Password?</a><hr> -->
            <a href="sign-up" class="btn create_account_btn w-100">Create A New Account</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/javascript/UI/toast.js"></script>
    <script src="../script/javascript/login.js"></script>
</body>

</html>