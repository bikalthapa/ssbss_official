<?php
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
if ($auth->isLoggedIn() != "T") {
    header("Location: ../../authentication/");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SSBSS - Teachers</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="icon" href="../images/slogo.png">
</head>

<body>
    <?php
    get_navbar("dashboard");
    ?>
    <br><br><br>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-warning fw-bold">Course Management</h4>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="bi bi-plus-circle me-1"></i> Add Course
            </button>
        </div>

        <!-- Course Cards -->
        <div class="row g-4">
            <!-- Example Course Card -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 bg-warning-subtle h-100 position-relative">
                    <h5 class="text-warning fw-semibold">Mathematics</h5>
                    <p class="mb-0 text-muted">Assigned to: <span class="fw-semibold text-dark">Mr. Ram Thapa</span></p>

                    <!-- Dropdown -->
                    <div class="dropdown position-absolute top-0 end-0 m-2">
                        <i class="bi bi-three-dots-vertical text-warning" role="button" data-bs-toggle="dropdown"></i>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-pencil-fill text-primary me-2"></i> Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-trash-fill text-danger me-2"></i> Delete
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-info-circle-fill text-info me-2"></i> View Details
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Repeat course cards as needed -->
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning-subtle">
                    <h5 class="modal-title text-warning fw-bold" id="addCourseModalLabel">
                        <i class="bi bi-plus-circle me-1"></i> Add New Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-warning">Course Name</label>
                            <input type="text" class="form-control" placeholder="Enter course name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-warning">Assign Teacher</label>
                            <select class="form-select" required>
                                <option selected disabled>Choose a teacher</option>
                                <option>Mr. Ram Thapa</option>
                                <option>Ms. Rina Sharma</option>
                                <option>Mr. Arjun Rai</option>
                                <!-- Populate dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Add Course</button>
                    </div>
                </form>
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
</body>

</html>