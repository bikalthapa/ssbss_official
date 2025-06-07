$(document).ready(function () {
    $("#login_form").on("submit", function (e) {
        e.preventDefault();

        let email = $("#Email").val().trim();
        let password = $("#Password").val().trim();
        let valid = true;

        if (email === "") {
            $("#emailHelp").text("Email is required");
            $("#Email").addClass("border-danger");
            valid = false;
        }

        if (password === "") {
            $("#passwordHelp").text("Password is required");
            $("#Password").addClass("border-danger");
            valid = false;
        }

        if (!valid) return;

        $.ajax({
            url: "validate_login.php",
            type: "POST",
            data: $(this).serialize(), // FIXED HERE
            success: function (response) {
                if (response.status === "success") {
                    $("#login_form")[0].reset();
                    window.location.replace(response.data.redirect_url);
                } else if (response.status === "fail") {
                    ToastManager.show("Login Failed", "Invalid Credential.", "danger");
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Log detailed error
                ToastManager.show("Error", "An error occurred. Please try again later.", "warning");
            }
        });
    });

    $("#Email, #Password").on("input", function () {
        $(this).removeClass("border-danger");
        $("#" + this.id + "Help").text("");
    });
});
