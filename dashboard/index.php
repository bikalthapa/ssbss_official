<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Awaiting Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .approval-image {
            max-width: 300px;
        }
    </style>
</head>

<body>

    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center px-4">
            <!-- Illustration -->
            <img src="https://undraw.co/api/illustrations/0bcf9d4a-56cf-4055-90f2-b790da74ce46"
                alt="Waiting Approval Illustration" class="approval-image mb-4">

            <!-- Spinner -->
            <div class="mb-4">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Message -->
            <h2 class="mb-3">Account Awaiting Approval</h2>
            <p class="text-muted mb-4">
                Your account has been created successfully, but requires admin approval before you can log in.<br>
                You will receive an email once your account is activated.
            </p>

            <a href="/" class="btn btn-outline-primary">Return to Home</a>
        </div>
    </div>

</body>

</html>