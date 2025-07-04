<?php
session_start();

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Require login
if (empty($_SESSION['login_id'])) {
  die("Unauthorized access. Please login.");
}

$userId = $_SESSION['login_id'];
$csrfToken = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-lg p-4 rounded-4 mx-auto" style="max-width: 500px;">
    <h4 class="mb-4 text-center text-primary">🔐 Change Your Password</h4>

    <form id="changePasswordForm">
      <input type="hidden" id="csrfToken" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

      <div class="mb-3">
        <label for="currentPassword" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="currentPassword" required>
      </div>

      <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <input type="password" class="form-control" id="newPassword" required>
      </div>

      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="confirmPassword" required>
      </div>

      <div id="feedback" class="text-danger mb-3"></div>

      <button type="submit" class="btn btn-primary w-100">Change Password</button>
    </form>
  </div>
</div>

<script>
const userId = <?= json_encode($userId) ?>;

$('#changePasswordForm').on('submit', function(e) {
  e.preventDefault();

  const current = $('#currentPassword').val().trim();
  const newPass = $('#newPassword').val().trim();
  const confirm = $('#confirmPassword').val().trim();
  const csrf = $('#csrfToken').val();

  if (newPass !== confirm) {
    $('#feedback').text('New passwords do not match.');
    return;
  }

  $.ajax({
    url: 'update_data.php',
    type: 'POST',
    data: {
      action: 'change_password',
      u_id: userId,
      current_password: current,
      new_password: newPass,
      csrf_token: csrf
    },
    success: function(res) {
      if (res === 'success' || res.status === 'success') {
        $('#feedback').removeClass('text-danger').addClass('text-success').text('Password changed successfully.');
        $('#changePasswordForm')[0].reset();
      } else {
        const error = res.message || res;
        $('#feedback').removeClass('text-success').addClass('text-danger').text(error);
      }
    },
    error: function() {
      $('#feedback').text('Server error. Please try again.');
    }
  });
});
</script>

</body>
</html>
