<?php
include "../../connection.php";
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
include "../../script/php_scripts/utilities/tables.php";
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
                                    data-bs-toggle="modal" data-bs-target="#roleModal" onclick="setUser('<?php echo $userId; ?>')">
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
                    <form id="roleForm">
                        <!-- Role Select -->
                        <div class="mb-3">
                            <label class="form-label" for="userRole">User Role</label>
                            <select class="form-select" id="userRole">
                                <option value="">Select Role</option>
                                <option value="G">Guest</option>
                                <option value="T">Teacher</option>
                                <option value="E">Editor</option>
                                <option value="S">Student</option>
                            </select>
                        </div>

                        <!-- Class (initially hidden) -->
                        <div class="mb-3" id="classWrapper" style="display: none;">
                            <label for="userClass" class="form-label">Class</label>
                            <select class="form-control" id="userClass" name="userClass">
                                <option value="" disabled selected>Loading classes...</option>
                            </select>
                        </div>

                        <!-- Section (initially hidden) -->
                        <div class="mb-3" id="sectionWrapper" style="display: none;">
                            <label for="userSection" class="form-label">Section</label>
                            <select class="form-control" id="userSection" name="userSection">
                                <option value="" disabled selected>Select section</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
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
        function setUser(id){
            selectedUserId = id;
        }


        $(document).ready(function () {
            const $classWrapper = $('#classWrapper');
            const $sectionWrapper = $('#sectionWrapper');
            const $userClass = $('#userClass');
            const $userSection = $('#userSection');
            const $submitBtn = $('#submitBtn');
            const $userRole = $('#userRole');

            $submitBtn.prop('disabled', true); // Disable on load

            function resetFields() {
                $classWrapper.hide();
                $sectionWrapper.hide();
                $userClass.empty();
                $userSection.empty();
                $submitBtn.prop('disabled', true);
            }

            function validateForm() {
                const role = $userRole.val();
                if (role === 'T') {
                    const classSelected = $userClass.val();
                    const sectionSelected = $userSection.val();
                    $submitBtn.prop('disabled', !(classSelected && sectionSelected));
                } else if (role && role !== 'T') {
                    $submitBtn.prop('disabled', false);
                } else {
                    $submitBtn.prop('disabled', true);
                }
            }

            $userRole.on('change', function () {
                const role = $(this).val();
                resetFields();

                if (role === 'T') {
                    $.ajax({
                        url: 'action/read_data.php',
                        method: 'POST',
                        data: { typ: "class" },
                        success: function (response) {
                            if (response.status === 'success') {
                                $userClass.append('<option value="" disabled selected>Select class</option>');
                                response.data.forEach(cls => {
                                    $userClass.append(`<option value="${cls.class_id}">${cls.class_name}</option>`);
                                });
                                $classWrapper.show();
                            } else {
                                alert('Error loading classes: ' + response.message);
                            }
                        },
                        error: function () {
                            alert('Failed to load classes.');
                        }
                    });
                } else {
                    validateForm();
                }
            });

            $userClass.on('change', function () {
                const classId = $(this).val();
                $userSection.empty().append('<option value="" disabled selected>Loading...</option>');
                $sectionWrapper.hide();
                $submitBtn.prop('disabled', true);

                if (classId) {
                    $.ajax({
                        url: 'action/read_data.php',
                        method: 'POST',
                        data: { class_id: classId, typ: "section" },
                        success: function (response) {
                            if (response.status === 'success') {
                                $userSection.empty().append('<option value="" disabled selected>Select section</option>');
                                if (response.data.length === 0) {
                                    $userSection.append('<option value="" disabled>No sections available</option>');
                                    $submitBtn.prop('disabled', false);
                                } else {
                                    response.data.forEach(sec => {
                                        $userSection.append(`<option value="${sec.section_id}">${sec.section_name}</option>`);
                                    });
                                    $sectionWrapper.show();
                                }
                            } else {
                                alert('Error loading sections: ' + response.message);
                            }
                        },
                        error: function () {
                            alert('Failed to load sections.');
                        }
                    });
                }
            });

            $userSection.on('change', function () {
                validateForm();
            });

            $('#submitBtn').on('click', function () {
                const role = $('#userRole').val();
                const classId = $('#userClass').val();
                const sectionId = $('#userSection').val();

                // Basic validation (extra safety)
                if (!role) {
                    alert("Please select a role.");
                    return;
                }
                if (role === 'T' && !classId) {
                    alert("Please select a class.");
                    return;
                }
                if (role === 'T' && $('#sectionWrapper').is(':visible') && !sectionId) {
                    alert("Please select a section.");
                    return;
                }

                // Prepare form data
                const formData = {
                    u_id: selectedUserId, // Assuming this is set when the modal opens
                    u_role: role,
                    class_id: classId || null,
                    section_id: sectionId || null
                };

                // AJAX submit
                $.ajax({
                    url: 'action/update_data.php', // Your PHP handler
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log( response);
                        if (response.status === 'success') {
                            alert("Role assigned successfully!");
                            $('#roleModal').modal('hide'); // Close modal
                            $('#roleForm')[0].reset(); // Optional reset
                            $('#submitBtn').prop('disabled', true);
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function () {
                        alert("An unexpected error occurred.");
                    }
                });
            });

        });



    </script>
</body>

</html>