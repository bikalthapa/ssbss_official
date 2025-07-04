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
    <style>
        .subject-card {
            position: relative;
            padding: 1rem;
            border-radius: 12px;
            background-color: #fffbea;
            transition: box-shadow 0.3s ease;
        }

        .subject-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .submit-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.1rem;
        }

        .completed .submit-badge {
            background-color: #00c851;
            color: white;
            border-radius: 50%;
            padding: 0.3rem 0.5rem;
        }

        .subject-progress {
            height: 4px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <?php
    get_navbar("exam");
    ?>
    <br><br><br>

    <div class="container py-5">
        <!-- Title & Term Selection -->
        <div class="mb-4">
            <h4 class="fw-bold mb-1">
                <i class="bi bi-journal-bookmark-fill me-1"></i> Your Subjects for Marks Entry
            </h4><br>

            <!-- Term and Year Selection -->
            <div class="d-flex flex-column flex-sm-row gap-2" style="max-width: 520px;">
                <!-- Year Dropdown -->
                <select class="form-select shadow-sm" id="yearSelect" style="max-width: 250px;">
                    <option selected disabled>Select Year</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
                <!-- Term Dropdown -->
                <select class="form-select shadow-sm" id="termSelect" style="max-width: 250px;">
                    <option selected disabled>Select Term</option>
                    <option value="first">First Term</option>
                    <option value="second">Second Term</option>
                    <option value="third">Third Term</option>
                    <option value="final">Final Term</option>
                </select>
            </div>
        </div>


        <!-- Subject Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="subject-card position-relative p-3 border rounded shadow-sm bg-white" data-bs-toggle="modal"
                    data-bs-target="#marksEntryModal">

                    <!-- Subject Content -->
                    <div class="d-flex align-items-center gap-3">
                        <div
                            class="bg-warning bg-opacity-25 text-warning p-3 rounded-circle fs-4 d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">Mathematics</h6>
                            <p class="mb-0 text-secondary small">Grade 5 - Section A</p>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="mt-0">
                        <div class="d-flex justify-content-end small text-secondary">
                            <span>65% complete</span>
                        </div>
                        <div class="progress subject-progress mt-1 bg-warning-subtle">
                            <div class="progress-bar bg-warning" style="width: 65%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more subject cards as needed -->
            <div class="col">
                <div class="subject-card position-relative p-3 border rounded shadow-sm bg-light-subtle"
                    data-bs-toggle="modal" data-bs-target="#marksEntryModal">
                    <!-- Subject Content -->
                    <div class="d-flex align-items-center gap-3">
                        <div
                            class="bg-success bg-opacity-25 text-success p-3 rounded-circle fs-4 d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark">Science</h6>
                            <p class="mb-0 text-secondary small">Grade 5 - Section B</p>
                        </div>
                    </div>

                    <!-- Completion Status -->
                    <div class="mt-0">
                        <div class="d-flex justify-content-end small text-success fw-semibold">
                            <span><i class="bi bi-check-circle-fill me-1"></i>Completed</span>
                        </div>
                        <div class="progress subject-progress mt-1 bg-success-subtle">
                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Beautified Marks Entry Modal with TH/PR FM/PM -->
    <div class="modal fade" id="marksEntryModal" tabindex="-1" aria-labelledby="marksEntryModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <!-- Header -->
                <div class="modal-header bg-light border-bottom-0 py-3 px-4">
                    <h5 class="modal-title fw-semibold text-dark" id="marksEntryModalLabel">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>Marks Entry - <span
                            class="text-primary">Mathematics</span>
                        <small class="text-muted d-block fs-6">Grade 5, Section A</small>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body px-4 pt-1 pb-4">

                    <form class="mb-4">
                        <div class="row g-2">
                            <!-- Theory -->
                            <div class="col-6 col-sm-4 col-md-2">
                                <label for="thFullMarks" class="form-label fw-semibold">Theory FM</label>
                                <input type="number" id="thFullMarks" class="form-control form-control-sm shadow-sm"
                                    placeholder="75" min="0">
                            </div>
                            <div class="col-6 col-sm-4 col-md-2">
                                <label for="thPassMarks" class="form-label fw-semibold">Theory PM</label>
                                <input type="number" id="thPassMarks" class="form-control form-control-sm shadow-sm"
                                    placeholder="27" min="0">
                            </div>

                            <!-- Practical -->
                            <div class="col-6 col-sm-4 col-md-2">
                                <label for="prFullMarks" class="form-label fw-semibold">Practical FM</label>
                                <input type="number" id="prFullMarks" class="form-control form-control-sm shadow-sm"
                                    placeholder="25" min="0">
                            </div>
                            <div class="col-6 col-sm-4 col-md-2">
                                <label for="prPassMarks" class="form-label fw-semibold">Practical PM</label>
                                <input type="number" id="prPassMarks" class="form-control form-control-sm shadow-sm"
                                    placeholder="8" min="0">
                            </div>

                            <!-- Credit Hours -->
                            <div class="col-6 col-sm-4 col-md-2">
                                <label for="creditHours" class="form-label fw-semibold">Credit Hours</label>
                                <input type="number" id="creditHours" step="0.5"
                                    class="form-control form-control-sm shadow-sm" placeholder="3" min="0" max="10">
                            </div>
                        </div>
                    </form>




                    <!-- Marks Entry Table -->
                    <form>
                        <div class="table-responsive rounded border shadow-sm">
                            <table class="table table-hover table-striped align-middle text-center mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th rowspan="2" class="align-middle">Roll No.</th>
                                        <th rowspan="2" class="align-middle">Student Name</th>
                                        <th colspan="2">Obtained Marks</th>
                                    </tr>
                                    <tr>
                                        <th>TH</th>
                                        <th>PR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="text-start ps-4">Ram Bahadur</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-center"
                                                style="max-width: 80px;" placeholder="TH" tabindex="1">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-center"
                                                style="max-width: 80px;" placeholder="PR" tabindex="3">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="text-start ps-4">Sita Kumari</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-center"
                                                style="max-width: 80px;" placeholder="TH" tabindex="2">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm text-center"
                                                style="max-width: 80px;" placeholder="PR" tabindex="4">
                                        </td>
                                    </tr>
                                    <!-- More rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-top-0 px-4 pb-4 pt-2">
                    <button type="button" class="btn btn-light border shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-warning shadow-sm px-4">
                        <i class="bi bi-save2 me-1"></i>Save Marks
                    </button>
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
</body>

</html>