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



function getImageDesign(images) {
	html = "";
	images.forEach((image) => {
		html += `
			<div class="carousel-item active d-flex justify-content-center align-item-center">
				<img src="../../uploads/images/${image}" class="d-block news_img_carousel" alt="...">
			</div>
		`;
	});
	return html;
}
function getNewsDesign(data) {
	let html = "";
	if (data.length > 0) {
		data.forEach((item) => {
			html += `
						<div class="col col-sm-6 g-3" style="z-index:0;">
							<div class="card post_form">
								<div class="card-body">
									<h5 class="card-title">
										<div class="hstack gap-3">
										<div>${item.title}</div>
										<div class="ms-auto">
												<div class="dropdown dropstart">
												<a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="bi bi-three-dots-vertical"></i>
												</a>
					
												<ul class="dropdown-menu">
													<li>
														<a href="action/update.php?news_id=${item.news_id}" title="Update" class="dropdown-item">
															<i class="bi bi-pencil-square"></i>
															Update
														</a>
													</li>
													<li>
														<a href="action/delete.php?news_id=${item.news_id}" title="Delete" class="dropdown-item">
															<i class="bi bi-trash"></i>
															Delete
														</a>
													</li>
													<li>
														<a class="dropdown-item" href="../../category/individual_content.php?news_id=${item.news_id}" target="blank" style="z-index:1;">
															<i class="bi bi-eye"></i>
															Detail View
														</a>
													</li>
												</ul>
												</div>
										</div>
										</div>
									</h5><hr>
									<p class="card-text" style="text-align:justify;">${item.src}</p>
									<p class="card-text text-start"><small class="text-body-secondary">${item.upload_date}</small></p>
									<!-- image carousel -->
									<div id="carouselExampleFade'.$news_id.'" class="carousel slide carousel-fade">
										<div class="carousel-inner">
											${getImageDesign(item.images)}
										</div>
										<button class="carousel-control-prev bg-dark bg-opacity-25" type="button" data-bs-target="#carouselExampleFade${item.news_id}" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next bg-dark bg-opacity-25" type="button" data-bs-target="#carouselExampleFade${item.news_id}" data-bs-slide="next">
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
	html = `<tr>
				<th>Id</th>
				<th>Title</th>
				<th>File Name</th>
				<th>Date</th>
				<th colspan="2">Action</th>
			</tr>`;
	data.forEach((item) => {
		html += `
			<tr>
				<td>${item.doc_id}</td>
				<td>${item.doc_title}</td>
				<td>${item.doc_file}</td>
				<td>${item.upload_date}</td>
				<td>
					<a href="action/update.php?document_id=${item.document_id}" title="Update" class="btn btn-primary btn-sm">
						<i class="bi bi-pencil-square"></i> Update
					</a>
				</td>
				<td>
					<a href="action/delete.php?document_id=${item.document_id}" title="Delete" class="btn btn-danger btn-sm">
						<i class="bi bi-trash"></i> Delete
					</a>
				</td>
			</tr>`;
	});
	return html;
}

$(document).ready(function () {
	// Default controls state
	let limit_value = 10;
	let sort_value = "DESC";
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
				console.log(res);
				if (type === "news" || type === "notice") {
					if (res.data.length > 0) {
						$(type === "news" ? "#news_row" : "#notice_row").html(getNewsDesign(res.data));
					} else {
						$(type === "news" ? "#news_row" : "#notice_row").html(getNothingFoundHTML());
					}
				} else if (type === "document") {
					if(res.data.length>0){
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
		// $("#document_view_btn").addClass("active bg-primary text-white").siblings().removeClass("active bg-primary text-white");
		loadrows(data_view_mode, sort_value, limit_value, search_value);
	});
});
