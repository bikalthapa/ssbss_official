<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSBSS | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            box-shadow: rgba(42, 67, 113, 0.15) 8px 8px 30px;
            border-radius: 10px;
            padding: 20px;
            width: clamp(300px, 30vw, 500px);
            background-color: white;
        }

        .create_account_btn {
            background-color: #42b72a;
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
        <h1 class="display-6 text-center text-dark">
            <a href="../" class="text-decoration-none text-dark">SSBSS</a> Sign Up
        </h1>
        <form class="login_form" id="signup_form" method="post" autocomplete="off" novalidate>
            <div class="mb-3">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" name="user_name" class="form-control signup_input" id="user_name" required />
                <div class="invalid-feedback">Please enter a username.</div>
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">Email address</label>
                <input type="email" name="user_email" class="form-control signup_input" id="user_email" required />
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control signup_input" id="user_password"
                    required minlength="6" />
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
            </div>
            <div class="mb-3">
                <label for="user_cpassword" class="form-label">Confirm Password</label>
                <input type="password" name="user_cpassword" class="form-control signup_input" id="user_cpassword"
                    required />
                <div class="invalid-feedback">Passwords must match.</div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <br /><br />
            <a href="index" class="btn create_account_btn w-100">Already Have Account | Login</a>
        </form>
        <div id="form_message" class="mt-3"></div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/javascript/UI/toast.js"></script>
    <script>
        $(document).ready(function () {
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function validateField(field) {
                const id = field.attr("id");
                const val = field.val().trim();

                switch (id) {
                    case "user_name":
                        return val !== "";
                    case "user_email":
                        return validateEmail(val);
                    case "user_password":
                        return val.length >= 6;
                    case "user_cpassword":
                        return val === $("#user_password").val() && val.length >= 6;
                    default:
                        return true;
                }
            }

            // Real-time validation feedback
            $(".signup_input").on("input", function () {
                const input = $(this);
                if (validateField(input)) {
                    input.removeClass("is-invalid");
                }
            });

            $("#signup_form").on("submit", function (e) {
                e.preventDefault();
                let valid = true;

                $(".signup_input").each(function () {
                    const input = $(this);
                    if (!validateField(input)) {
                        input.addClass("is-invalid");
                        valid = false;
                    } else {
                        input.removeClass("is-invalid");
                    }
                });

                if (!valid) {
                    ToastManager.show("Form Error", "Please correct the highlighted fields.", "warning");
                    return;
                }

                const formData = new FormData(this);

                $.ajax({
                    url: "validate_signup.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === "success") {
                            ToastManager.show("Success", response.message || "Signup successful!", "success");
                            $("#signup_form")[0].reset();
                        } else {
                            ToastManager.show("Signup Failed", response.message || "Something went wrong.", "danger");
                        }
                    },
                    error: function (xhr) {
                        ToastManager.show("Server Error", xhr.statusText || "Something went wrong.", "danger");
                    }
                });
            });
        });

    </script>


</body>

</html>