// Hide these sections initially
function getNothingFoundHTML() {
	return `
    <div style="
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px;
      border-radius: 16px;
      background-color: #f9fafb;
      box-shadow: 0 10px 15px rgba(0,0,0,0.05);
      max-width: 400px;
      margin: 50px auto;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    ">
      <img 
        src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
        alt="Nothing Found"
        style="width: 120px; height: auto; margin-bottom: 20px; opacity: 0.8;"
      />
      <h2 style="font-size: 24px; color: #111827; margin-bottom: 10px;">
        Nothing Found
      </h2>
      <p style="font-size: 16px; color: #6b7280; text-align: center;">
	  We couldn’t find anything matching what you are looking for.
      </p>
    </div>
  `;
}



// Generates image carousel slides (first image is 'active')
function getImageDesign(images, isActive) {
	let html = "";
	images.forEach((image, index) => {
		html += `
			<div class="carousel-item ${isActive ? 'active' : ''} d-flex justify-content-center align-items-center">
				<img src="../../uploads/images/${image}" class="d-block w-100 rounded-3 news_img_carousel" alt="news image">
			</div>
		`;
	});
	return html;
}

// Generates the full news card with image carousel
function getNewsDesign(data) {
	let html = "";
	if (data.length > 0) {
		data.forEach((item) => {
			html += `
				<div class="col g-3">
					<div class="card border-0 shadow rounded-4 overflow-hidden">
						<div class="card-body p-4">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h5 class="card-title mb-0">${item.title}</h5>
								<div class="dropdown">
									<a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="bi bi-three-dots-vertical fs-5 text-muted"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li>
											<a href="action/update.php?news_id=${item.news_id}" class="dropdown-item">
												<i class="bi bi-pencil-square me-2"></i> Update
											</a>
										</li>
										<li>
											<a href="action/delete.php?news_id=${item.news_id}" class="dropdown-item text-danger">
												<i class="bi bi-trash me-2"></i> Delete
											</a>
										</li>
										<li>
											<a href="../../individual_content.php?news_id=${item.news_id}" target="_blank" class="dropdown-item">
												<i class="bi bi-eye me-2"></i> Detail View
											</a>
										</li>
									</ul>
								</div>
							</div>

							<hr>
							<p class="card-text">
								<small class="text-muted">${item.upload_date}</small>
							</p>
							<p class="card-text text-justify mb-3">${item.src}</p>

							<!-- Bootstrap Carousel -->
							<div id="carousel${item.news_id}" class="carousel slide carousel-fade rounded-3 overflow-hidden" data-bs-ride="carousel">
								<div class="carousel-inner">
									${getImageDesign(item.images, true)}
									${getImageDesign([item.thumbnail], false)}
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carousel${item.news_id}" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carousel${item.news_id}" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			`;
		});
	}
	return html;
}




function getDocumentsDesign(data) {
	let html = `<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">`;

	data.forEach((item) => {
		html += `
			<div class="col">
				<div class="card h-100 shadow-sm border-0 rounded-4 text-center position-relative p-3">

					<!-- Header row: date and action -->
					<div class="d-flex justify-content-between align-items-start mb-2">
						<div class="text-muted small">${item.upload_date}</div>
						<div class="dropdown">
							<button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-three-dots-vertical"></i>
							</button>
							<ul class="dropdown-menu dropdown-menu-end">
								<li>
									<a class="dropdown-item" href="action/update.php?document_id=${item.doc_id}">
										<i class="bi bi-pencil-square me-2"></i> Update
									</a>
								</li>
								<li>
									<a class="dropdown-item text-danger" href="action/delete.php?document_id=${item.doc_id}">
										<i class="bi bi-trash me-2"></i> Delete
									</a>
								</li>
							</ul>
						</div>
					</div>

					<!-- File icon -->
					<div class="my-4">
						<i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3rem;"></i>
					</div>

					<!-- Title -->
					<div class="fw-semibold text-truncate px-2">${item.doc_title}</div>

				</div>
			</div>
		`;
	});

	html += `</div>`;
	return html;
}




$(document).ready(function () {
	// Default controls state
	let limit_value = 10;
	let sort_value = "desc";
	let search_value = "";
	let data_view_mode = "news";

	// Load data function
	function loadrows(type, sort_val, limit_val, search_for) {
		$.ajax({
			url: "action/read_data.php",
			type: "POST",
			data: { typ: type, sort: sort_val, limit: limit_val, query: search_for },
			beforeSend: () => $("#post_view_spinner").show(),
			success: (res) => {
				if (type === "news" || type === "notice") {
					if (res.data.length > 0) {
						$(type === "news" ? "#news_row" : "#notice_row").html(getNewsDesign(res.data));
					} else {
						$(type === "news" ? "#news_row" : "#notice_row").html(getNothingFoundHTML());
					}
				} else if (type === "document") {
					if (res.data.length > 0) {
						$("#document_row").html(getDocumentsDesign(res.data));
					}
				}
			},
			complete: () => $("#post_view_spinner").hide()
		});
	}

	// Initial load
	loadrows(data_view_mode, sort_value, limit_value, search_value);

	// Event: limit input changed
	$("#limit").on("input", function () {
		limit_value = $(this).val() || 10;
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});

	// Event: sort dropdown changed
	$("#sort").on("change", function () {
		sort_value = $(this).val();
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});

	// Event: search input changed
	$("#search_bar").on("input", function () {
		console.log("Searching");
		const search_key = $(this).val().trim();
		search_value = search_key ? `${search_key}%` : "";
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});

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

	// Initially hide notice and document divs
	$("#notice_div, #document_div").hide();

	// Toggle views on button clicks
	$("#news_view_btn").on("click", () => {
		data_view_mode = "news";
		limit_value = 10;
		search_value = "";
		$("#news_div").show();
		$("#notice_div, #document_div").hide();
		// $("#news_view_btn").addClass("active bg-primary text-white").siblings().removeClass("active bg-primary text-white");
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});

	$("#notice_view_btn").on("click", () => {
		data_view_mode = "notice";
		limit_value = 10;
		search_value = "";
		$("#notice_div").show();
		$("#news_div, #document_div").hide();
		// $("#notice_view_btn").addClass("active bg-primary text-white").siblings().removeClass("active bg-primary text-white");
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});

	$("#document_view_btn").on("click", () => {
		data_view_mode = "document";
		limit_value = 10;
		search_value = "";
		$("#document_div").show();
		$("#news_div, #notice_div").hide();
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});
});
