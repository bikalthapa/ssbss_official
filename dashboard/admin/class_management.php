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
    <title>Class Management</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="../../images/slogo.png">

    <style>
        #classAccordion .accordion {
            max-width: 500px;
        }

        #classAccordion .accordion-button::after {
            position: absolute;
            top: 45%;
            right: 15px;

        }

        #classAccordion .accordion-button.no-collapse {
            cursor: default;
            pointer-events: none;
            /* prevents clicking */
            background-color: transparent !important;
            /* keep BG clean */
            color: #212529;
            /* default text color */
            box-shadow: none;
        }

        #classAccordion .accordion-button.no-collapse::after {
            display: none;
        }


        #classAccordion .accordion-item {
            position: relative;
        }

        #classAccordion .accordion-button {
            flex-direction: column;
            position: relative;
            align-items: start;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .grade-name {
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.2;
        }

        .teacher-name {
            font-size: 0.85rem;
            color: #6c757d;
            /* Bootstrap text-muted */
            margin-top: 0.1rem;
        }

        .section-badge {
            position: absolute;
            top: -7px;
            right: -4px;
            font-size: 0.75rem;
            background-color: #0d6efd;
            color: white;
            padding: 0.25em 0.6em;
            border-radius: 9999px;
            user-select: none;
            z-index: 3;
            pointer-events: none;
        }
    </style>
</head>

<body id="main_body">
    <?php
    get_navbar("class");
    ?>
    <br><br><br>

    <div class="container">
        <!-- Header -->
        <h4 class="mb-3">Class Management</h4>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn bg-success bg-opacity-10 text-success" data-bs-toggle="modal"
                data-bs-target="#addClassModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
            </button>
        </div>

        <!-- Class Accordion -->
        <div class="accordion accordion-flush" id="classAccordion">

            <!-- Class with sections -->
            <div class="accordion-item border rounded border-warning mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-warning bg-opacity-25" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                        aria-controls="flush-collapseOne">
                        <div class="grade-name">Grade 1</div>
                        <div class="teacher-name">Ms. Anna + more</div>
                    </button>
                    <span class="badge bg-warning text-dark rounded-pill section-badge">2 Sections</span>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body pt-2 bg-warning bg-opacity-10">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent d-flex justify-content-between">

                            <li class="list-group-item hstack bg-transparent">
                                <p><b>Section A</b><br><span class="text-muted small">Mr. James</span></p>
                                <div class="dropdown dropstart ms-auto">
                                    <svg data-bs-toggle="dropdown" aria-expanded="false"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                    <ul class="dropdown-menu bg-warning-subtle">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                                </svg>&nbsp;&nbsp;
                                                Remove Teacher
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                                </svg>&nbsp;&nbsp;
                                                Change Teacher
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item bg-danger bg-opacity-25 text-danger" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>&nbsp;&nbsp;
                                                Delete Class
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </li>
                            <li class="list-group-item hstack bg-transparent">
                                <p><b>Section B</b><br><span class="text-muted small">Mr. James</span></p>
                                <div class="dropdown dropstart ms-auto">
                                    <svg data-bs-toggle="dropdown" aria-expanded="false"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                    <ul class="dropdown-menu bg-warning-subtle">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                                </svg>&nbsp;&nbsp;
                                                Remove Teacher
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                                </svg>&nbsp;&nbsp;
                                                Change Teacher
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item bg-danger bg-opacity-25 text-danger" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>&nbsp;&nbsp;
                                                Delete Class
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Class without sections -->
            <div class="accordion-item border rounded border-warning mb-3">
                <h2 class="accordion-header d-flex align-items-center  bg-warning bg-opacity-25 position-relative">
                    <button class="accordion-button no-collapse" type="button" disabled>
                        <div class="grade-name">Grade 2</div>
                        <div class="teacher-name">Mrs. Johnson</div>
                    </button>
                    <div class="dropdown dropstart me-3">
                        <svg data-bs-toggle="dropdown" aria-expanded="false" xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" fill="currentColor" class="bi bi-three-dots-vertical"
                            viewBox="0 0 16 16">
                            <path
                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        </svg>
                        <ul class="dropdown-menu bg-warning-subtle">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-person-x" viewBox="0 0 16 16">
                                        <path
                                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                    </svg>&nbsp;&nbsp;
                                    Remove Teacher
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-people" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>&nbsp;&nbsp;
                                    Change Teacher
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item bg-danger bg-opacity-25 text-danger" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>&nbsp;&nbsp;
                                    Delete Class
                                </a>
                            </li>
                        </ul>
                    </div>
                </h2>
            </div>

        </div>


    </div>




    <!-- Modal: Add Class -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClassModalLabel">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="className" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="className" required>
                    </div>
                    <div class="mb-3">
                        <label for="classTeacher" class="form-label">Class Teacher</label>
                        <select class="form-select" id="classTeacher" required>
                            <option value="">Select a teacher</option>
                            <option value="Ms. Anna">Ms. Anna</option>
                            <option value="Mr. James">Mr. James</option>
                            <option value="Mrs. Johnson">Mrs. Johnson</option>
                            <option value="Mr. David">Mr. David</option>
                            <!-- Add more options dynamically if needed -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sections" class="form-label">Sections (comma separated)</label>
                        <input type="text" class="form-control" id="sections" name="sections" list="sectionOptions"
                            autocomplete="off">

                        <datalist id="sectionOptions">
                            <option value="Sagarmatha">
                            <option value="Makalu">
                            <option value="Annapurna">
                                <!-- Add more as needed -->
                        </datalist>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Class</button>
                </div>
            </form>
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
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('focus', () => {
                // Collapse all other items first
                document.querySelectorAll('.accordion-collapse.show').forEach(openCollapse => {
                    // Only collapse if not the current button's target
                    const collapseId = button.getAttribute('data-bs-target');
                    if (openCollapse.id !== collapseId?.slice(1)) {
                        const collapseInstance = bootstrap.Collapse.getInstance(openCollapse);
                        if (collapseInstance) {
                            collapseInstance.hide();
                        }
                    }
                });

                // Show the focused button's collapse if it has one
                const target = button.getAttribute('data-bs-target');
                if (target) {
                    const collapseElement = document.querySelector(target);
                    if (collapseElement) {
                        const collapseInstance = bootstrap.Collapse.getOrCreateInstance(collapseElement);
                        collapseInstance.show();
                    }
                }
            });
        });

    </script>
</body>

</html>