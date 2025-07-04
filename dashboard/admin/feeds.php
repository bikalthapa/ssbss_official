<?php
include "../../script/php_scripts/database.php";
include "scripts/php_scripts/header_and_footer.php";
include "../../script/php_scripts/utilities/authentication.php";
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
	<title>New Post | Admin</title>
	<link rel="stylesheet" type="text/css"
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" href="../../images/slogo.png">
	<style>
		body {
			max-height: 150vh;
		}

		.post_form {
			padding: 10px;
			box-shadow: rgb(42 67 113 / 15%) 8px 8px 30px 0px;
		}


		.admin_nav {
			max-width: 100%;
			max-height: 50px;
			border: 1px solid lightgrey;
			position: fixed;
			bottom: 0px;
			margin: auto;
			border-radius: 10px;
			box-shadow: black 8px 8px 30px 0px;
		}

		.admin_nav a {
			padding: 10px;
		}

		.my_badge {
			position: absolute;
			top: 7px;
			right: 3px;
		}

		td,
		th {
			border: 1px solid black;
			padding: 2px;
		}

		.outer_img_div {
			min-height: 200px;
			border: 1px solid black;
			overflow: hidden;
			position: relative;
		}

		.inner_img {
			max-height: 290px;
			margin-left: 0px;
			position: absolute;
			left: -20px;
		}

		.thumbnail_checkbox {
			position: absolute;
			top: 5px;
			left: 5px;
		}

		.news_img_carousel {
			max-height: 200px;
		}


		/* facebook post design  */
		.post-box {
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.post-input {
			background-color: #f0f2f5;
			border: none;
			border-radius: 20px;
			padding: 5px 15px;
			color: grey;
			text-align: left;
			width: 100%;
		}

		.action-icon {
			color: green;
		}
	</style>
</head>

<body>

	<?php
	get_navbar("content");
	?>
	<br><br>



	<div class="container my-4">
		<div class="bg-white p-3 post-box" style=" margin: auto; max-width:500px;">
			<!-- Top Section: Profile and Input -->
			<div class="d-flex align-items-center mb-3">
				<img src="../../images/authorities_img/unknown_person.jpg" class="rounded-circle me-3" alt="Profile"
					width="30" height="30" />
				<button class="post-input" data-bs-toggle="modal" data-bs-target="#postModal">What's on your mind,
					Admin?</button>
			</div>

			<hr class="my-2" />

			<!-- Bottom Action Bar -->
			<div class="d-flex align-items-center">
				<div class="d-flex justify-content-center gap-5 w-100" style="cursor:pointer">
					<div class="fs-bolder" id="news_view_btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green"
							class="bi bi-newspaper" viewBox="0 0 16 16">
							<path
								d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
							<path
								d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
						</svg>&nbsp;&nbsp;
						News
					</div>
					<div class="fs-bolder" id="notice_view_btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red"
							class="bi bi-pin-angle" viewBox="0 0 16 16">
							<path
								d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a6 6 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707s.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a6 6 0 0 1 1.013.16l3.134-3.133a3 3 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146m.122 2.112v-.002zm0-.002v.002a.5.5 0 0 1-.122.51L6.293 6.878a.5.5 0 0 1-.511.12H5.78l-.014-.004a5 5 0 0 0-.288-.076 5 5 0 0 0-.765-.116c-.422-.028-.836.008-1.175.15l5.51 5.509c.141-.34.177-.753.149-1.175a5 5 0 0 0-.192-1.054l-.004-.013v-.001a.5.5 0 0 1 .12-.512l3.536-3.535a.5.5 0 0 1 .532-.115l.096.022c.087.017.208.034.344.034q.172.002.343-.04L9.927 2.028q-.042.172-.04.343a1.8 1.8 0 0 0 .062.46z" />
						</svg>&nbsp;&nbsp;
						Notice
					</div>
					<div class="fs-bolder" id="document_view_btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="orange"
							class="bi bi-paperclip" viewBox="0 0 16 16">
							<path
								d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z" />
						</svg>&nbsp;&nbsp;
						Document
					</div>
				</div>
			</div>
		</div><br>
		<form class="row g-3 align-items-end p-3 rounded shadow-sm bg-white"
			style="margin-bottom: 10px; margin-top: -10px;" method="post" action="">

			<!-- Limit Input -->
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-text bg-white border-primary">
						<i class="bi bi-sliders"></i>
					</span>
					<input type="number" class="form-control border-primary" placeholder="Number of rows." id="limit">
				</div>
			</div>

			<!-- Sort Dropdown -->
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-text bg-white border-primary">
						<i class="bi bi-sort-down-alt"></i>
					</span>
					<select class="form-select border-primary" id="sort">
						<option value="DESC">Descending</option>
						<option value="ASC">Ascending</option>
					</select>
				</div>
			</div>

			<!-- Search Input -->
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-text bg-white border-primary">
						<i class="bi bi-search"></i>
					</span>
					<input type="search" name="search" class="form-control border-primary" placeholder="Search..."
						aria-label="Search" id="search_bar">
				</div>
			</div>
		</form><br>


		<div id="view_postt">

			<div class="table_div">
				<div id="news_div">
					<div id="news_row"
						class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center align-items-center">
					</div>
				</div>
				<div id="notice_div">
					<div id="notice_row"
						class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center align-items-center">
					</div>
				</div>
				<div id="document_div">
					<table cellspacing="0" cellpadding="0" style="margin:auto; width:100%;" id="document_row">
					</table>
				</div>
			</div>
			<!-- Loader -->
			<div class="d-flex justify-content-center">
				<div class="spinner-border" role="status" id="post_view_spinner">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5 text-center w-100" id="postModalLabel">Create Post</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="card post_form border-primary" id="new_post_form"
						style="margin: auto; max-width: 500px;" method="post" action="" enctype="multipart/form-data">

						<!-- Post Category -->
						<div class="mb-3">
							<label class="form-label">Post Category</label>
							<select id="selection" class="form-select border-primary" name="post_type" required>
								<option value="news">News</option>
								<option value="notice">Notice</option>
								<option value="document">Documents</option>
							</select>
						</div>

						<!-- Title -->
						<div class="mb-3">
							<label for="title" class="form-label" id="titleHelp">Title</label>
							<input type="text" name="title" id="title" placeholder="Something..."
								class="form-control border-primary" aria-describedby="titleHelp" required>
						</div>

						<!-- NEWS/NOTICE SECTION -->
						<div class="news_section" id="news_section">
							<!-- Description -->
							<div class="mb-3">
								<label for="description" id="descriptionHelp" class="form-label">Post
									Description</label>
								<textarea name="news_content" id="description"
									class="form-control border-primary form-control-sm"
									aria-describedby="descriptionHelp"></textarea>
							</div>

							<!-- Thumbnail -->
							<div class="mb-3">
								<label for="thumbnail" id="thumbnailHelp" class="form-label">Thumbnail (JPEG)</label>
								<input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png"
									class="form-control border-primary form-control-sm"
									aria-describedby="thumbnailHelp">
							</div>

							<div id="thumbPreview"
								class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
							</div>

							<!-- Related Images -->
							<div class="mb-3">
								<label for="image" id="imageHelp" class="form-label">Related Images (JPEG)</label>
								<input type="file" name="image[]" id="image" multiple accept="image/jpeg,image/png"
									class="form-control border-primary form-control-sm" aria-describedby="imageHelp">
							</div>

							<div id="imgPreview"
								class="row row-cols-2 p-2 d-flex justify-content-center align-items-center">
							</div>
						</div>

						<!-- DOCUMENT SECTION -->
						<div class="document_section" id="document_section" style="display: none;">
							<div class="mb-3">
								<label for="document" id="documentHelp" class="form-label">Upload PDF File</label>
								<input type="file" name="file" id="document" accept="application/pdf"
									class="form-control border-primary form-control-sm" aria-describedby="documentHelp">
							</div>
						</div>

						<!-- Submit -->
						<div class="d-grid">
							<input type="submit" name="create_post" value="Post" class="btn btn-primary">
						</div>
					</form>
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
	<script src="scripts/each_file_js/new_post.js"></script>



	<script>
		$(document).ready(() => {
			// Get the modal element by ID
			const postModal = new bootstrap.Modal(document.getElementById('postModal'));

			// OPEN the modal
			function openPostModal() {
				postModal.show();
			}

			// CLOSE the modal
			function closePostModal() {
				postModal.hide();
			}
			// Store original help messages on load
			$(".post_inputs").each(function () {
				const $input = $(this);
				const helpEl = descrOf($input);
				if (helpEl && helpEl.length && !helpEl.data("original")) {
					helpEl.data("original", helpEl.html().trim());
				}
			});


			// Remove error styles on input change
			$(".post_inputs").on("input", function () {
				const $this = $(this);
				if ($this.hasClass("border-danger") && $this.val().trim() !== "") {
					$this.removeClass("border-danger");
					const description = descrOf($this);
					description.removeClass("text-danger");
					if (description.data("original")) {
						description.html(description.data("original"));
					}
				}
			});

			// Remove error styles on file input change
			$("input[type='file']").on("change", function () {
				const $this = $(this);
				const files = $this[0].files;
				const description = descrOf($this);

				if ($this.hasClass("border-danger") && files.length > 0) {
					$this.removeClass("border-danger");
					description.removeClass("text-danger");
					if (description.data("original")) {
						description.html(description.data("original"));
					}
				}
			});

			// Get description element by aria-describedby
			function descrOf(inputField) {
				const attr = inputField.attr("aria-describedby");
				return $("#" + attr);
			}

			// Show validation error
			function validateInputs(input, description) {
				if (input.val().trim() === "") {
					input.addClass("border-danger");
					description.addClass("text-danger");

					if (!description.data("original")) {
						description.data("original", description.html().trim());
					}

					description.html("Field Required");
					return false;
				}
				return true;
			}

			// Validate images and preview
			function validateImg(fileField, previewId) {
				const allowedFormat = ["image/jpeg", "image/png"];
				const files = fileField[0].files;
				let errorCount = 0;
				const preview = document.getElementById(previewId);
				preview.innerHTML = ""; // Clear old previews

				if (files.length === 0) {
					return false;
				}

				for (let file of files) {
					if (!allowedFormat.includes(file.type)) {
						errorCount++;
						continue;
					}

					const reader = new FileReader();
					reader.onload = function (e) {
						const div = document.createElement("div");
						div.className = "col gx-5 outer_img_div";
						div.innerHTML = `<img class="inner_img" src="${e.target.result}">`;
						preview.appendChild(div);
					};
					reader.readAsDataURL(file);
				}

				return errorCount === 0;
			}

			// Image input preview
			$("#image").on("change", function () {
				validateImg($("#image"), "imgPreview");
			});

			$("#thumbnail").on("change", function () {
				validateImg($("#thumbnail"), "thumbPreview");
			});

			$("#new_post_form").on("submit", function (e) {
				e.preventDefault();

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
					const thumbnail = $("#thumbnail")[0].files[0];
					const relatedImages = $("#image")[0].files;

					if (!description) {
						ToastManager.show("Validation Error", "Please enter a description.", "warning");
						return;
					}
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
					url: "action/insert_data.php",
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

		});
	</script>


</body>

</html>