	$("#notice_section").hide();
	$("#document_section").hide();
	$("#view_post").hide();
	$("#post_view_spinner").hide();


	$(document).ready(function (){
	// Setting default values
	var limit_value = 10;
	var sort_value = "DESC";
	var search_value = "";
	var data_view_mode = "news";

	    function loadrows(type, sort_val, limit_val,search_for){// This will load data with limit
	      $.ajax({
	        url : "header_and_footer/data_loader.php",
	        type : "POST",
	        data : {type : type, sort : sort_val, limit : limit_val, sr_for : search_for},
	        beforeSend : function(){
	        	$("#post_view_spinner").show();
	        },
	        success: function(data){
	          if(type=="news"){
	            $("#news_row").html(data);
	          }else if(type=="notice"){
	          	$("#notice_row").html(data);
	          }else if(type=="document"){
	          	$("#document_row").html(data);
	          }
	        },
	        complete: function(){
	        	$("#post_view_spinner").hide();
	        }
	      })
	    }
	    loadrows(data_view_mode,sort_value,limit_value,search_value);
	    $("#limit").on("input",function (){// This will execute when putting values on limit
	    	limit_value = $("#limit").val();
	    	if(limit_value == ""){
	    		limit_value = 10;
	    	}
	    	loadrows(data_view_mode, sort_value, limit_value,search_value);
	    });
	    $("#sort").on("change",function (){// This will execute when choosing values on sort
	    	sort_value = $("#sort").val();
	    	loadrows(data_view_mode, sort_value, limit_value,search_value);
	    });
	    $("#search_bar").on("input",function(){
	    	var search_key = $("#search_bar").val();
	    	if(search_key==""){
	    		search_value = "%";
	    	}else{
	    		search_value = "%"+search_key+"%";
	    	}
	    	loadrows(data_view_mode, sort_value, limit_value, search_value);
	    })


		$("#selection").on("change",function(){//For Post category selection dropdown
			var selected_item = $("#selection").val();
			if(selected_item=="news" || selected_item=="notice"){
				$("#news_section").show();
				$("#document_section").hide();
			}else if(selected_item=="document"){
				$("#document_section").show();
				$("#news_section").hide();
			};
		});


		// Data view and add button toggler
		var view_div = document.getElementById("view_post");
		var add_div = document.getElementById("add_post");
		var btn_toggler = document.getElementById("post_toggler");
		btn_toggler.addEventListener("click",()=>{
			var current_mode = btn_toggler.getAttribute("current-toggle");
			if(current_mode=="add"){
				btn_toggler.innerHTML = "New Post";
				btn_toggler.setAttribute("current-toggle","show");
				view_div.style.display = "";
				add_div.style.display = "none";
			}else if(current_mode=="show"){
				btn_toggler.innerHTML = "View Post";
				btn_toggler.setAttribute("current-toggle","add");
				add_div.style.display = "";
				view_div.style.display = "none";
			}
		});
		// News, Notice and Download toggler
		$("#notice_div").hide();
		$("#document_div").hide();
		$("#news_view_btn").attr("class","nav-link active bg-primary text-white");
		$("#news_view_btn").on("click",function (){
			data_view_mode = "news";
			limit_value = 10;
			search_value = "%";
			$("#news_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#document_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link");
			$("#notice_div").hide();
			$("#document_div").hide();
			$("#news_div").show();
		    loadrows(data_view_mode,sort_value,limit_value,search_value);
		});
		$("#notice_view_btn").on("click",function (){
			data_view_mode = "notice";
			limit_value = 10;
			search_value = "%";
			$("#news_view_btn").attr("class","nav-link");
			$("#document_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#news_div").hide();
			$("#document_div").hide();
			$("#notice_div").show();
		    loadrows(data_view_mode,sort_value,limit_value,search_value);
		});
		$("#document_view_btn").on("click",function (){
			data_view_mode = "document";
			limit_value = 10;
			search_value = "%";
			$("#document_view_btn").attr("class","nav-link active bg-primary text-white");
			$("#news_view_btn").attr("class","nav-link");
			$("#notice_view_btn").attr("class","nav-link");
			$("#notice_div").hide();
			$("#news_div").hide();
			$("#document_div").show();
			loadrows(data_view_mode,sort_value,limit_value,search_value);
		});


	});