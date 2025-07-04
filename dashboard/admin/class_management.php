<?php
include "../../script/php_scripts/database.php";
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
    <title>Class Management</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="../../images/slogo.png">

    <style>
        #classAccordion .accordion {
            max-width: 500px;
        }

        #classAccordion .accordion-button::after {
            position: absolute;
            bottom: 5px;
            left: 50%;

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
        <?php
        $classData = $classManager->getClass();
        // print_r($classData);
        ?>

        <!-- Class Accordion -->
        <div class="accordion accordion-flush" id="classAccordion">
            <?php
            foreach ($classData as $class) {
                $className = htmlspecialchars($class['class_name']);
                $sections = $classManager->getSectionsByClassId($class['class_id']);
                if (count($sections) > 0) {
                    ?>
                    <!-- Class with sections -->
                    <div class="accordion-item border rounded border-warning mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-warning bg-opacity-25 d-flex flex-row" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $class['class_id'] ?>"
                                aria-expanded="false" aria-controls="flush-collapseOne">

                                <div>
                                    <div class="grade-name"><?php echo $className; ?></div>
                                    <div class="teacher-name">
                                        <?php
                                        $len = count($sections) > 2 ? 2 : count($sections);
                                        for ($i = 0; $i < $len; $i++) {
                                            echo $sections[$i]["section_name"];
                                            if ($i < $len - 1)
                                                echo ", "; // comma between names
                                        }

                                        $remaining = count($sections) - $len;
                                        if ($remaining > 0) {
                                            echo " + $remaining More";
                                        }
                                        ?>
                                    </div>

                                </div>

                                <div class="dropdown dropstart ms-auto" onclick="event.stopPropagation()">
                                    <!-- STOP PROPAGATION HERE -->
                                    <i class="bi bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"
                                        onclick="event.stopPropagation()"></i>

                                    <ul class="dropdown-menu bg-warning-subtle" onclick="event.stopPropagation()">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-pencil-square fs-4"></i>&nbsp;&nbsp;
                                                Edit Class
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-person-standing-dress fs-4"></i>&nbsp;&nbsp;
                                                Manage Students
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item bg-danger bg-opacity-25 text-danger" id="deleteClass">
                                                <i class="bi bi-trash3 fs-4"></i>&nbsp;&nbsp;
                                                Delete Class
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </button>

                            <span class="badge bg-warning text-dark rounded-pill section-badge"><?php echo count($sections); ?>
                                Sections</span>

                        </h2>
                        <div id="flush-collapse<?php echo $class['class_id'] ?>" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body pt-2 bg-warning bg-opacity-10">
                                <ul class="list-group list-group-flush">
                                    <?php
                                    foreach ($sections as $section) {
                                        $sectionName = htmlspecialchars($section['section_name']);
                                        $teacher = $classManager->getTeachersBySectionId($section['section_id']);
                                        $teacherName = $teacher ? htmlspecialchars($teacher['name']) : "Teacher isn't Assigned";
                                        ?>
                                        <li class="list-group-item hstack bg-transparent">
                                            <p><b><?php echo $sectionName; ?></b><br><span
                                                    class="text-muted small"><?php echo $teacherName; ?></span></p>
                                            <div class="dropdown dropstart ms-auto">
                                                <i class="bi bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu bg-warning-subtle">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="bi bi-pencil-square fs-4"></i>&nbsp;&nbsp;
                                                            Edit Section
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item bg-danger bg-opacity-25 text-danger" href="#">
                                                            <i class="bi bi-trash3 fs-4"></i>&nbsp;&nbsp;
                                                            Delete Class
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $teacher = $classManager->getTeachersByClassId($class['class_id']);
                    $teacherName = $teacher ? htmlspecialchars($teacher[0]['u_name']) : "Teacher isn't Assigned";
                    ?>
                    <!-- Class without sections -->
                    <div class="accordion-item border rounded border-warning mb-3">
                        <h2 class="accordion-header d-flex align-items-center  bg-warning bg-opacity-25 position-relative">
                            <button class="accordion-button no-collapse" type="button" disabled>
                                <div class="grade-name"><?php echo $className; ?></div>
                                <div class="teacher-name"><?php echo $teacherName; ?></div>
                            </button>
                            <div class="dropdown dropstart me-3">
                                <i class="bi bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu bg-warning-subtle">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-pencil-square fs-4"></i>&nbsp;&nbsp;
                                            Edit Class
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-person-standing-dress fs-4"></i>&nbsp;&nbsp;
                                            Manage Students
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item bg-danger bg-opacity-25 text-danger" href="#">
                                            <i class="bi bi-trash3 fs-4"></i>&nbsp;&nbsp;
                                            Delete Class
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </h2>
                    </div>
                    <?php
                }
            }
            ?>

        </div>


    </div>




    <!-- Modal: Add Class -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="addClassForm">

                <div class="modal-header">
                    <h5 class="modal-title" id="addClassModalLabel">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="className" class="form-label">Class Name</label>
                        <input type="text" class="form-control class-input" id="className">
                    </div>
                    <div class="mb-3">
                        <label for="classTeacher" class="form-label">Class Teacher</label>
                        <select class="form-select class-input" id="classTeacher">
                            <option value="">Select a teacher</option>
                            <?php
                            $freeTeachers = $user->getUnassignedTeacher();
                            if (count($freeTeachers) > 0) {
                                foreach ($freeTeachers as $teacher) {
                                    echo "<option value='{$teacher['u_id']}'>{$teacher['name']}</option>";
                                }
                            } else {
                                echo "<option value=''>No available teachers</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sections" class="form-label">Sections (comma separated)</label>
                        <input type="text" class="form-control class-input" id="sections" list="sectionOptions"
                            autocomplete="off">
                        <datalist id="sectionOptions">
                            <option value="Sagarmatha">
                            <option value="Makalu">
                            <option value="Annapurna">
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
        $(document).ready(function () {

            function showError(input, message) {
                input.addClass("is-invalid");

                let feedback = input.siblings(".invalid-feedback");
                if (!feedback.length) {
                    input.after(`<div class="invalid-feedback d-block">
                    <i class="bi bi-exclamation-circle-fill me-1"></i>${message}</div>`);
                } else {
                    feedback.html(`<i class="bi bi-exclamation-circle-fill me-1"></i>${message}`);
                }
            }

            function clearError(input) {
                input.removeClass("is-invalid");
                input.siblings(".invalid-feedback").remove();
            }

            function validateClassForm() {
                let valid = true;

                const className = $("#className");
                const classTeacher = $("#classTeacher");
                const sections = $("#sections");

                if (className.val().trim() === "") {
                    showError(className, "Class name is required.");
                    valid = false;
                } else {
                    clearError(className);
                }

                if (classTeacher.val().trim() !== "") {
                    const isValidOption = classTeacher.find(`option[value='${classTeacher.val().trim()}']`).length > 0;
                    if (!isValidOption) {
                        showError(classTeacher, "Please select a valid teacher.");
                        valid = false;
                    } else {
                        clearError(classTeacher);
                    }
                } else {
                    clearError(classTeacher);
                }

                if (sections.val().trim() !== "") {
                    const sectionList = sections.val().split(',').map(s => s.trim()).filter(Boolean);
                    if (sectionList.length === 0) {
                        showError(sections, "Enter valid section names, comma separated.");
                        valid = false;
                    } else {
                        clearError(sections);
                    }
                } else {
                    clearError(sections);
                }

                return valid;
            }

            $(".class-input").on("input change", function () {
                clearError($(this));
            });

            $("#addClassModal form").on("submit", function (e) {
                e.preventDefault();

                if (!validateClassForm()) {
                    ToastManager.show("Validation Error", "Please correct the highlighted fields.", "warning");
                    return;
                }

                const className = $("#className").val().trim();
                const classTeacher = $("#classTeacher").val().trim();
                const sectionNames = $("#sections").val().trim().split(',').map(s => s.trim()).filter(Boolean);

                const formData = new FormData();
                formData.append("class_name", className);
                formData.append("action", "add_class");

                if (classTeacher !== "") {
                    formData.append("u_id", classTeacher);
                }

                sectionNames.forEach(name => {
                    formData.append("section_names[]", name);
                });

                $.ajax({
                    url: "action/insert_data.php",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        console.log(res);
                        if (res.status === "success") {
                            ToastManager.show("Success", res.message || "Class added successfully!", "success");
                            $("#addClassModal form")[0].reset();
                            $(".invalid-feedback").remove();
                            $(".class-input").removeClass("is-invalid");
                            $("#addClassModal").modal('hide');
                        } else {
                            ToastManager.show("Error", res.message || "Could not add class.", "danger");
                        }
                    },
                    error: function () {
                        ToastManager.show("Server Error", "Please try again later.", "danger");
                    }
                });
            });

        });
    </script>





</body>

</html>