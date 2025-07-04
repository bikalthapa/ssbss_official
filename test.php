<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Masonry Image Upload Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .custom-upload-area {
            background-color: #e6fff0;
            border: 2px dashed #28a745;
            padding: 30px;
            text-align: center;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .custom-upload-area:hover {
            background-color: #d4fbe0;
        }

        .custom-upload-area i {
            color: #28a745;
            font-size: 2rem;
        }

        .masonry-container {
            column-count: 4;
            column-gap: 1rem;
        }

        @media (max-width: 768px) {
            .masonry-container {
                column-count: 2;
            }
        }

        @media (max-width: 480px) {
            .masonry-container {
                column-count: 1;
            }
        }

        .parent_container {
            max-height: 600px;
            overflow-y: auto;
        }

        .preview-img-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
            width: 100%;
            break-inside: avoid;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .preview-img-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 0.5rem;
        }

        .remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .thumbnail-radio {
            position: absolute;
            bottom: 6px;
            left: 6px;
            background: rgba(0, 0, 0, 0.6);
            padding: 2px 6px;
            border-radius: 12px;
            color: white;
            font-size: 0.85rem;
            z-index: 10;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .thumbnail-radio input[type="radio"] {
            margin-right: 4px;
            cursor: pointer;
        }

        .hide {
            display: none;
        }
    </style>
</head>

<body class="container py-5">
    <!-- Top Section: Profile and Input -->
    <div class="d-flex align-items-center mb-3">
        <img src="../../images/authorities_img/unknown_person.jpg" class="rounded-circle me-3" alt="Profile" width="30"
            height="30" />
        <button class="post-input" data-bs-toggle="modal" data-bs-target="#postModal">What's on your mind,
            Admin?</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title mx-auto fw-semibold" id="postModalLabel">📝 Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="new_post_form" method="post" enctype="multipart/form-data" class="px-2">

                        <!-- Post Category -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Post Category</label>
                            <select id="selection" class="form-select rounded-3 border-2 border-primary"
                                name="post_type" required>
                                <option value="news">News</option>
                                <option value="notice">Notice</option>
                                <option value="document">Documents</option>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-medium">Title</label>
                            <input type="text" name="title" id="title" placeholder="Enter title here..."
                                class="form-control rounded-3 border-2 border-primary">
                        </div>

                        <!-- News/Notice Section -->
                        <div class="news_section" id="news_section">
                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Description</label>
                                <textarea name="news_content" id="description" rows="4"
                                    class="form-control rounded-3 border-2 border-primary"
                                    placeholder="Write something..."></textarea>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Upload Images</label>
                                <div id="uploadTrigger"
                                    class="border rounded-3 p-4 text-center bg-light d-flex flex-column align-items-center justify-content-center cursor-pointer"
                                    style="border-style: dashed;">
                                    <i class="bi bi-images fs-1 text-primary"></i>
                                    <div class="mt-2 text-muted">Click or drag to upload images</div>
                                </div>

                                <input type="file" name="images[]" id="upload" class="d-none"
                                    accept="image/jpeg,image/png" multiple>
                                <input type="hidden" name="thumbnail_index" id="thumbnailIndex">

                                <!-- Preview Container -->
                                <div class="mt-3">
                                    <div id="imagePreview" class="row g-2 masonry-container"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="document_section" id="document_section" style="display: none;">
                            <div class="mb-3">
                                <label for="document" class="form-label fw-medium">Upload PDF Document</label>
                                <input type="file" name="file" id="document"
                                    class="form-control rounded-3 border-2 border-primary" accept="application/pdf">
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mt-4">
                            <button type="submit" name="create_post" class="btn btn-primary btn-lg rounded-3">
                                <i class="bi bi-upload me-2"></i>Post Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="script/javascript/UI/toast.js"></script>
    <script>
        const filesArray = [];
        let selectedThumbnail = null;

        function updateFileLabel() {
            const label = filesArray.length > 0
                ? `${filesArray.length} image(s) selected`
                : "Click or drag to upload images (JPEG, PNG)";
            $('#fileLabel').text(label);
        }

        function renderPreviews() {
            const $container = $('#imagePreview').empty();

            filesArray.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const $wrapper = $(`
            <div class="preview-img-wrapper">
              <img src="${e.target.result}" alt="${file.name}">
              <button class="remove-btn" title="Remove">&times;</button>
              <label class="thumbnail-radio" title="Select as thumbnail">
                <input type="radio" name="thumbnail_select" value="${index}"> Thumbnail
              </label>
            </div>
          `);

                    $wrapper.find('.remove-btn').on('click', function () {
                        filesArray.splice(index, 1);
                        if (selectedThumbnail === index) {
                            selectedThumbnail = null;
                            $('#thumbnailIndex').val('');
                        } else if (selectedThumbnail > index) {
                            selectedThumbnail--;
                            $('#thumbnailIndex').val(selectedThumbnail);
                        }
                        renderPreviews();
                    });

                    $wrapper.find('input[type=radio]').on('change', function () {
                        selectedThumbnail = index;
                        $('#thumbnailIndex').val(index);
                    });

                    $container.append($wrapper);
                };

                reader.readAsDataURL(file);
            });
        }

        function addFiles(files) {
            for (let file of files) {
                if (!filesArray.some(f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified)) {
                    filesArray.push(file);
                }
            }
            renderPreviews();
        }

        // Event: category selection changed
        $("#selection").on("change", function () {
            const selected = $(this).val();
            if (selected === "news" || selected === "notice") {
                $("#news_section").show();
                $("#document_section").hide();
            } else if (selected === "document") {
                $("#document_section").show();
                $("#news_section").hide();
            }
        });

        // Open file dialog
        $('#uploadTrigger').on('click', () => $('#upload').click());

        // File input change
        $('#upload').on('change', function () {
            addFiles(this.files);
            $(this).val('');
        });

        // Drag and drop
        $('#uploadTrigger').on('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('bg-light');
        });

        $('#uploadTrigger').on('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('bg-light');
        });

        $('#uploadTrigger').on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('bg-light');
            const droppedFiles = e.originalEvent.dataTransfer.files;
            addFiles(droppedFiles);
        });

        $('#new_post_form').on('submit', function (e) {
            e.preventDefault();

            var selectedThumb = $('input[name="thumbnail_select"]:checked').val();
            var thumbIndx = 0;
            if (selectedThumb !== undefined) {
                thumbIndx = parseInt(selectedThumb);
            }

            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            $('#upload')[0].files = dataTransfer.files;

            const postCategory = $("#selection").val();
            const titleInput = $("#title");
            const title = titleInput.val().trim();

            if (!title) {
                ToastManager.show("Validation Error", "Please enter a title.", "warning");
                return;
            }

            const formData = new FormData();
            formData.append("typ", postCategory);
            formData.append("title", title);

            if (postCategory === "news" || postCategory === "notice") {
                const description = $("#description").val().trim();
                const thumbnail = dataTransfer.files[thumbIndx];
                const relatedImages = dataTransfer.files;

                if (!thumbnail) {
                    ToastManager.show("Validation Error", "Please select a thumbnail.", "warning");
                    return;
                }

                formData.append("description", description);
                formData.append("thumbnail", thumbnail);
                formData.append("action", "new_news");

                for (let i = 0; i < relatedImages.length; i++) {
                    formData.append("image[]", relatedImages[i]);
                }

            } else if (postCategory === "document") {
                const documentFile = $("#document")[0].files[0];

                if (!documentFile) {
                    ToastManager.show("Validation Error", "Please select a PDF document.", "warning");
                    return;
                }

                formData.append("file", documentFile);
                formData.append("action", "new_document");
            } else {
                ToastManager.show("Error", "Invalid post category selected.", "danger");
                return;
            }

            $.ajax({
                url: "dashboard/admin/action/insert_data.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    if (res.status === "success") {
                        ToastManager.show("Success", "Post added successfully!", "success");
                        $("#new_post_form")[0].reset();
                        $("#imgPreview, #thumbPreview").empty();
                        closePostModal();
                    } else {
                        ToastManager.show("Error", res.message || "Failed to add post.", "danger");
                    }
                },
                error: function () {
                    ToastManager.show("Error", "Server error. Please try again later.", "danger");
                }
            });
        });

    </script>
</body>

</html>