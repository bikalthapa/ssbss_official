<?php
include "../../connection.php";
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
// Check if the user is logged in as an admin
if ($auth->isLoggedIn() != "A") {
    header("Location: ../../authentication/");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="../../images/slogo.png">
</head>

<body id="main_body">
    <?php
    get_navbar("user");
    ?>
    <br><br><br>
    <div class="container">
        <h2 class="mb-2">User Requests</h2>
        <form id="userSelectionForm" class="row row-cols-1 row-cols-md-2">
            <?php
            $sql = "SELECT * FROM users WHERE u_role IS null ORDER BY u_id DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row['u_id'];
                    $userName = $row['u_name'];
                    $userEmail = $row['u_email'];
                    ?>
                    <div class="col g-4">
                        <div class="card mb-3">
                            <div class="card-header d-flex align-items-center">
                                <img src="../../images/authorities_img/unknown_person.jpg" alt="Profile"
                                    class="rounded-circle me-3" width="40" height="40">

                                <label class="form-check-label" for="user1" style="cursor: pointer;">
                                    <strong id="name<?php echo $userId; ?>"><?php echo $userName; ?></strong><br>
                                    <small id="email<?php echo $userId; ?>" class="text-muted"><?php echo $userEmail; ?></small>
                                </label>
                                <button type="button" class="ms-auto btn bg-success bg-opacity-10 text-success me-2"
                                    data-bs-toggle="modal" data-bs-target="#roleModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-person-check" viewBox="0 0 16 16">
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                        <path
                                            d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                    </svg>
                                </button>
                                <button type="button" class="btn bg-danger bg-opacity-10 text-danger" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"
                                    onclick="prepareRejectModal('<?php echo $userId; ?>', '<?php echo htmlspecialchars($userName, ENT_QUOTES); ?>')">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-person-x" viewBox="0 0 16 16">
                                        <path
                                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </form>
    </div>

    <!-- Modal for assigning role -->
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Assign Role and Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Role</label>
                            <select class="form-select" id="userRole">
                                <option value="T">Teacher</option>
                                <option value="E">Editor</option>
                                <option value="S">Student</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userClass" class="form-label">Class</label>
                            <input type="text" class="form-control" id="userClass" list="classOptions"
                                placeholder="Select or type class">
                            <datalist id="classOptions">
                                <option value="1">
                                <option value="2">
                                <option value="3">
                                <option value="4">
                                <option value="5">
                                <option value="6">
                                <option value="7">
                                <option value="8">
                                <option value="9">
                                <option value="10">
                                <option value="11">
                                <option value="12">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="userSection" class="form-label">Section</label>
                            <input type="text" class="form-control" id="userSection" list="sectionOptions"
                                placeholder="Select or type section">
                            <datalist id="sectionOptions">
                                <option value="A">
                                <option value="B">
                                <option value="C">
                                <option value="D">
                                <option value="E">
                            </datalist>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal For Rejection-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Once you reject <b id="cuser_name1"></b>, It will permanently delete
                        <b id="cuser_name2"></b> from the database.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion()">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
    <script src="../../script/javascript/UI/toast.js"></script>
    <script>
        let selectedUserId = null;

        function prepareRejectModal(userId, userName) {
            selectedUserId = userId;
            document.getElementById('cuser_name1').textContent = userName;
            document.getElementById('cuser_name2').textContent = userName;
        }
        function confirmDeletion() {
            if (!selectedUserId) return;

            $.ajax({
                url: 'action/delete_data.php',
                type: 'POST',
                data: { u_id: selectedUserId },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#staticBackdrop').modal('hide');
                        $(`#name${selectedUserId}`).closest('.col').remove();
                        ToastManager.show('Success', response.message, 'success');
                    } else {
                        ToastManager.show('Error', "Failed: " + response.message, 'danger');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                    ToastManager.show('Error', "Something went wrong. Please try again.", 'danger');
                }
            });
        }

    </script>
</body>

</html>